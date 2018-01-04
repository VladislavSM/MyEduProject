<?php

require_once '../core/SiteError.php';
$serr = new SiteError();
$serr->siteErrors();



//$items = require_once 'stock.php';
?>
<p>Список товаров на складе :</p>

<?php 
foreach ($items as $item){
//    var_dump($item);
	echo $item['id'].'</br>';
}

foreach ($items as $item){
    if($item['id']== 9){
        echo $item['title'];
    }else{
        echo 'DDD';
    }
}
