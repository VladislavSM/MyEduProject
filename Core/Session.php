<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 03.01.18
 * Time: 11:16
 */
namespace MVS\MyEduProject\Core;

use Exception;

class Session
{

      public  function setSessionSavePath($path)
    {
        if (is_dir($path)) {
            session_save_path($path);
        } else {
            throw new Exception("Session save path is not a valid directory: $path");
        }
    }

    public function start(){
        session_start();

    }
    public function identitySession(){

        if (!isset($_SESSION['time'])) {
            $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
            $_SESSION['time'] = date("H:i:s");
        }

        if ($_SESSION['userAgent'] != $_SERVER['HTTP_USER_AGENT']) {
            die('You are denied access. This is not your session');
        }
    }

    public static function _set($key,$value)
    {
        $_SESSION[$key]= $value;

    }
    public static function _get($key)
    {
        $result = false;

        if(isset($_SESSION[$key])){
            $result = $_SESSION[$key];
        }

        return $result;
    }

    public static function close(){
        unset($_SESSION);
        setcookie('PHPSESSID',"",time()-3600,'/');
        session_destroy();
    }

}