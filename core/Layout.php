<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 15.05.17
 * Time: 19:03
 */
class Layout
{
    private $header = APP_PATH . 'layout' . DS . 'header.php';
    private $footer = APP_PATH . 'layout' . DS . 'footer.php';
    private $adminHeader = APP_PATH . 'layout' . DS . 'adminheader.php';
    private $adminFooter = APP_PATH . 'layout' . DS . 'adminfooter.php';
    protected $controllerName;
    protected $menu;
    public $form;
    public static  $pageTitle;
//    public function viewTemplate(){
//        require_once APP_PATH . 'views' . DS . 'template.phtml';
//    }

    public function __construct(){

        $request = Request::getInstance();

        $this->controllerName = $request->getParam('controller');
//        $result = require APP_PATH . 'views' . DS . $controllerName. '.phtml';
//        return $this->controllerName;

    }
//    public function viewMenu(){
//        $menu = new Menu();
//        $this->menu = $menu->getMenu();
//        return $this->menu;
//
//    }
//    public function viewForm(){
//        $menu = new Menu();
//        $this->form = $menu->getAuth();
//        return $this->form;
//    }


    public function compose($content) {
//        $this->viewPage();
        if ($this->controllerName === "admin"){
            require_once $this->adminHeader;
            echo $content;
            require_once $this->adminFooter;
        }else {
            require_once $this->header;
            echo $content;
            require_once $this->footer;
        }

    }

}