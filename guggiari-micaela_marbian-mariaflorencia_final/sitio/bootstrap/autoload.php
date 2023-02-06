<?php

spl_autoload_register(function($className) {
    $className = substr($className, 8);
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $filename = __DIR__ . '/../classes/' . $className . '.php';
    if(file_exists($filename)) {
        require_once $filename;
    }
});