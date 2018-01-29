<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 26.01.18
 * Time: 14:59
 */

namespace MVS\MyEduProject\Application\Models;
use MVS\MyEduProject\Core\Session;
use MVS\MyEduProject\Core\Config;

class Mail
{
    public $userId;

    public function toAdmin(){
        $config  = Config::getInstance();
        $toAdmin = $config->get('mail')['adminEmail'];

        return $toAdmin;
    }
    public function toUser(){

    }
    public function headers($from,$reply){
        $headers = 'Content-type: text/html; charset=utf-8 \r\n'.
                    'From: '.$from.' ' . "\r\n" .
                    'Reply-To:'.$reply.' ' . "\r\n" ;
        return $headers;
    }
    public function subject($subject){
        return $subject;
    }
    public function message($message){
        return $message;
    }

    public function subjectForOrder($name,$surename){
        $message = 'Заказ от :'.$name.' '.$surename.' ';
        return $message;
    }
    public function subjectForConfirmOrder(){
        $message = 'MyEduProject - Подтверждение заказа';
        return $message;
    }
    public function messageForOrder($params){
        ob_start();
        extract($params);
         require '../Application/views/sendmail/sendOrder.php';
         $message = ob_get_contents();
         ob_clean();
        return $message;
    }

}