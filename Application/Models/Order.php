<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 26.12.17
 * Time: 15:47
 */
namespace MVS\MyEduProject\Application\Models;

class Order
//          extends ActiveRecord
{
//    public $item;
//    /**
//     * const ORDER_CLOSED = 4(order DELIVERED and PAID FOR);
//     */
//    const ORDER_OPEN = 1;
//    const SENT_BY_CUSTOMER = 2;
//    const ORDER_ASSEMBLE = 3;
//    const ORDER_CLOSED = 4;
//
//    public static function tableName()
//    {
//        return 'orders';
//    }
//
//    public function rules()
//    {
//        return [
//            [['userId'],'integer'],
//            [['status'],'integer']
//
//        ];
//    }
//    public function afterSave($insert, $changedAttributes)
//    {
//        parent::afterSave($insert, $changedAttributes);
//        $this->item = Yii::$app->request->post();
//        $itemToOrder = new ItemToOrder();
//        $itemToOrder->orderId = $this->id;
//        $itemToOrder->itemId = $this->item['id'];
//        $itemToOrder->price = $this->item['price'];
//        $itemToOrder->quantity = $this->item['count'];
//        $itemToOrder->sumForItem = $this->item['count']*$this->item['price'];
//        $itemToOrder->save();
//
//
//    }
//
//    public function  findId($userId)
//    {
//        return (new \yii\db\Query())
//            ->select('id')
//            ->from('orders')
//            ->where('userId=:userId',[':userId'=>$userId])
//            ->scalar();
//    }
//
}