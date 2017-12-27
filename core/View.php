<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 28.05.17
 * Time: 22:21
 */
class View
{
//    private $path =  '/../application/views/';
    public function __construct($template, $params) {
//        var_dump($params);
        $this->template = $template;
        $this->params = $params;

    }

    public function render() {
        extract($this->params);
//        var_dump (extract($this->params));
        require_once $this->template;


    }

}