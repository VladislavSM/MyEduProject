<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.04.17
 * Time: 18:09
 */

require_once 'Route.php';

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

            if (!$this->isExist($origin, $path)) {
                require_once '../application/controllers/ErrorsController.php';
                $controller = new Errors('errors');
                $controller->actionErrors();
                 header('HTTP/1.0 404 Not Found'); die;
            } else {
                $result = new $origin(strtolower($origin));
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

            if(!class_exists($name)){
                $result = false;
            }
        }

        return $result;
    }
}