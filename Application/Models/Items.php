<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 25.12.17
 * Time: 17:15
 */
namespace MVS\MyEduProject\Application\Models;


class Items
{

    public function findItems(){
        $items = require_once '../Application/temp_data_base/stock.php';
        return $items;
    }

    public function findItem(){

        $result = false;
        $items = require_once '../Application/temp_data_base/stock.php';
        foreach ($items as $item){
            if(in_array($_GET['id'],$item)){
                return $item;
            }else{
                $item = false;
            }
            $result = $item;
        }
        return $result;
    }
}