<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 21.12.17
 * Time: 16:24
 */


spl_autoload_register(function ($className) {
    // Получаем путь к файлу из имени класса
    $path = __DIR__. DS . str_replace("\\","/",$className) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
  });


