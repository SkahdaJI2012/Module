<?php

require_once 'vendor'. DIRECTORY_SEPARATOR . 'autoload.php';

function load_model($class_name)
{
    $path_to_file = '.' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';
    if (file_exists($path_to_file)) {
        require_once $path_to_file;
    }
}
spl_autoload_register('load_model');
