<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 03.05.17
 * Time: 14:48
 */
namespace MVS\MyEduProject\Application\Controllers;

use MVS\MyEduProject\Core\View;
use MVS\MyEduProject\Core\Controller;
class ErrorsController extends Controller
{
    public function actionErrors() {
        $params['title'] = 'Error 404 Not Found';

        $params['alert'] = 'This page not found. ' . PHP_EOL . 'Please return to';
        $params['linkTitle'] = 'Home page';

        $this->template = APP_PATH . 'views'.DS. 'errors' . DS . 'errors' . '.php';
        $view = new View($this->template, $params);
        header("HTTP/1.0 404 Not Found");
        $view->render();
    }
}