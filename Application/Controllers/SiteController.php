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
use MVS\MyEduProject\Application\Models\Registr;

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

    public function actionReg()
    {
        $authLogin = 'Введите логин*';
        $authRepPass = 'Повторите пароль*';
        $authEmail = 'Введите Ваш адрес электронной почты*';
        $colorLog = 'black';
        $colorRP = 'black';
        $colorEm = 'black';
        $model = new Registr;
        $model->userReg();
        if ($model->user === 'password does not match'){
            $authRepPass = 'Повторный пароль несоответствует первому паролю!  ';
            $colorRP = 'darkred';
        }
        if ($model->user === 'non-unique'){
            $authLogin = 'Введенный Вами Логин занят, введите другой! ';
            $colorLog = 'darkred';
        }
        if ($model->user === 'erroremail'){
            $authEmail = 'Ошибка ввода,проверьте правильность!';
            $colorEm = 'darkred';
        }
        if($model->user === 'new-user'){
            $this->goHome();
        }

        $params['authLogin'] = $authLogin;
        $params['authPass'] = 'Введите пароль*';
        $params['authRepPass'] = $authRepPass;
        $params['authName'] = 'Введите Ваше Имя';
        $params['authSureName'] = 'Введите Вашу фамилию';
        $params['authEmail'] = $authEmail;
        $params['authPhone'] = 'Введите Ваш номер телефона*';
        $params['authPhone2'] = 'Введите дополнительный номер телефона';
        $params['colorLog'] = $colorLog;
        $params['colorRP'] = $colorRP;
        $params['colorEm'] = $colorEm;

        $this->Render($this->template,$params);

    }


}
