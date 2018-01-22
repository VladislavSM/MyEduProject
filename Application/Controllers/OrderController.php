<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 26.12.17
 * Time: 15:23
 */

namespace MVS\MyEduProject\Application\Controllers;
use MVS\MyEduProject\Core\Controller;

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
//    public function setUserId() {
//        $session = Yii::$app->session;
//
//        if(Yii::$app->user->isGuest && null === $session->get('guestId')) {
//            $user = new User();
//            $user->status = 9;
//            $user->dateOfRegistr = time();
//            $user->save(false);
//            $session->set('guestId',$user->id);
//            $this->userId = $user->id;
//
//
//        } else {
//            $this->userId = $session->get('guestId') ?: Yii::$app->user->identity['id'];
//        }
//    }
//
//
//
//
//    public function actionAdd()
//    {
//        $this->setUserId();
//
//        $this->item = Yii::$app->request->post();
//
//        if (!$order = Order::findOne([
//            'userId' => $this->userId,
//            'status' => Order::ORDER_OPEN,
//        ])) {
//            $order = new Order();
//            $order->userId = $this->userId;
//            $order->status = Order::ORDER_OPEN;
//        }
//
//        $order->save();
//
//        \Yii::$app->session->addFlash('success', \Yii::t('app',
//            'Вы добавили в корзину '.' - '.$this->item['title'].' в количестве : '.$this->item['count']));
//
//        return $this->redirect(Yii::$app->request->referrer);
//
//    }
//
//    public function actionViewcart(){
//        $this->setUserId();
//        $cart = new Cart();
//        $status = Order::ORDER_OPEN;
//        if(Yii::$app->user->isGuest) {
//            $newOrder = $cart->viewOrder(Yii::$app->session->get('guestId'), $status);
//        }else {
//            $newOrder = $cart->viewOrder(Yii::$app->user->identity['id'],$status);
//        }
//        $totalSum = $cart->totalSum($cart->findOrder($status,$this->userId)['id']);
//        if(!empty($newOrder)){
//            $message = 'Вы добавили в корзину :';
//        }else{
//            $message = 'В корзине нет товара.';
//        }
//        return $this->render('viewcart',
//            [
//                'totalSum'=>$totalSum,
//                'newOrder'=>$newOrder,
//                'message'=>$message,
//            ]);
//    }
//
//    public function actionUpdatecount(){
//        $this->item = Yii::$app->request->post();
//        $id = ItemToOrder::findOrderForUpdateId($this->item['orderId'], $this->item['itemId']);
//        if(isset($this->item['delete'])){
//            $this->findModel($id)->delete();
//        }else {
//            $updateCount = $this->findModel($id);
//            $updateCount['quantity'] = $this->item['count'];
//            $updateCount['sumForItem'] = $updateCount['price'] * $this->item['count'];
//            $updateCount->update();
//        }
//        return $this->redirect(Yii::$app->request->referrer);
//    }
//
//    public function actionOrdering(){
//        $this->setUserId();
//        $cart = new Cart();
//        $status = Order::ORDER_OPEN;
//        $newOrder = $cart->viewOrder($this->userId,$status);
//        $totalSum = $cart->totalSum($cart->findOrder($status,$this->userId)['id']);
//        $model = User::findOne($this->userId);
//
//
//        if($userParams = (Yii::$app->request->post())) {
//            Yii::$app->mailer->compose('sendOrder',[
//                'userParams'=>$userParams,
//                'newOrder'=>$newOrder,
//                'totalSum'=>$totalSum,
//                'message'=>'',
//            ])
//
//                ->setTo(Yii::$app->params['adminEmail'])
//                ->setFrom([$userParams['User']['email']=>$userParams['User']['name']])
//                ->setSubject('Заказ от :'.$userParams['User']['name'].'_'.$userParams['User']['surename'])
//                ->send();
//            if(Yii::$app->mailer->compose()){
//                \Yii::$app->session->addFlash('success', \Yii::t('app',
//                    'Ваш заказ № '.$newOrder['0']['orderId'].' принят.  Наш менеджер свяжится с Вами
//                     в ближайшее время по телефону.'));
//
//                Yii::$app->mailer->compose('sendOrder',[
//                    'userParams'=>$userParams,
//                    'newOrder'=>$newOrder,
//                    'totalSum'=>$totalSum,
//                    'message' => 'Ваш заказ принят."<br>" Наш менеджер свяжится с Вами
//                     в ближайшее время по телефону. <br>ПРОВЕРЬТЕ ВАШ ЗАКАЗ :'
//                ])
//                    ->setTo($userParams['User']['email'])
//                    ->setFrom(Yii::$app->params['adminEmail'])
//                    ->setSubject('Mottovoron - Подтверждение заказа')
//                    ->send();
//
//                if(Yii::$app->user->isGuest  || !null===Yii::$app->session->get('guestId')){
//
//                    $model->name = $userParams['User']['name'];
//                    $model->surename = $userParams['User']['surename'];
//                    $model->email = $userParams['User']['email'];
//                    $model->phone = $userParams['User']['phone'];
//                    $model->phone2 = $userParams['User']['phone2'];
//                    $model->updateAttributes(['name','surename','phone','phone2','email']);
//                }
//                $order = Order::findOne($newOrder['0']['id']);
//                $order->status = Order::SENT_BY_CUSTOMER;
//                $order->address = $userParams['User']['address'];
//                $order->updateAttributes(['date_order','status','address']);
//
//
//                return $this->redirect('/catalog');
//
//            }else{
//                \Yii::$app->session->addFlash('success', \Yii::t('app',
//                    'Произошла ошибка. Попробуйте отправить Ваш заказ снова'));
//            }
//
//        }
//
//        return $this->render('ordering',
//            [
//                'totalSum'=>$totalSum,
//                'newOrder'=>$newOrder,
//                'model'=>$model
//            ]);
//    }
//
//
//    protected function findModel($id)
//    {
//        if (($model = ItemToOrder::findOne($id)) !== null) {
//            return $model;
//        } else {
//            throw new NotFoundHttpException('The requested page does not exist.');
//        }
//    }

}