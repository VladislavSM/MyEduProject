<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 09.02.18
 * Time: 0:23
 */
if(!empty($items)){
    $message = 'По Вашему запросу подобраны следующие товары :';
    }else{
        $message = 'По Вашему запросу не обнаружено товаров. <br>
                    Попробуйте изменить запрос или просмотрите 
                    предложеные для Вас товары.';
    }

        if(empty($items)){
            echo '<div class="alert alert-info"style="text-align: center;font-size: 1.15em">'.$message.'</div>
            <div class="row">';
             foreach ($offer as $item) {

            echo '
                <div class="col-md-3 items-wrap">
                        <div class="col-md items">
                        <a href="/items/item/?id=' . $item['id'] . '">
                            <img class="img-fluid" src="' . $item['image'] . '">
                            <p class="item_title">' . $item['title'] . ' </p> </a>

                        <form class="form-inline" action="/order/add" method="post">
                                <input class="amount-item-in-cart-from-catalog" type="number" name="count" min="1" value="1">
                                <input type="hidden" name="id" value="' . $item['id'] . '">
                                <input type="hidden" name="title" value="' . $item['title'] . '">
                                <input type="hidden" name="price" value="' . $item['price'] . '">
                                <button class="btn btn-info item_cart_from_catalog"  type="submit">В корзину!</button>
                        </form>

                        <a href="/items/item/?id=' . $item['id'] . '">
                            <div class="bg-info item_price">Цена :  ' . $item['price'] . ' грн. </div>
                            <p class="item_summury">' . $item['summury'] . '</p>

                        </a>
                        </div>
                </div>';
             }
            echo '</div>';
        }else{
            echo '
                <div class="modal-content">

                <div class="modal-header mh">
                    <h4 class="modal-title">'.$message.'</h4>
                </div>
            
                <div class="modal-body">
                <div class="row col-md-12">';?>

            <?php
            foreach ($items as $item) {
                echo '
                        <div class="col-md-12 view-cart">
                        <div class="col-md-2 view-cart-image" >
                        <img class="img-fluid view-cart-image" src = "'.$item['image'].'" >
                        </div >
                         <div class="col-md-9 view-cart-title" ><span>'.$item['title'].'. Цена : '.$item['price'].' грн.</span ><br ><br >
                                     <a class="btn btn-info" href="/items/item/?id=' . $item['id'] . '">Посмотреть товар!</a>     
                        </div>
                        </div>';
            }
            ?>
            <?php echo '</div>
         </div>
        </div>';
        }
        ?>



