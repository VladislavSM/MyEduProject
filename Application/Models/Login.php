<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 26.12.17
 * Time: 18:01
 */

namespace MVS\MyEduProject\Application\Models;

use MVS\MyEduProject\Core\Session;
use MVS\MyEduProject\Core\DataBase;
use \PDO;
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
/**If there is no DATABASE, the user is selected from the default array:
   $users = require_once '../Application/temp_data_base/users.php';
 */
                $result = $this->findUser($login, $pass);

                if (!empty($result)) {
                    $session = new Session();
                    $session->start();
                    Session::_set('identity', $result['username']);
                    $this->user = $result['username'];
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

    public function userLogout()
    {
        Session::close();
    }

    public function findUser($login, $pass)
    {
        $db = DataBase::getInstance();
        $db = $db->getConnection();
        $getUser = $db->prepare(
            'SELECT
                u.`username`, u.`password`
            FROM
                users u
            WHERE u.`username` = ?
               
                AND u.`status` != 0'
        );
        $getUser->execute([$login]);
        $user = $getUser->fetch(PDO::FETCH_ASSOC);
        if(password_verify($pass,$user['password'])===true){
            $result = $user;
        }else{
            $result = false;
        }
/**     If there is no DATABASE, the user is selected from the default array:
        foreach ($users as $user) {
            if (in_array($login, $user) && $pass === $user['password']) {
                return $user;
            } else {
                $user = false;
            }
            $result = $user;
        }
*/
        return $result;
    }
}