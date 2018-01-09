<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 26.12.17
 * Time: 15:27
 */
namespace application\models;


class Cart
//         extends ActiveRecord

{

//    public $number;
//
//    public function viewOrder($userId,$status){
//
//        return (new \yii\db\Query())
//            ->select(['or.id','or.userId','or.date_order','or.status','ito.orderId','ito.itemId','ito.price','ito.quantity','ito.sumForItem',
//                'it.title','it.image'])
//            ->from('orders or')
//            ->leftJoin('itemToOrder ito','or.id=ito.orderId')
//            ->innerJoin('item it','ito.itemId=it.id')
//            ->where('or.userId=:userId',[':userId'=>$userId])
//            ->andWhere(['or.status'=>$status])
//            ->all();
//
//    }
//
//    public function viewOrders($id){
//
//        return (new \yii\db\Query())
//            ->select(['or.id','or.userId','or.date_order','or.status','ito.orderId','ito.itemId','ito.price','ito.quantity','ito.sumForItem',
//                'it.title','it.image'])
//            ->from('orders or')
//            ->leftJoin('itemToOrder ito','or.id=ito.orderId')
//            ->innerJoin('item it','ito.itemId=it.id')
//            ->where('or.id=:id',[':id'=>$id])
//            ->all();
//
//    }
//    public function findOrder($status,$userId){
//        return (new \yii\db\Query())
//            ->select('id')
//            ->from('orders')
////        ->where('userId=:userId', [':userId' => Yii::$app->user->identity['id']])
//            ->where('userId=:userId', [':userId' => $userId])
//            ->andWhere(['status'=>$status])
//
//            ->one();
//
//    }
//    public function findOrders($userId){
//        return (new \yii\db\Query())
//            ->select(['or.id','or.date_order', 'or.status', 'it.title','ito.quantity','ito.price',
//                'ito.sumForItem', ])
//            ->from('orders or')
//            ->innerJoin('itemToOrder ito','or.id=ito.orderId')
//            ->innerJoin('item it','ito.itemId=it.id')
//            ->where('userId=:userId', [':userId' => $userId])
//            ->orderBy('id DESC')
//            ->all();
//
//    }
//    public function countItem($orderId){
//        return (new \yii\db\Query())
//            ->select('quantity')
//            ->from('itemToOrder')
//            ->where('orderId=:orderId',[':orderId'=>$orderId])
//            ->sum('quantity');
//
//
//    }
//    public function totalSum($orderId){
//        return (new \yii\db\Query())
//            ->select('sumForItem')
//            ->from('itemToOrder')
//            ->where('orderId=:orderId',[':orderId'=>$orderId])
//            ->sum('sumForItem');
//
//
//    }


}