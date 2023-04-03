<?php
namespace Teszt\Models;

use  Pachel\EasyFrameWork\DB\Models\dataModel;
/**
 * @generated by EasyFramework 2023-03-28 07:24:20
 * @author https://github.com/pachel
 **/
class dolgozokModel extends dataModel{
    //A(z) dolgozok tábla elsődleges kulcsa az adatbázisban
    protected string $_primary = "id";
    //Az SQL tábla neve
    protected string $_tablename = "dolgozok";
    //A SELECT lekérdezésben láthatatlan mezők nevei
    protected array $_not_visibles = [];
    //Biztonságos mód a törléshez, ha ez true, akkor a mezőt is be kell állítani
    protected bool $_safemode = true;
    ///A törléshez használt mező, ami a biztonságos törlésnél 1-es értéket vesz fel
    protected string $_safefield = "deleted";
    //Az adatmodel osztály neve
    protected string $_modelclass = dolgozokDataModel::class;
}
class dolgozokDataModel{
    /**
     * key:     PRI
     * extra:   auto_increment
     * @var int $id NOT NULL
     **/
    public int $id;
    public int $deleted;
    public string $nev;
    public string $munkakor;
    public int $torzsszam;
    public int $vezeto;
}