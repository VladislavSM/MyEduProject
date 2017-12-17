<?php
$items = require_once 'items.php';
?>
<p>Список товаров на складе :</p>

<?php 
foreach ($items as $item){
	echo $item['title'].'</br>';
}

	
