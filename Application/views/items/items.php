
<?php
use MVS\MyEduProject\Core\Layout;


    Layout::$pageTitle = 'Cумки';

//  $value = $_POST['sell'];
$selected_0 = 'selected';
$selected_1 = '';
$selected_2 = '';
$selected_3 = '';
switch ($value) {
    case "id":
        $selected_0 = 'selected';
        $selected_1 = '';
        $selected_2 = '';
        $selected_3 = '';
        break;
    case "price ASC":
        $selected_0 = '';
        $selected_1 = 'selected';
        $selected_2 = '';
        $selected_3 = '';
        break;
    case "price DESC":
        $selected_0 = '';
        $selected_1 = '';
        $selected_2 = 'selected';
        $selected_3 = '';
        break;
    case "title":
        $selected_0 = '';
        $selected_1 = '';
        $selected_2 = '';
        $selected_3 = 'selected';
        break;
    default:
        $selected = '';
}

?>
<div class="form-group">
    <form class="form-inline justify-content-end" action="/items/items/?id=<?=$items[0]['categoryId']?>" method="post">
        <select class="form-control"name="sell">
            <option value="id"<?=$selected_0?> >По умолчанию</option>
            <option value="price ASC" <?=$selected_1?>>Cортировать по возрастанию цены.</option>
            <option value="price DESC"<?=$selected_2?>>Cортировать по убыванию цены.</option>
            <option value="title"<?=$selected_3?>>Cортировать по названию.</option>
        </select>
            <button class="btn btn-info" type="submit">Применить.</button>
    </form>
</div>
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


