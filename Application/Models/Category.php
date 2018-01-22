<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 18.01.18
 * Time: 17:15
 */

namespace MVS\MyEduProject\Application\Models;

use MVS\MyEduProject\Core\DataBase;
use \PDO;
class Category
{
    public function findCategories()
    {
        $dataBase = DataBase::getInstance();
        $db = $dataBase->getConnection();
        $categories = $db->prepare(
            'SELECT 
            c.`id`,c.`parentID`,c.`title`,c.`image`,sc.`parentId`as `child`
            FROM
            category c 
            LEFT JOIN 
            category sc 
            ON c.`id` = sc.`parentId`
            WHERE c.`parentId`= ?
            GROUP BY c.`id`'
        );
        if(array_key_exists('id',$_GET)){
            $parentId = $_GET['id'];
        }else{
            $parentId = 0;
        }
        $categories->execute([$parentId]);
        $categories = $categories->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }
}