<?php

spl_autoload_register('classLoader');

function classLoader($class) {
    $path = "../classes/";
    $extension = ".class.php";
    $fullPath = $path . $class . $extension;

    include_once $fullPath;

}
