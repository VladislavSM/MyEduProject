<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.04.17
 * Time: 18:09
 */

//require_once 'Route.php';
namespace core;

use Exception;
use application\controllers\ErrorsController;
class Dispatcher
{

    /**
     * @param $controllerName
     * @throws Exception
     * @return object
     */
    public function getController($controllerName) {
        if(empty($controllerName)) {
            throw new Exception('Can\'t dispatch empty controller name');
        } else {
            $route = new Route();
            $origin = ucfirst($route->getOrigin($controllerName) ?: $controllerName);
            $origin = $origin.'Controller';
            $path = APP_PATH . 'controllers' . DS . $origin .'.php';
            $nameSpace = 'application\controllers\\';
            $className = $nameSpace.$origin;

            if (!$this->isExist($className, $path)) {
                $controller = new ErrorsController('errors');
                $controller->actionErrors();
                 header('HTTP/1.0 404 Not Found'); die;
            } else {
                $result = new $className(strtolower($origin));
            }
            return $result;
        }
    }

    public function getAction($actionName,$controllerName){

        if(empty($actionName)){
            $controller = $this->getController($controllerName);
            $controller = (array)$controller;
            $actionName = 'action'.ucfirst($controller['defaultAction']);
        }else{
            $actionName = 'action'.ucfirst($actionName);
        }
        return $actionName;
    }


    private function isExist($name, $path) {
        $result = true;

        if (!file_exists($path)) {
            $result = false;
        } else {
            require_once $path;

            if(!class_exists($name,true)){
                $result = false;
            }
        }
        return $result;
    }
}