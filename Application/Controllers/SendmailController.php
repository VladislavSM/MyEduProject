<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 26.01.18
 * Time: 14:02
 */

namespace MVS\MyEduProject\Application\Controllers;
use MVS\MyEduProject\Core\Controller;
use MVS\MyEduProject\Core\Session;
use MVS\MyEduProject\Application\Models\Mail;
use MVS\MyEduProject\Application\Models\Order;
use MVS\MyEduProject\Application\Models\Cart;

class SendmailController extends Controller
{

    public $defaultAction = 'sendorder';
    public $userId;


    protected function sendEmail($to,$subject,$message,$headers,$parameters){
       return mail($to ,$subject, $message, $headers,$parameters);
    }

    public function actionSendorder(){

        if (isset($_POST)){
            $this->userId = Session::get('identityId');
            $cart = new Cart();
            $status = Order::ORDER_OPEN;
            $userParams['totalSum'] = $cart->countItem($cart->findOrder($status,$this->userId)['id'])['totalsum'];
            $userParams['newOrder'] = $cart->viewOrder($this->userId, $status);
            $userParams['name'] = $_POST['name'];
            $userParams['surename'] = $_POST['surename'];
            $userParams['email'] = $_POST['email'];
            $userParams['phone'] = $_POST['phone'];
            $userParams['phone2'] = $_POST['phone2'];
            $userParams['address'] = $_POST['address'];
            $userParams['message'] = '';

            $model = new Mail();
            $toAdmin = $model->toAdmin();
            $subjectToAdmin = $model->subjectForOrder($userParams['name'], $userParams['surename']);
            $headersToAdmin = $model->headers('robot@medupro.com','no-reply');
            $orderMessage = $model->messageForOrder($userParams);
//           $res=
               mail($toAdmin,$subjectToAdmin,$orderMessage,$headersToAdmin);
//            if($res === true){ }
               $to = $userParams['email'];
               $userParams['message'] = 'Ваш заказ принят. Наш менеджер свяжится с Вами
                                          в ближайшее время по телефону. ПРОВЕРЬТЕ ВАШ ЗАКАЗ :';
               $subjectToUser = $model->subjectForConfirmOrder();
               $messageToUser = $model->messageForOrder($userParams);
               $headersToUser = $model->headers($model->toAdmin(),'no-replay');
               mail($to,$subjectToUser,$messageToUser,$headersToUser);

            $order = new Order();
            $order->updateAfterOrdering(Order::SENT_BY_CUSTOMER,$userParams['address'],
                                        $userParams['name'],
                                        $userParams['surename'],
                                        $userParams['email'],$userParams['phone'],
                                        $userParams['phone2'],
                                        $userParams['newOrder']['0']['orderId']);

            $message = 'Ваш заказ № '.$userParams['newOrder']['0']['orderId'].' принят.  
                            Наш менеджер свяжится с Вами в ближайшее время по телефону.
                            Спасибо за покупку '.$userParams['name'].'';
            Session::set('message',$message);
            $this->goHome();
        }else{
            $this->goHome();
        }
    }
}