<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 21.01.18
 * Time: 11:15
 */

namespace MVS\MyEduProject\Application\Models;

use MVS\MyEduProject\Core\Session;
use MVS\MyEduProject\Core\DataBase;
use \PDO;

class Registr
{
    const STATUS_USER = 1;
    public $user;

    public function userReg()
    {
        $this->user = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $login = trim($_POST['login']);
            $pass = trim($_POST['password']);
            $repPass = trim($_POST['rpassword']);
            $email = trim($_POST['email']);
            $name = trim($_POST['name']);
            $sureName = trim($_POST['surename']);
            $phone = trim($_POST['phone']);
            $phone2 = trim($_POST['phone2']);
            $status = self::STATUS_USER;
            $dateOfRegistr = time();
            $password = password_hash($pass, PASSWORD_DEFAULT);

            if ($pass === $repPass) {
                $result = $this->findUniqueUser($login);
                if ($result !== false) {
                    $this->user = 'non-unique';
                }
                if (strpos($email, '@') === false) {
                    $this->user = 'erroremail';
                }
                $user = $this->setUser($login, $password, $email, $name, $sureName, $phone, $phone2, $status, $dateOfRegistr);
                $this->user = $user;
                if ($this->user) {
                    $session = new Session();
                    $session->start();
                    Session::set('identity', $login);
                    $this->user = 'new-user';
                }
            } else {
                $this->user = 'password does not match';
            }
        }
        return $this->user;
    }

    public function setUser($login, $password, $email, $name, $sureName, $phone, $phone2, $status, $dateOfRegistr){
        $db = DataBase::getInstance();
        $db = $db->getConnection();
        $setUser = $db->prepare(
            'INSERT INTO users (username, password, name, surename, 
                                         email, phone, phone2, status, dateOfRegistr)
                       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)'
        );
        $setUser->execute([$login, $password, $email, $name, $sureName, $phone, $phone2, $status, $dateOfRegistr]);
        $this->user = $setUser;

        return $this->user;
    }


    public function findUniqueUser($login)
    {
        $db = DataBase::getInstance();
        $db = $db->getConnection();
        $getUser = $db->prepare(
            'SELECT
                u.`username`
            FROM
                users u
            WHERE u.`username` = ?
               
            AND u.`status` != 0'
        );
        $getUser->execute([$login]);
        $user = $getUser->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
}