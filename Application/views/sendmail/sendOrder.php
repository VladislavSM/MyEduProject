<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 06.09.17
 * Time: 21:00
 */

?>
<p><?=$message ?></p>
<p>Заказ № : <strong><?=$newOrder['0']['orderId'] ?></strong> </p>
<p>От : <?=$name.' '.$surename ?></p>
<p>E-mail заказчика : <?=$email ?></p>
<p>Арес доставки : <?=$address ?></p>
<p>Контактный телефон : <?=$phone.' или '.$phone2 ?> </p>
<p>Дата заказа : <?=Date("d-m-Y ") ?>, время заказа : <?=Date(" H:i:s") ?></p>
<p>Сумма заказа : <?=$totalSum ?> гривен</p><br>
<p><strong> Состав заказа :</strong><br>
    <?php
        foreach ($newOrder as $order){
            echo
            '<p>Наименование: <strong>'.$order['title'].'</strong></p>
             <p>Цена изделия:<strong> '.$order['price'].' </strong>гривен</p>
             <p>Количество: <strong>'.$order['quantity'].'</strong>шт.</p>
            <p>-------------------------------------------------------------</p>
            ';
        }

        ?>


