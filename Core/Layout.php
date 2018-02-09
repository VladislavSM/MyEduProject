<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 15.05.17
 * Time: 19:03
 */
namespace MVS\MyEduProject\Core;

class Layout
{
    private $header = APP_PATH . 'layout' . DS . 'header.php';
    private $footer = APP_PATH . 'layout' . DS . 'footer.php';
    private $adminHeader = APP_PATH . 'layout' . DS . 'adminheader.php';
    private $adminFooter = APP_PATH . 'layout' . DS . 'adminfooter.php';
    protected $controllerName;
    public static  $pageTitle;

    public function __construct(){

        $request = Request::getInstance();

        $this->controllerName = $request->getParam('controller');
    }

    public function compose($content) {
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