<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 26.12.17
 * Time: 15:48
 */
//
//use \yii\bootstrap\Alert;
//use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//
///* @var $form yii\widgets\ActiveForm */
///* @var $this yii\web\View */
///* @var $model app\models\User */
//
//?>
<!---->
<!--<div class="">-->
<div class="col-md-5 row  viewcart">
    <div> <h4>В Вашем заказе :</h4></div>

    <?php
    foreach ($newOrder as $order) {

        echo '
        <div class="vic">
            <div class="col-md-3 viewcartimage" >
            <img class="img-fluid" src=" '. $order['image'].'">
            </div >
        <div class="col-md-9 viewcarttitle">'. $order['title'] .' - в количестве : '. $order['quantity'] .'</div>
        </div>';
    }
    ?>
        <div></div>
    <div class="totalsum"><span>Общая сумма заказа : <?=$totalSum?> грн.</span></div>
</div>

<div class=" col-md-7 ordering1">
    <h4>Оформление заказа</h4>

    <form action="/sendmail/sendorder" method="post">


        <div class="form-group">
            <label for="name" style="font-style: italic;font-size: 20px">Имя заказчика *</label>
            <input type="text" class="form-control" id="name" value="<?=$user['name']?>"
                   placeholder="Enter your name" name="name" required>
        </div>
        <div class="form-group">
            <label for="surename" style="font-style: italic;font-size: 20px">Фамилия заказчика</label>
            <input type="text" class="form-control" id="surename" value="<?=$user['surename']?>"
                   placeholder="Enter your surename" name="surename">
        </div>
        <div class="form-group">
            <label for="email" style="font-style: italic;font-size: 20px">Email заказчика *</label>
            <input type="text" class="form-control" id="email" value="<?=$user['email']?>"
                   placeholder="Enter email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone" style="font-style: italic;font-size: 20px">Контактный телефон *</label>
            <input type="text" class="form-control" id="phone" value="<?=$user['phone']?>"
                   placeholder="Enter your phone number" name="phone" required>
        </div>
        <div class="form-group">
            <label for="phone2" style="font-style: italic;font-size: 20px">Контактный телефон 2</label>
            <input type="text" class="form-control" id="phone2" value="<?=$user['phone2']?>"
                   placeholder="Enter your additional phone number" name="phone2">
        </div>
        <div class="form-group">
            <label for="address" style="font-style: italic;font-size: 20px">Адрес доставки *</label>
            <input type="text" class="form-control" id="address"
                   placeholder="Введите адрес или укажите САМОВЫВОЗ" name="address" required>
        </div>






    <p class="alert alert-ordering">ВНИМАНИЕ ! Проверьте ваши данные.Если необходимо - исправьте или введите недостающие.</p>
    <p class="alert alert-ordering">ВНИМАНИЕ !  Оплата заказа наличными при получении.</p>

    <button type="submit" class="btn btn-info" style="font-family: 'Times New Roman';font-size:1.25em; width: 100%">ОТПРАВИТЬ  ЗАКАЗ !!!</button>
    </form>

</div>

<!--</div>-->
