<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 25.12.17
 * Time: 17:15
 */
namespace MVS\MyEduProject\Application\Models;
use MVS\MyEduProject\Core\DataBase;
use \PDO;

class Items
{
    public $item;
    public $images;
    public $path;

    public function findItems(){
        $dataBase = DataBase::getInstance();
        $db = $dataBase->getConnection();
        $items = $db->prepare('
            SELECT i.`id`,i.`title`,i.`image`,i.`summury`,i.`price`
            FROM 
            item i 
            JOIN itemToCategory itc 
            ON 
            itc.`itemId` = i.`id`
            WHERE 
            itc.`categoryId` = ?
            GROUP BY i.`id`'
        );
        if(array_key_exists('id',$_GET)){
            $categoryId = $_GET['id'];
        }
        $items->execute([$categoryId]);
        $items = $items->fetchAll(PDO::FETCH_ASSOC);
        return $items;
    }

    public function findItem(){
        $dataBase = DataBase::getInstance();
        $db = $dataBase->getConnection();
        $item = $db->prepare('
            SELECT i.`id`,i.`title`,i.`image`,i.`description`,i.`price`
            FROM 
            item i 
            WHERE 
            i.`id` = ?'
        );
        if(array_key_exists('id',$_GET)){
            $itemId = $_GET['id'];
        }
        $item->execute([$itemId]);
        $item = $item->fetch(PDO::FETCH_ASSOC);
        return $item;


//        $result = false;
//        $items = require_once '../Application/temp_data_base/stock.php';
//        foreach ($items as $item){
//            if(in_array($_GET['id'],$item)){
//                return $item;
//            }else{
//                $item = false;
//            }
//            $result = $item;
//        }
//        return $result;
    }
    public function findPath($path){
        if(array_key_exists('id',$_GET)){
            $itemId = $_GET['id'];
        }
        $this->path = $path . $itemId;

        return $this->path;
    }

    public function viewImage() {

        if (!is_dir($this->path)) {
            $this->path = 'image/';
            $this->images = $this->path.'not_image.gif';

        }else {
            $this->images = $this->findFiles($this->path);
        }

        return $this->images;
    }

    public function findFiles($path){
        $files = scandir($path);
                foreach ($files as  $file){
                   if ($file !== '.' && $file !== '..' ) {
                       $this->images[] = $file;
                   }
               }
        return $this->images;
    }
}