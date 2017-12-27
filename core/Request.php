<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.04.17
 * Time: 17:58
 */

class Request
{
    /**
     * @var
     * $params = [
     *      'get'  => [],
     *      'post' => [],
     *      'own'  => [],
     *      'route'  => [
     *          'controller' => '',
     *      ],
     * ]
     */
    protected $params;
    protected static $instance;

    private function __construct() {
//        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//            $this->params['post'] = $_POST;
//        }

//var_dump()

        $uriString = strtolower(ltrim($_SERVER['REQUEST_URI'],'/')) ?: 'site';

        $uri = explode('/', $uriString);
        $this->params['route']['controller'] = array_shift($uri);
        $this->params['route']['action'] = array_shift($uri);


//        foreach ($uri as $key => $value) {
//            $key = array_shift($uri);
//            if (!empty($key)) {
//                $this->params['get'] [$key] = array_shift($uri);
//            }
//        }

}

//    public function setParam($own){
//        $this->params['own'] = $own;
//    }

    public function getParams() {
        return $this->params;
    }

    public function getParam($item) {
        $result = $this->search($item, $this->params);
        return $result;
    }


    protected function search($needle, $haystack) {
        $result = false;
        foreach ($haystack as $key => $value) {
            if ($needle === $key) {
                $result = $value;
            } else {
                if (is_array($value)) {
                   $rresult = $this->search($needle, $value );
                   if ($rresult) {
                       $result = $rresult;
                   }
                }
            }
        }
        return $result;
    }

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





}

