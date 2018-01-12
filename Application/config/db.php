<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26.04.17
 * Time: 17:06
 */
//$db = new PDO('mysql:host=localhost;dbname=mvc;charset=UTF8', 'vlad',96443);
return [
    'mvc' => [
                'host'    => 'localhost',
                'dbname'  => 'mvc',
                'charset' => 'UTF8',
                'login'   => 'vlad',
                'pass'    =>  96443,
    ],

    'replica' => [
                'host'    => 'localhost',
                'dbname'  => 'replica',
                'charset' => 'UTF8',
                'login'   => 'vlad',
                'pass'    =>  96443,
    ],
];