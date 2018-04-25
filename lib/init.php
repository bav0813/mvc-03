<?php

function devionityAutoload($class_name)
{
    $lib_path = ROOT.DS.'lib'.DS.strtolower($class_name).'.class.php';
    $controllers_path = ROOT.DS.'controllers'.DS.str_replace('controller', '', strtolower($class_name)).'.controller.php';
    $model_path = ROOT.DS.'models'.DS.strtolower($class_name).'.php';

    if (file_exists($lib_path)) {
        require_once($lib_path);
    }
    if ( file_exists($controllers_path) && !class_exists($class_name)) {
        require_once($controllers_path);
    }
    if ( file_exists($model_path) && !class_exists($class_name)) {
        require_once($model_path);
    }

//    else {
//        throw new Exception('Failed to include class: '.$class_name);
//    }
}

spl_autoload_register('devionityAutoload');

require_once(ROOT.DS.'config'.DS.'config.php');

function __($key, $default_value = '')
{
    return Lang::get($key, $default_value);
}
