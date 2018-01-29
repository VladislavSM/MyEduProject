<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 26.12.17
 * Time: 15:47
 */
namespace MVS\MyEduProject\Application\Models;
use MVS\MyEduProject\Core\DataBase;

class Order
{
    public $item;
    /**
     * const ORDER_CLOSED = 4(order DELIVERED and PAID FOR);
     */
    const ORDER_OPEN = 1;
    const SENT_BY_CUSTOMER = 2;
    const ORDER_ASSEMBLE = 3;
    const ORDER_CLOSED = 4;

    public function findOrder($id,$status)
    {
        $db = DataBase::getInstance();
        $db = $db->getConnection();
        $query = $db->prepare('SELECT id, userId, status
                                         FROM orders
                                         WHERE `userId`=?
                                         AND `status`=?');
        $query->execute([$id,$status]);
        $order = $query->fetch(\PDO::FETCH_ASSOC);

        return $order;
    }

    public function saveOrder($id,$status,$item){
        $order = $this->findOrder($id,$status);
        if ($order !== false){
            $this->afterSave($order,$item);
            return true;
        }else{
            $db = DataBase::getInstance();
            $db = $db->getConnection();
            $query = $db->prepare(
                'INSERT INTO orders (userId, status)
                           VALUES(?,?)');
            $query->execute([$id, $status]);
            $order = $this->findOrder($id,$status);
            $this->afterSave($order,$item);
        }

        return true;
    }

    public function afterSave($order, $item)
    {
        $db = DataBase::getInstance();
        $db = $db->getConnection();
        $query = $db->prepare(
            'INSERT INTO itemToOrder (orderId, itemId, price, quantity, sumForItem)
                      VALUES(?,?,?,?,?)');
        $query->execute([$order['id'],$item['id'],$item['price'],$item['count'], $item['price']*$item['count']]);
        $order =$query;

        return $order;
    }
    public function updateAfterOrdering($orderStatus, $orderAddress, $userName,$userSurename,$userEmail,
                                        $userPhone, $userPhone2, $orderId){
        $db = DataBase::getInstance();
        $db = $db->getConnection();
        $query = $db->prepare('UPDATE orders AS o ,users AS u
                                        SET o.`status` = ?,
                                            o.`address`= ?,
                                            u.`name` = ?,
                                            u.`surename` = ?,
                                            u.`email` = ?,
                                            u.`phone` = ?,
                                            u.`phone2` = ?
                                         WHERE o.`id`= ?
                                         AND   o.`userId`=u.`id`
                                         ');
        $query->execute([$orderStatus,$orderAddress,$userName,$userSurename,$userEmail,$userPhone,
                         $userPhone2,$orderId]);
        return true;
    }


}