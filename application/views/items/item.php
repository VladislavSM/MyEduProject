
<?php
    Layout::$pageTitle = $item['title'];
?>



<div class="row item-row">

    <?php

        if (!false == $item) {

            echo '<div id = "dem" class=" col-md-8 carousel slide view_item" data - ride = "carousel" >

            <!--Indicators -->
            <ul class="carousel-indicators" >
                <li data-target = "#dem" data-slide-to = "0" class="active" ></li >
                <li data-target = "#dem" data-slide-to = "1" ></li >
                <li data-target = "#dem" data-slide-to = "2" ></li >
            </ul >

            <!--The slideshow-->
            <div class="carousel-inner" >
                <div class="carousel-item active" >
                    <img class="img-fluid" src = " '.$item['imagePath'].' " alt = "Сумка MottoVoron Informa" >
                </div >
                <div class="carousel-item" >
                    <img class="img-fluid" src = "/images/ico.png" alt = "Сумка MottoVoron Informa" >
                </div >
                <div class="carousel-item" >
                    <img class="img-fluid" src = "/images/ico.png" alt = "Сумка MottoVoron Informa" >
                </div >
            </div >

            <a class="carousel-control-prev" href = "#dem" data-slide = "prev" >
              <img src = "/images/ic_skip_previous_black_48px.svg" >
            </a >
            <a class="carousel-control-next" href = "#dem" data-slide = "next" >
                <img src = "/images/ic_skip_next_black_48px.svg" >
            </a >
        </div >


        <div class="col-md-4 item_view_details" >
            <p > '.$item['title'].' </p >
            <p > Цена '.$item['price'].' грн.</p >
        <div class="form-for-item" >

    <form class="form-inline" action = "" method = "post" >
            <input type = "hidden" name = "id" value = "'.$item['id'].'" >
            <input type = "hidden" name = "title" value = " '.$item['title'].'" >
            <input type = "hidden" name = "price" value = " '.$item['price'].'" >
            <input class="amount-item-in-cart" type = "number" name = "count" min = "1" value = "1" >

            <button class="btn btn-info item_cart"  type = "submit" >
                В корзину !
            </button >
    </form >

        </div >

    </div >
    </div >
    
    <div ></div >

    <div id = "accordion" >

        <div class="card col-md-12" style = "text-align: center" >
            <div class="card-header" >
                <a class="card-link it-discr" data-toggle = "collapse" data-parent = "#accordion" href = "#collapseOne" >
            Открыть описание '.$item['title'].' .
                </a >
            </div >
            <div id = "collapseOne" class="collapse" >
                <div class="card-body" >'.$item['discription'].'
       
                </div >
            </div >
        </div >
    </div >';
        }
        else {
                echo '<div class="col-md-12 alert alert-info page-error">
                            Выбранный Вами товар не продается в нашем магазине!
                        </div>';
        }
        ?>
        </div>




