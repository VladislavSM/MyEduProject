<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 26.12.17
 * Time: 18:01
 */
namespace application\models;
use core\Session;
class Login
{
    public $user = false;

    public function userLogin()
    {
        $this->user = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $login = trim($_POST['login']);
        $pass = trim($_POST['password']);


        if (!empty($login) && !empty($pass)) {

/** perform hashing when working with the database;
 */
//            $pass = sha1($pass);
            $users = require_once '../application/temp_data_base/users.php';

            $result = $this->findUser($users, $login, $pass);

/** execute query when working with the database;
 */
//            $getUser = $db->prepare(
//                'SELECT
//                u.`login`, u.`password`
//            FROM
//                users u
//            WHERE u.`login` = ?
//                AND u.`password` = ?
//                AND u.`status` != 0'
//            );
//            $getUser->execute([$login,$pass]);
//            $result = $getUser->fetch();

            if (!empty($result)) {
                $session = new Session();
                $session->start();
                Session::_set('identity', $result['login']);
                $this->user = $result['login'];
            } else {
                $this->user = 'unknown';
                Session::_set('loginError', [
                    'login' => '<p class="errorinp">Неврный логин</p>',
                    'pass' => '<p class="errorinp">Неврный пароль</p>'
                ]);
            }
        }
    }
    return $this->user;
}

    public function userLogout(){

        Session::close();
    }

    public function findUser($users,$login,$pass){

        $result = false;
        foreach ($users as $user){
            if(in_array($login, $user) && $pass === $user['password'])
            {
                return $user;
            }else{
                $user = false;
            }
            $result = $user;
        }
        return $result;
    }
}