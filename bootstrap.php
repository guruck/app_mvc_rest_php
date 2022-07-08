<?php
require_once __DIR__ . '/src/autoloader.php';
Autoloader::init();

use Lib\Configuration as Config;
 
try {
    Config::init();
    require __DIR__ . '/routes/routes.php';
 
} catch(\Exception $e){
     
    echo $e->getMessage();
}