
<?php
use MVS\MyEduProject\Core\Layout;


    Layout::$pageTitle = 'Cумки';

?>

<div class="row">

<?php
if(empty($items)){
    echo '<div class="col-md-12 alert alert-info items-alert">На данный момент товары в этой категории отсутствуют.</div>';

}

foreach ($items as $item) {

  echo '
        <div class="col-md-3 items-wrap">
                        <div class="col-md items">
                        <a href="/items/item/?id=' . $item['id'] . '">
                            <img class="img-fluid" src="'.$item['image'].'">
                            <p class="item_title">' .$item['title'].' </p> </a>

                        <form class="form-inline" action="/order/add" method="post">
                                <input class="amount-item-in-cart-from-catalog" type="number" name="count" min="1" value="1">
                                <input type="hidden" name="id" value="'.$item['id'].'">
                                <input type="hidden" name="title" value="'.$item['title'].'">
                                <input type="hidden" name="price" value="'.$item['price'].'">
                                <button class="btn btn-info item_cart_from_catalog"  type="submit">В корзину!</button>
                        </form>

                        <a href="/items/item/?id=' . $item['id'] . '">
                            <div class="bg-info item_price">Цена :  '.$item['price'].' грн. </div>
                            <p class="item_summury">'.$item['summury'].'</p>

                        </a>
                        </div>
                    </div>';
};

?>

</div>

<div class="col-md-12">
    <br><p class="display-3" style="text-align: center"> Самое  лучшее  только у нас!</p><br>
</div>


