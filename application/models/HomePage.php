<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 06.06.17
 * Time: 17:20
 */

namespace application\models;


class HomePage

{
    public $content= 'Добро пожаловать в наш магазин!';


    public function getContent() {
        return $this->content;
    }


}