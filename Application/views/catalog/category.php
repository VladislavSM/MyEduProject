<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 18.01.18
 * Time: 18:16
 */

?>

<div class="row">
<?php
foreach ($categories as $category) {

    echo '
        
        <div class="col-md-4 category-wrap">
        <a href="/items/items/?id='.$category['id'].'">
                        <div class="col-md-4 category-img">
                            <img class="img-category" src="'.$category['image'].'">
                        </div></a>
                       
                        <div class="col-md-8 category-title">
                         <a href="/items/items/?id='.$category['id'].'">
                            <p>' .$category['title'].' </p>
                         </a>';
                             if(0 != $category['child']){
                               echo '<a href="/catalog/category/?id='.$category['id'].'">
                                <div class="subCategory">'.$message.'</div>
                                </a>';}

                            echo '
                       </div>
        </div>';
};

?>

</div>