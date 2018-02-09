
<?php
use MVS\MyEduProject\Core\Layout;
use MVS\MyEduProject\Core\Session;

     Layout::$pageTitle = 'Home Page';

if(Session::get('message') !==false &&
    $_SERVER['HTTP_REFERER'] === 'http://eduproject.loc/order/ordering'){

    $message = Session::get('message');

    echo '
        <div class="alert alert-info  alert-dismissable fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        '.$message.'</div>';
}

    echo ' <div class="col-md-12 home-page">
                <br><h2>'.$homePage.'</h2><br>
                <div class="alert alert-info  alert-dismissable fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <p>Если Вы зарегистрированный пользователь и хотите оставить отзыв ?
                Зайдите на страничку купленного Вами товара и напишите свой отзыв о
                товаре или работе нашего магазина.</p>
                <p><strong>С уважением администрация My Edu Project.</strong></p>
                </div>
        
          </div>';

?>






