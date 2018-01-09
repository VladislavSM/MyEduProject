<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 21.12.17
 * Time: 19:32
 */
namespace core;

use application\controllers\ErrorsController;

class Bootstrap
{
    protected static $instance;

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    private function __clone() {
    }
    private function __wakeup() {
    }



    public function __construct()
    {
        $request = Request::getInstance();
        $controllerName = $request->getParam('controller');
        $actionName = $request->getParam('action');
        $dispatcher = new Dispatcher();
        $controller = $dispatcher->getController($controllerName);
        $action = $dispatcher->getAction($actionName, $controllerName);
        if (method_exists($controller, $action)) {
            $session = new Session();
            $session->setSessionSavePath('../session');
            if(isset($_COOKIE['PHPSESSID'])){
                $session->start();
                $session->identitySession();
            }
            ob_start();
            $controller->$action();
            $content = ob_get_contents();
            ob_end_clean();
            $layout = new Layout();
            $layout->compose($content);

        } else {
            $controller = new ErrorsController('errors');
            $controller->actionErrors();
        }




    }
}