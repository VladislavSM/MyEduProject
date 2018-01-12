<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.04.17
 * Time: 18:17
 */

//    ini_set('display_errors', 1);
//    ini_set('display_startup_errors', 1);
//    error_reporting(E_ALL);

    define('DS', DIRECTORY_SEPARATOR);
    define('APP_PATH', '..' . DS . 'application' . DS);

    require(__DIR__ .DS.'core'.DS.'autoload.php');

    session_save_path('..' . DS . 'session');
    session_start();

    $bootstrap = Bootstrap::getInstance();
//    $bootstrap = new Bootstrap;


