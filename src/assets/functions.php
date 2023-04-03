<?php
function getConfig($file){
    $file_dev = __DIR__."/../../config/dev_".$file;
    $file = __DIR__."/../../config/".$file;
    if(file_exists($file_dev)){
        return $file_dev;
    }
    if(!file_exists($file)){
        throw new Exception("Nincs meg a fájl: ".$file_dev);
    }
    return $file;
}
