<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 21.12.17
 * Time: 16:24
 */

spl_autoload_register(function ($className) {

    $prefix = 'MVS\\MyEduProject\\';
    $base_dir = __DIR__ . '/';

    $length = strlen($prefix);
    if (strncmp($prefix, $className, $length) !== 0) {
        return;
    }
    $realClassName = substr($className, $length);
    $file = $base_dir . str_replace('\\', '/', $realClassName) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});