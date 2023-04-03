<?php
namespace Teszt;
use Pachel\EasyFrameWork\Base;
use Pachel\EasyFrameWork\Routing;
use Teszt\Controllers\Controller;

session_start();
ob_start();
require __DIR__."/vendor/autoload.php";


$app = Base::instance();
$app->config(getConfig("app.php"));

$routing = Routing::instance();
$routing->get("*",[Controller::class,"mindig"]);
$routing->get("/",[Controller::class,"start"])->onlyone();
$routing->get("login",[Controller::class,"login"])->first();

$routing->postget("dolgozok",[Controller::class,"dolgozok"])->view("dolgozok.php");
$routing->postget("celok",[Controller::class,"celok"])->view("celok.php");

$routing->get("ertekeles",[Controller::class,"ertekeles"])->view("ertekeles.php");
$routing->ajax("ajax/dolgozolista",[Controller::class,"ajax_dolgozolista"])->json()->onlyone();
$routing->ajax("ajax/dolgozo",[Controller::class,"ajax_dolgozo"])->json()->onlyone();
$routing->ajax("ajax/ertekeles/ment",[Controller::class,"ajaxErtekelesMent"])->json()->onlyone();
$routing->ajax("ajax/ertekeles/torol",[Controller::class,"ajaxErtekelesTorol"])->json()->onlyone();
$routing->ajax("ajax/eredmeny/ment",[Controller::class,"eredmenyMent"])->json()->onlyone();


$routing->get("vegeredmeny",[Controller::class,"vegeredmeny"])->view("vegeredmeny.php");


$app->run();