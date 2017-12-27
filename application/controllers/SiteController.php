<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02.05.17
 * Time: 21:36
 */


require_once '../application/models/HomePage.php';
require_once '../application/models/Login.php';


class SiteController extends Controller
{

    public function actionIndex() {

        $model = new HomePage();
        $params['homePage'] = $model->getContent();


        $this->Render($this->template,$params);

  }

    public function actionLogin(){

        if(isset($_SESSION['identity'])){

            $this->goHome();
        }

        $authLogin = 'Введите логин';
        $authPass = 'Введите пароль';
        $color = 'darkslategrey';

        if (isset($_SESSION['loginError'])) {

            $authLogin = $_SESSION['loginError']['login'];
            $authPass = $_SESSION['loginError']['pass'];
            $color = 'darkred';
        }

        $model = new Login();
        $model->userLogin();
        $params['authLogin'] = $authLogin;
        $params['authPass'] = $authPass;
        $params['color'] = $color;

        $this->Render($this->template,$params);

    }

    public function actionLogout(){

        $model = new Login();
        $model->userLogout();
    }
}
