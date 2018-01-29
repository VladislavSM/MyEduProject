<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 26.12.17
 * Time: 15:23
 */

namespace MVS\MyEduProject\Application\Controllers;
use MVS\MyEduProject\Core\Controller;
use MVS\MyEduProject\Core\Session;
use MVS\MyEduProject\Core\DataBase;
use MVS\MyEduProject\Application\Models\Order;
use MVS\MyEduProject\Application\Models\Cart;
/** Processing orders will be implemented after connecting the training database.
 *The logic of implementation is similar to what I did in Yii-2 (given in the comments).
 * The models Order, ItemToOrder, Cart (in the models folder) are used.
 * In each model, the logic of model implementation is presented in the commentary.
 * Views in the views/order directory.
 */
class OrderController extends Controller
{
    public $item;
    public $userId;
//
//    public function beforeAction($action)
//    {
//        if ($action->id === 'add' || $action->id === 'updatecount') {
//            $this->enableCsrfValidation = false;
//        }
//        return parent::beforeAction($action);
//    }
//
    public function setUserId() {
        $session = new Session();
        $this->userId = $session::get('identityId');

        if($this->userId === false) {
            $status = 9;
            $dateOfRegistr = time();
            $db = DataBase::getInstance();
            $db = $db->getConnection();
            $setUser = $db->prepare(
                'INSERT INTO users (status, dateOfRegistr)
                       VALUES(?, ?)'
            );
            $setUser->execute([ $status, $dateOfRegistr]);
            $user = $db->prepare(' SELECT id FROM users 
                                             WHERE `status` = ?
                                             ORDER BY dateOfRegistr DESC LIMIT 1');
            $user->execute([$status]);
            $user = $user->fetch(\PDO::FETCH_ASSOC);
            $this->userId = $user['id'];
            $session->start();
            Session::set('identityId',$this->userId);
        }
        return $this->userId;
    }

    public function actionAdd()
    {
        $this->setUserId();
        $this->item = $_POST;
        $order = new Order();
        $order->saveOrder($this->userId,Order::ORDER_OPEN, $this->item);
        $message = 'Вы добавили в корзину - '.$this->item['title'].'  , в количестве '.$this->item['count'].' шт.';
        Session::set('message',$message);

        $this->goBack();
    }

    public function actionViewcart()
    {
        if(Session::get('identityId')!==false){
            $this->userId = Session::get('identityId');
            $params['message']='Вы добавили в корзину :';

            $cart = new Cart();
            $status = Order::ORDER_OPEN;
            $params['totalSum'] = $cart->countItem($cart->findOrder($status,$this->userId)['id'])['totalsum'];
            $newOrder = $cart->viewOrder($this->userId, $status);
            if($newOrder === false){
                $params['message'] = 'В корзине нет товара :';
                $params['newOrder'] = false;
                $params['totalSum'] = false;
            }
                $params['newOrder'] = $newOrder;
        }else{
            $this->userId = false;
            $params['message'] = 'В корзине нет товара :';
            $params['newOrder'] = false;
            $params['totalSum'] = 0;

        }
        $this->Render($this->template,$params);
    }

    public function actionUpdatecount()
    {
        $this->item = $_POST;
        $cart = new Cart();
        if(isset($this->item['delete'])){
            $cart->delete($this->item['orderId'], $this->item['itemId']);
            $message = 'Вы удалили из корзины - '.$this->item['title'].'';
            Session::set('message',$message);
        }else {
            $cart->update($this->item['orderId'], $this->item['itemId'], $this->item['count'], $this->item['price']);
            $message = 'Вы изменили в корзине - '.$this->item['title'].'  , на количество '.$this->item['count'].' шт.';
            Session::set('message',$message);
        }
        $this->goBack();
    }

    public function actionOrdering(){
        $this->userId = Session::get('identityId');
        $cart = new Cart();
        $status = Order::ORDER_OPEN;
        $newOrder = $cart->viewOrder($this->userId, $status);
        $params['newOrder'] = $newOrder;
        $params['totalSum'] = $cart->countItem($cart->findOrder($status,$this->userId)['id'])['totalsum'];
        $user = $this->findUser($this->userId);
        $params['user'] = $user;
        $this->Render($this->template,$params);
    }

    public function findUser($id)
    {
        $db = DataBase::getInstance();
        $db = $db->getConnection();
        $getUser = $db->prepare(
            'SELECT username, name, surename, email, phone, phone2
            FROM
                users u
            WHERE 
                u.`id` = ?'
        );
        $getUser->execute([$id]);
        $user = $getUser->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }

}