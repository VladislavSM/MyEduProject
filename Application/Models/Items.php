<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 25.12.17
 * Time: 17:15
 */
namespace MVS\MyEduProject\Application\Models;
use MVS\MyEduProject\Core\DataBase;
use MVS\MyEduProject\Core\Session;
use \PDO;

class Items
{
    public $item;
    public $images;
    public $path;

    public function findItems(){
        if (!empty($_POST)){
            $sellect = $_POST;
        }else{
            $sellect['sell'] = 'id';
        }
        $dataBase = DataBase::getInstance();
        $db = $dataBase->getConnection();
        $items = $db->prepare('
            SELECT i.`id`,i.`title`,i.`image`,i.`summury`,i.`price`,itc.`categoryId`
            FROM 
            item i 
            JOIN itemToCategory itc 
            ON 
            itc.`itemId` = i.`id`
            WHERE 
            itc.`categoryId` = ?
            ORDER BY i.'.$sellect['sell'].' '
        );
        if(array_key_exists('id',$_GET)){
            $categoryId = $_GET['id'];
        }else{
            $categoryId = 0;
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
        if(array_key_exists('id',$_GET)) {
            $itemId = $_GET['id'];
            $item->execute([$itemId]);
            $item = $item->fetch(PDO::FETCH_ASSOC);
        }else{
            $item = false;
        }
        return $item;
    }

    public function findComments(){
        $dataBase = DataBase::getInstance();
        $db = $dataBase->getConnection();
        $comments = $db->prepare('
            SELECT com.`content`,com.`commentsDate`,u.`name`,u.`surename`
            FROM 
            comments com 
            JOIN itemToComments itcom 
            ON 
            itcom.`commentsId`= com.`id`
            JOIN usersToComments utc
            ON
            utc.`commentsId`= com.`id`
            JOIN users u
            ON u.`id` = utc.`userId`
            WHERE 
            itcom.`itemId` = ?
            ORDER BY com.`commentsDate` DESC'
        );
        if(array_key_exists('id',$_GET)) {
            $itemId = $_GET['id'];
            $comments->execute([$itemId]);
            $comments = $comments->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $comments = false;
        }
        return $comments;
    }

    public function didTheUserBuyThisProduct(){
        $dataBase = DataBase::getInstance();
        $db = $dataBase->getConnection();
        $result = $db->prepare('
            SELECT u.`id`
            FROM 
            users u 
            JOIN orders o  
            ON 
            o.`userId`= u.`id`
            JOIN itemToOrder ito 
            ON
            ito.`orderId`= o.`id`
            WHERE 
            ito.`itemId` = ?
            AND 
            u.`username` = ?'
        );
        if(array_key_exists('id',$_GET) && !false == Session::get('identity')) {
            $itemId = $_GET['id'];
            $userName = Session::get('identity');
            $result->execute([$itemId,$userName]);
            $result = $result->fetch(PDO::FETCH_ASSOC);
        }else{
            $result = false;
        }
        return $result;

    }

    public function addComment(){
        if(!empty($_POST)){
            $comment = $_POST;
            $comment['comment'] = strip_tags(trim($comment['comment']));
//            var_dump($comment);die;
            $dataBase = DataBase::getInstance();
            $db = $dataBase->getConnection();
            $result = $db->prepare('
                            INSERT INTO comments (content)
                            VALUES(?)');
            $result->execute([$comment['comment']]);
            $thisComment = $db->prepare('
                            SELECT id
                            FROM comments
                            WHERE content = ?
                            ');
            $thisComment->execute([$comment['comment']]);
            $thisComment = $thisComment->fetch(PDO::FETCH_ASSOC);
//            var_dump($thisComment);die;
            $result2 = $db->prepare('
                            INSERT INTO itemToComments (itemId,commentsId)
                            VALUES(?,?)');
            $result2->execute([$comment['id'],$thisComment['id']]);
            $result3 = $db->prepare('
                            INSERT INTO usersToComments (userId,commentsId)
                            VALUES(?,?)');
            $result3->execute([$comment['userId'],$thisComment['id']]);

            $message = true;
        }
        else{
            $message = false;
        }
        return $message;
    }

    public function search(){
        if (!empty($_POST)){
//            var_dump($_POST);die;
            $usersQuery = strip_tags(trim($_POST['searchQuery']));
            $usersQuery = explode(' ',$usersQuery);

            $usersQuery = $this->filter($usersQuery);
//            var_dump($usersQuery);die;
            foreach ($usersQuery as $value) {
                $query[] = "`description` LIKE '%" . $value . "%'";
            }
            $queryStr =  implode(' OR ', $query);
            $dataBase = DataBase::getInstance();
            $db = $dataBase->getConnection();
            $result = $db->prepare('
                                    SELECT id, title, price, image
                                    FROM item
                                    WHERE '.$queryStr.' ');
            $result->execute();
            $result = $result->fetchAll(PDO::FETCH_ASSOC);


        }else{
            $result = false;
        }
//        var_dump($result);die;
        return $result;
    }
    public function offerOfGoods(){
        $dataBase = DataBase::getInstance();
        $db = $dataBase->getConnection();
        $result = $db->prepare('
                                    SELECT id, title, price, image, summury
                                    FROM item
                                    WHERE `id` IN (1,5,6,7,13,17,22,27)');
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }



    public function findPath($path){
        if(array_key_exists('id',$_GET)) {
            $itemId = $_GET['id'];
            $this->path = $path . $itemId;
        }
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

    public function filter($array)
    {
        for($i = 0, $c = count($array); $i < $c; $i++)
        {
            if(mb_strlen($array[$i]) < 3)
                unset($array[$i]);
        }
        return $array;
    }
}