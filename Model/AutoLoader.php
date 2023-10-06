<?php

namespace Model;
require '../Model/AutoLoader.php';
Autoloader::register();
class AutoLoader
{
    static function register(){
        spl_autoload_register(self::autoload());
    }
    static function autoload($class){
        require 'class/' . $class . '.php';
    }
}