<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02.05.17
 * Time: 21:36
 */
namespace MVS\MyEduProject\Application\Controllers;

use MVS\MyEduProject\Core\Controller;
use MVS\MyEduProject\Core\Session;
use MVS\MyEduProject\Application\Models\Login;
use MVS\MyEduProject\Application\Models\HomePage;

class SiteController extends Controller
{

    public function actionIndex() {
        $model = new HomePage();
        $params['homePage'] = $model->getContent();

        $this->Render($this->template,$params);
  }

    public function actionLogin(){

        if(Session::_get('identity') !== false){
            $this->goHome();
        }
        $authLogin = 'Введите логин';
        $authPass = 'Введите пароль';
        $color = 'darkslategrey';

        $model = new Login();
        $model->userLogin();
        if($model->user !==false && $model->user !=='unknown'){
            $this->goHome();
        }
        if($model->user === 'unknown'){
            $authLogin = 'Неверный логин';
            $authPass = 'Неверный пароль';
            $color = 'darkred';
        }
        $params['authLogin'] = $authLogin;
        $params['authPass'] = $authPass;
        $params['color'] = $color;

        $this->Render($this->template,$params);


    }

    public function actionLogout(){

        $model = new Login();
        $model->userLogout();
        $this->goHome();
    }
}
