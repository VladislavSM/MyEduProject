<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 21.12.17
 * Time: 16:24
 */
function mvcAutoload($classname) {

    $filename = $classname .".php";
    require_once($filename);
}

spl_autoload_register('mvcAutoload');

