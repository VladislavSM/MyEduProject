<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 28.05.17
 * Time: 22:21
 */
namespace MVS\MyEduProject\Core;

class View
{
    public function __construct($template, $params)
    {
        $this->template = $template;
        $this->params = $params;

    }

    public function render()
    {
        extract($this->params);
        require_once $this->template;
    }

}