<?php

namespace Core;

class Autoload {

    public static function autoload($className) {

        $filePath = str_replace(__NAMESPACE__ . '\\', '', $className);
        $filePath = str_replace('\\', '/', $filePath);
        $filePath .= '.php';

        var_dump('file ' . $filePath . ' will be include.');

        require_once($filePath);
    }

    public static function registerAutoloader() {
        spl_autoload_register(__NAMESPACE__ . '\\Autoload::autoload');
    }
}