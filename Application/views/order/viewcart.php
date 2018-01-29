<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 26.12.17
 * Time: 15:49
 */

/*
 * You can see the implementation in the modal window
 * by clicking on the cart icon on any page of the current project.
 */
//var_dump($_GET);
?>
<!--<script language="JavaScript">-->
<!--    function clickOnButton()-->
<!--    {-->
<!--    document.getElementById('Modal').onclick();-->
<!--    }-->
<!--    </script>-->


<!--<div class="col-md-12">-->
<!--    <div>-->
        <div class="modal-content">

            <div class="modal-header mh">
                <h4 class="modal-title"><?=$message?></h4>
<!--                <button type="button" class="close" data-dismiss="modal">&times;</button>-->
            </div>

            <div class="modal-body">
                <?php
                if($newOrder === false){
                    echo '';
                }else{
                    echo '
                <div class="row col-md-12">';?>
                
                    <?php
                    foreach ($newOrder as $order) {
                        echo '
                        <div class="col-md-12 view-cart">
                        <div class="col-md-2 view-cart-image" >
                        <img class="img-fluid view-cart-image" src = "'.$order['image'].'" >
                    </div >
                    <div class="col-md-9 view-cart-title" ><span>'.$order['title'].'. Цена : '.$order['price'].' грн.</span ><br ><br >
                        <form class="view-cart-form" action = "/order/updatecount" method = "post" >
                    
                        <button type="submit" class="but counterBut dec btn btn-info">
                        <img src="/image/ic_remove_circle_outline_white_24px.svg">
                        </button>
                        <input type="text" name="count"class="field fieldCount" value="'.$order['quantity'].'" 
                               data-min="1" data-max="200" style="width: 55px;height: 40px">
                        <button type="submit"  class="but counterBut inc btn btn-info">
                        <img src="/image/ic_add_circle_outline_white_24px.svg">
                        </button>
                            <i class="sum-for-item" > сумма : '.$order['sumForItem'].' грн </i >
                            <button type = "submit" name = "delete" value="delete" 
                                    class="delete-from-cart btn btn-danger">
                            <img src="/image/ic_clear_white_24px.svg">
                            </button >
                                      
                            <input type = "hidden" name = "orderId" value = "'. $order['orderId'] .'" >
                            <input type = "hidden" name = "itemId" value = "'. $order['itemId'] .'" >
                            <input type = "hidden" name = "price" value = "'. $order['price'] .'" >
                            <input type = "hidden" name = "title" value = "'. $order['title'] .'" >
                    
                    
                        </form >                  
                    </div>
                    </div>';
                    }
                   ?>
                    <?php echo '</div>';
                }
                ?>

                    <div class="modfutter">
                        <div class=" col-md-6  total-sum">Общая сумма заказа : <?=$totalSum?> грн.</div>
                    <?php
//                    var_dump($newOrder['0']);die;
                    if($newOrder === false || $newOrder == null){

                        echo '';
                    }else{
                        echo '
                        <a type="button" class=" col-md-3 btn btn-info" 
                        href="/order/ordering" style="float: right">Оформить заказ</a>
                        ';
                    }
                    ?>
                        <a type="button" class="col-md-3 btn btn-info"
                           href="javascript:history.back()" style="float: right">Продолжить покупки</a>
                    </div>
                    
                    </div>
                </div>
<!--</div>-->
<script>function cartItemCounter(field){

        var fieldCount = function(el) {

            var
                // Мин. значение
                min = el.data('min') || false,

                // Макс. значение
                max = el.data('max') || false,

                // Кнопка уменьшения кол-ва
                dec = el.prev('.dec'),

                // Кнопка увеличения кол-ва
                inc = el.next('.inc');

            function init(el) {
                if(!el.attr('disabled')){
                    dec.on('click', decrement);
                    inc.on('click', increment);
                }

                // Уменьшим значение
                function decrement() {
                    var value = parseInt(el[0].value);
                    value--;

                    if(!min || value >= min) {
                        el[0].value = value;
                    }
                };

                // Увеличим значение
                function increment() {
                    var value = parseInt(el[0].value);

                    value++;

                    if(!max || value <= max) {
                        el[0].value = value++;
                    }
                };

            }

            el.each(function() {
                init($(this));
            });
        };

        $(field).each(function(){
            fieldCount($(this));
        });
    }

    cartItemCounter('.fieldCount');</script>