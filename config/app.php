<?php
return [
    "APP" => [
        "URL" => "http://localhost/teszt/",
        "UI" => __DIR__."/../ui/",
        "VIEWS" => __DIR__."/../views",
        "LOGS" => __DIR__."/../temp/logs",
        "TEMP" => __DIR__."/../temp",
        "TEST" => false,
        "title" => "Teszt értékelés",
    ],
    "MYSQL" => [
        "HOST" => "localhost",
        "database"=>"teszt",
        "username"=>"persons2",
        "password"=>"Jsx_Juz_cv.7867",
        "safemode"=>true,
        "safefield" => "deleted"
    ],
    "landing" => "vegeredmeny",
    //A minimum kitöltendő értékelések száma
    "min_ct"=>3,
    //A kitölthető célok maximális száma
    "max_ct"=>10
];
