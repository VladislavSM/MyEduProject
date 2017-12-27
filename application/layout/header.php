
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MyEduProject <?=Layout::$pageTitle;  ?></title>
    <!--<link href="https://fonts.googleapis.com/css?family=Playball" rel="stylesheet">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <link href="/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<nav class="navbar  navbar-expand-lg bg-info navbar-dark fixed-top www">
    <!-- Brand -->
    <a class="navbar-brand" href="/site/index">
        <img src="/images/logo2.png" alt="Logo" style="width:40px;"> <span class="brand">  MyEduProject</span>
    </a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="nav navbar-nav ml-auto w-100 justify-content-end sitemenu">
            <li class="nav-item">
                <a class="nav-link" href="/site/index">Главная</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/items/items">Каталог</a>

            <?php

            if (isset($_SESSION['identity'])){
                echo '<li class="nav-item">
                            <a class="nav-link" href="/site/logout">Выйти:( '. $_SESSION['identity'] .' )</a>
                      </li>';
            }else {

                echo '<li class="nav-item">
                                <a class="nav-link" href="/site/login">Войти</a>
                           </li>
                           <li class="nav-item">
                                <a class="nav-link" href="/site/createAccount">Создать аккаунт</a>
                            </li>';
            }
            ?>

            <button class="cart"  data-toggle="modal" data-target="#myModal">
                <img src="/images/ic_shopping_cart_white_24px.svg" style="width: 45px"></button>
        </ul>
    </div>
</nav>
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Вы добавили в Корзину:</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">


                <div class="row col-md-12 view-cart">
                    <?php ?>
                    <div class="col-md-3 view-cart-image" >
                        <img class="img-fluid view-cart-image" src="/images/ico.png">
                    </div >
                    <div class=" view-cart-title"> Сумка Mottovoron Informa <span>  цена : 1100 грн.</span><br><br>
                        <form class="view-cart-form" action="#" method="post">

                            <input class="field fieldCount"
                                   title="в количестве" type="number" name="count" value="1" data-min="1" data-max="200">
                            <i class="sum-for-item"> сумма : 1100 грн</i>
                            <button type="submit"  name="delete" class="delete-from-cart btn-link">Удалить</button>


                            <input type="hidden" name="orderId" value="'. $order['orderId'] .'">
                            <input type="hidden" name="itemId" value="'. $order['itemId'] .'">


                        </form>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <a type="button" class="btn btn-info" href="index.html">Оформить заказ</a>
                <button type="button" class="btn btn-info" data-dismiss="modal">Продолжить покупки</button>
            </div>

        </div>
    </div>
</div>

<div class="container-fluid sitecontainer">
    <div class="col-md-12"></div>
    <div class="jumbotron myjumbotron">

        <img src="/images/header.png" style="width: 100%">
        <span class="display">My Edu Project</span>
    </div>

    <!--CONTENT-->

