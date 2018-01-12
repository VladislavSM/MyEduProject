<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 05.06.17
 * Time: 20:15
 */
/**
 * public $defaultAction = 'index'; is determined in this class Controller,
 * You can override yous public $defaulAction in in the desired controller.
 */
namespace MVS\MyEduProject\Core;

class Controller
{
    protected $template;
    public $actionName;
    public $defaultAction = 'index';

    public function __construct($name) {


        $request = Request::getInstance();
        $actionName = $request->getParam('action');
        $this->dirName = substr($name,0, -10);
        if(empty($actionName)) {
            $this->actionName = $this->defaultAction;
        }else{
            $this->actionName = $actionName;
        }

        $this->setTemplate();
        $this->init();


    }

    protected function init() {}

    protected function setTemplate() {
        $this->template = APP_PATH . 'views'.DS. $this->dirName . DS . $this->actionName . '.php';
    }

    public function Render($template,$params){
        $view = new View($template, $params);
        $view->render();
    }

    public function goHome(){

        header('Location:/site/index');
    }

}