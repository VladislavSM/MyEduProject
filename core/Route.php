<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26.04.17
 * Time: 17:40
 */

//namespace Mvc\Core;

//use \Exception;

class Route {

    public function getOrigin($alias) {

        if(empty($alias)) {
            throw new Exception('Unacceptable condition');
        } else {
            $origin = false;
            $configs = Config::getInstance();
            $routes = $configs->get('routes');
//            $routes = $routes['routes'];
//            $routes = require APP_PATH . DS . 'configs' . DS . 'routes.php';

            if (array_key_exists($alias, $routes)) {
                $origin = $routes[$alias];
            }

            return $origin;
        }
    }
}