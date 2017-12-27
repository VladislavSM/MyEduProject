<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 26.12.17
 * Time: 18:01
 */
class Login
{

public function userLogin()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $login = trim($_POST['login'],"/?;:,.!&%#@[]{}<>=~");
        $pass = trim($_POST['password'],"/?;:,.!&%#@[]{}<>=~");


        if (!empty($login) && !empty($pass)) {

// perform hashing when working with the database;
//            $pass = sha1($pass);
            $users = require_once '../application/temp_data_base/users.php';

            $result = $this->findUser($users,$login,$pass);


// execute query when working with the database;
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
//


            if (!empty($result)) {
                $_SESSION['identity'] = $result['login'];
                header('Location:/site/index');
            } else {
                $_SESSION['loginError'] = [
                    'login' => '<p class="errorinp">Неврный логин</p>',
                    'pass' => '<p class="errorinp">Неврный пароль</p>'
                ];
                header('Location:/site/login');
            }
        }
    }
}

    public function userLogout(){

    unset($_SESSION['identity']);
    unset($_SESSION['loginError']);
        header('Location:/site/index');
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