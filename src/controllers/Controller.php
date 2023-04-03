<?php

namespace Teszt\Controllers;

use Pachel\EasyFrameWork\DB\mySql;
use pachel\TableAdmin;
use Teszt\Models\celokModel;
use Teszt\Models\dolgozokModel;

class Controller extends BaseControler
{
    private dolgozokModel $Dolgozok;
    private celokModel $Celok;
    public function __construct($app)
    {
        parent::__construct($app);
        $this->Dolgozok = new dolgozokModel();
        $this->Celok = new celokModel();
    }

    public function mindig(){
        if(!isset($_SESSION["teszt_userid"])){
            $_SESSION["teszt_userid"] = $this->Dolgozok->select(["vezeto"=>0])->line()->id;
        }
        $this->app->_user = $this->Dolgozok->getById($_SESSION["teszt_userid"]);
        $this->app->_vezetok = $this->app->DB->query("SELECT *FROM dolgozok WHERE deleted=0 AND vezeto=0 AND id!=:id")->params(["id"=>$_SESSION["teszt_userid"]])->array();
    }
    public function vegeredmeny(){
        $eredmenyek = $this->app->DB->query(str_replace(["@vezeto"],[$_SESSION["teszt_userid"]],file_get_contents(__DIR__."/../assets/eredmeny1.sql")))->array();
        foreach ($eredmenyek AS &$sor){
            $sql = str_replace("@lezart",$sor->id,file_get_contents(__DIR__."/../assets/eredmeny2.sql"));
            $sor->sorok = $this->app->DB->query($sql)->array();
        }
        $this->app->_eredmenyek = $eredmenyek;
    }
    public function ajaxErtekelesTorol(){
        $return["status"] = 0;
        $return["message"] = "Nincs hiba";

        if($this->torolhetoe($_GET["id"],$return)) {
            $this->app->DB->query("UPDATE dolgozok_ertekelesei SET deleted=1 WHERE id=:id")->params(["id" => $_GET["id"]])->exec();
            $return["status"] = 1;
        }
        else{

        }
        return $return;
    }
    public function ajaxErtekelesMent(){
        $return["status"] = 0;
        $return["message"] = "Üres form!";
        $return["data"] = [];
        if(empty($_POST)){
            return $return;
        }
        foreach ($_POST AS $item){
            if($item<0){
                $return["message"] = "Minden mezőt ki kell választani!";
                return $return;
            }
        }
        $data = [
            "id_celok"=>$_POST["cel"],
            "id_dolgozok"=>$_GET["id"],
            "pont"=>$_POST["ertek"],
            "prioritas"=>$_POST["prioritas"]
        ];
        if($this->mehete($data,$return)) {
            if ($this->app->DB->insert("dolgozok_ertekelesei", $data)) {
                $return["data"] = $this->app->DB->query("SELECT e.id,c.nev AS cel,p.nev AS ertek,p2.nev prioritas FROM dolgozok_ertekelesei e,celok c,ertekek p,prioritasok p2  WHERE e.id=:id AND c.id=e.id_celok AND p.pont=e.pont AND p2.ertek=e.prioritas")->params(["id" => $this->app->DB->last_insert_id()])->line();
                $return["status"] = 1;
            }
        }

        return $return;
    }
    private function torolhetoe($id,&$return):bool{
        $result = $this->app->DB->query("SELECT *FROM dolgozok_ertekelesei WHERE id=:id AND deleted=0 AND id_lezart_ertekelesek=0 AND (SELECT COUNT(*) FROM dolgozok d WHERE d.vezeto=:userid AND d.id=id_dolgozok)>0")->params(["id"=>$id,"userid"=>$_SESSION["teszt_userid"]])->line();
        if(empty($result)){
            $return["status"] = 0;
            $return["message"] = "HIBA! Ezt a sort már törölték, vagy nem ide tartozik a dolgozó!";
            return false;
        }
        return $this->prioritasTorolhetoe($result,$return);
    }
    private function prioritasTorolhetoe($torlendo_sor,&$return):bool
    {

        $sql = str_replace(["@dolgozo","@vezeto"],[$torlendo_sor->id_dolgozok,$_SESSION["teszt_userid"]],file_get_contents(__DIR__."/../assets/prioritas_torleshez.sql"));
        $result = $this->app->DB->query($sql)->array();
        //Ha csak egy sor van azt lehet törölni
        if(count($result)==1){
            $return["message"] = "Csak egy sor marad!";
            return true;
        }
        $sum = 0;
        foreach ($result AS &$sor){
            if($torlendo_sor->prioritas == $sor->prioritas){
                $sor->aktualis--;
            }
            $sum+=$sor->aktualis;
        }
        $esz = $sum/100;
        foreach ($result AS &$sor){
            if(($sor->aktualis/$esz) > $sor->maximum){
                $return["message"] = "Ez a prioritás nem törölhető, mert a törlés után a(z) ".$sor->nev." prioritású értékelések nagyobb arányban maradnak meg mint ".$sor->maximum."%!\nElőbb törölje a(z) ".$sor->nev." prioritású sorokat!\nHa nem lehetséges, akkor adjon hozzá egy vagy több alacsony prioritású sort és próbálja úgy törölni!";
                return false;
            }
        }
        return true;
    }
    private function mehete($data,&$return):bool{
        $sql = str_replace(["@dolgozo","@prioritas","@cel"],[$data["id_dolgozok"],$data["prioritas"],$data["id_celok"]],file_get_contents(__DIR__."/../assets/mehete.sql"));

        $result = $this->app->DB->query($sql)->line();
        if($result->ezacel>0){
            $return["message"] = "Ez a cél már benne van a listában!";
            return false;
        }
        if($result->maximum == 100){
            return true;
        }
        $kovi = $result->prio+1;
        $osszes = $result->osszes+1;

        if(($kovi/($osszes/100))>$result->maximum){
            $return["message"] = "Ez a prioritás a felvitt értékelések maximum ".$result->maximum."%-a lehet csak!";
            return false;
        }
        return true;
    }
    public function ajax_dolgozo(){
        $return["status"] = 1;
        $return["min_ct"] = $this->app->min_ct;
        $return["max_ct"] = $this->app->max_ct;
        $return["celok"] = $this->app->DB->query("SELECT id FROM celok WHERE deleted=0 ORDER BY nev")->numarray();
        $return["data"] = $this->app->DB->query("SELECT e.id,c.nev AS cel,p.nev AS ertek,p2.nev prioritas FROM dolgozok_ertekelesei e,celok c,ertekek p,prioritasok p2  WHERE e.id_dolgozok=:id AND e.id_lezart_ertekelesek=0 AND e.deleted=0 AND c.id=e.id_celok AND p.pont=e.pont AND p2.ertek=e.prioritas")->params(["id"=>$this->app->GET["id"]])->array();
        return $return;
    }
    public function ajax_dolgozolista(){
        //$this->app->DB->setResultType(mySql::RESULT_OBJECT);
        $result = $this->app->DB->query("
SELECT id,nev,munkakor,torzsszam,'' as buttons2,
       (SELECT COUNT(*) FROM dolgozok_ertekelesei e WHERE e.id_dolgozok=dolgozok.id AND e.deleted=0 AND e.id_lezart_ertekelesek=0) AS kitoltve,
       (SELECT ROUND(SUM(d.pont*d.prioritas)/SUM(d.prioritas)) eredmeny FROM dolgozok_ertekelesei d WHERE d.id_dolgozok=dolgozok.id AND d.deleted=0 AND d.id_lezart_ertekelesek=0) pont
FROM dolgozok WHERE deleted=0 AND vezeto=:vezeto")->params(["vezeto"=>$_SESSION["teszt_userid"]])->array();
        foreach ($result AS &$item){
            $item->pont.="%";
            $item->buttons2 = "<a href=\"".$item->id."\" class='mod'>Értékelés</a>";
        }
        $eredmeny = $this->app->DB->query("SELECT ROUND(SUM(d.pont*d.prioritas)/SUM(d.prioritas)) eredmeny FROM dolgozok_ertekelesei d WHERE d.deleted=0 AND d.id_lezart_ertekelesek=0 AND d.id_dolgozok IN(SELECT id FROM dolgozok WHERE vezeto=:id AND deleted=0)")->params(["id"=>$_SESSION["teszt_userid"]])->line();
        $data["eredmeny"] = (empty($eredmeny->eredmeny)?0:$eredmeny->eredmeny);
        $data["data"] = $result;
        return $data;
    }
    public function ertekeles(){

        $this->app->_ertekek = $this->app->DB->query("SELECT *FROM ertekek WHERE deleted=0 ORDER BY pont")->array();
        $this->app->_prioritasok = $this->app->DB->query("SELECT *FROM prioritasok WHERE deleted=0 ORDER BY ertek")->array();
        $this->app->_celok = $this->app->DB->query("SELECT *FROM celok WHERE deleted=0 ORDER BY nev")->array();
    }
    public function start(){
        $this->app->reroute($this->app->landing);
    }
    public function login(){
        $vezeto = $this->Dolgozok->select(["vezeto"=>0,"id"=>$this->app->GET["id"]])->line();
        if(!empty($vezeto)) {
            $_SESSION["teszt_userid"] = $vezeto->id;
            $this->app->reroute("ertekeles");
        }
        $this->app->reroute("dolgozok");
    }
    public function celok(){
        $this->app->DB->setResultType(mySql::RESULT_ASSOC);
        $admin = new TableAdmin($this->app->DB);
        $admin->loadConfig(__DIR__."/../../config/tableadmin/celok.json");
        $admin->appendConfig(["baseUrl" => $this->app->env("app.url")]);
        $admin->addButtonActionMethod("delete",function ($id){
            $this->Celok->deleteById($id);
        });
        $this->app->_admin = $admin;
    }
    public function dolgozok(){
        $this->app->DB->setResultType(mySql::RESULT_ASSOC);
        $admin = new TableAdmin($this->app->DB);
        $admin->loadConfig(__DIR__."/../../config/tableadmin/dolgozok.json");
        $admin->appendConfig(["baseUrl" => $this->app->env("app.url")]);
        $admin->addButtonActionMethod("delete",function ($id){
            $this->Dolgozok->deleteById($id);
        });/*
        $admin->addBeforeActionMehod("edit",function ($row){
            $regi = $this->Dolgozok->getById($_GET["id"]);
            if($regi->vezeto != $row["vezeto"]){

            }
            //exit();
        });*/
        $admin->addMethodToButtonsIfVisible(function ($row){
            if($row["id"] == 1){
                return false;
            }
            return true;
        },"delete");
        $admin->addMethodToButtonsIfVisible(function ($row){
            if($row["id"] == 1){
                return false;
            }
            return true;
        },"edit");
        $this->app->_admin = $admin;
    }
    public function eredmenyMent(){
        $return["status"] = 0;
        $data = [
            "vezeto"=>$_SESSION["teszt_userid"]
        ];
        if($this->app->DB->insert("lezart_ertekelesek",$data)){
            $return["status"] = 1;
            $this->app->DB->query("
            UPDATE 
                    dolgozok_ertekelesei 
            SET id_lezart_ertekelesek=:id_lezart_ertekelesek
            WHERE id_dolgozok IN(SELECT id FROM dolgozok WHERE vezeto=:id AND deleted=0) AND deleted=0 AND id_lezart_ertekelesek=0
            ")->params(["id_lezart_ertekelesek"=>$this->app->DB->last_insert_id(),"id"=>$_SESSION["teszt_userid"]])->exec();
        }
        return $return;
    }
}