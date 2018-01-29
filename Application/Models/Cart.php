<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 26.12.17
 * Time: 15:27
 */
namespace MVS\MyEduProject\Application\Models;
use MVS\MyEduProject\Core\DataBase;


class Cart
{
    public function viewOrder($userId,$status){
        $db = DataBase::getInstance();
        $db = $db->getConnection();
        $query = $db->prepare('SELECT o.`id`,o.`userId`,o.`date_order`,o.`status`,ito.`orderId`,
                                                ito.`itemId`,ito.`price`,ito.`quantity`,ito.`sumForItem`,
                                                it.`title`,it.`image`
                                         FROM orders o
                                         LEFT JOIN itemToOrder ito ON o.`id`=ito.`orderId`
                                         JOIN item it ON ito.`itemId`=it.`id`
                                         WHERE o.`userId`=?
                                         AND o.`status`=?');
        $query->execute([$userId,$status]);
        $newOrder = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $newOrder;
    }

    public function findOrder($status,$userId){
        $db = DataBase::getInstance();
        $db = $db->getConnection();
        $query = $db->prepare('SELECT id
                                         FROM orders
                                         WHERE `userId`=?
                                         AND `status`=?');
        $query->execute([$userId,$status]);
        $id = $query->fetch(\PDO::FETCH_ASSOC);

        return $id;
    }

    public function countItem($orderId){
        $db = DataBase::getInstance();
        $db = $db->getConnection();
        $query = $db->prepare('SELECT SUM(quantity)
                                         AS amount,
                                         SUM(sumForItem)
                                         AS totalsum
                                         FROM itemToOrder
                                         WHERE `orderId`=?');
        $query->execute([$orderId]);
        $count = $query->fetch(\PDO::FETCH_ASSOC);
        return $count;
    }

    public function delete($orderId, $itemId){
        $db = DataBase::getInstance();
        $db = $db->getConnection();
        $query = $db->prepare('DELETE FROM itemToOrder
                                         WHERE `orderId`=?
                                         AND `itemId`=?');
        $query->execute([$orderId, $itemId]);

    }
    public function update($orderId, $itemId, $count,$price){
        $db = DataBase::getInstance();
        $db = $db->getConnection();
        $query = $db->prepare('UPDATE itemToOrder
                                        SET quantity = ?,
                                            sumForItem = ?
                                         WHERE `orderId`=?
                                         AND `itemId`=?
                                         ');
        $query->execute([$count,$price*$count,$orderId, $itemId]);

    }


}