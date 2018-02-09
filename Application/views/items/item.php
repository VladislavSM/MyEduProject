
<?php
use MVS\MyEduProject\Core\Layout;

    Layout::$pageTitle = $item['title'];
?>
<div id="ajax-respons" class="alert alert-info  alert-dismissable"style="display: none" >
    <button type = "button" class="close" data-dismiss = "alert" >&times;</button >
</div >
<div class="row item-row">

    <?php

        if (!false == $item) {

            echo '<div id = "dem" class=" col-md-6 carousel slide view_item" data-ride = "carousel" >

            <!--Indicators -->
            <ul class="carousel-indicators" >
                <li data-target = "#dem" data-slide-to = "0" class="active" ></li >';

                $countSlides = count($images);
                for ($i = 1; $i <= $countSlides; $i++) {
                    echo '<li data-target="#dem" data-slide-to="' . $i . '">'.'</li>';
                }
            echo'            
            </ul >
            
                        <!--The slideshow-->
            <div class="carousel-inner" >
                <div class="carousel-item active" >
                    <img class="img-fluid carousel-image" src = " '.$item['image'].' " alt = "'.$item['title'].'" >
                </div >';
                if (is_array($images)) {
                    foreach ($images as $image) {
                        echo ' <div class="carousel-item item-carousel">
                                  <img class="img-fluid carousel-image" 
                                       src="' . '/' . $path . '/' . $image . ' " alt = "'.$item['title'].'">
                               </div>
                <a class="carousel-control-prev" href = "#dem" data-slide = "prev" >
                    <img src = "/image/ic_skip_previous_black_48px.svg" >
                </a >
                <a class="carousel-control-next" href = "#dem" data-slide = "next" >
                    <img src = "/image/ic_skip_next_black_48px.svg" >
                </a >';
                    }
                } else {
                    echo ' <div class="carousel-item">
                                <img class="img-fluid carousel-image" 
                                     src="' . '/' . $path . '/' . $images . ' " alt = "'.$item['title'].'">
                           </div>';
                        }
            echo '                       
            </div >
        </div>

        <div class="col-md-6 item_view_details" >
            <p > '.$item['title'].' </p >
            <p > Цена '.$item['price'].' грн.</p >
         <div class="form-for-item" >
             <form class="form-inline" action = "/order/add" method = "post" >
                <input type = "hidden" name = "id" value = "'.$item['id'].'" >
                <input type = "hidden" name = "title" value = " '.$item['title'].'" >
                <input type = "hidden" name = "price" value = " '.$item['price'].'" >
                <input class="amount-item-in-cart" type = "number" name = "count" min = "1" value = "1" >

                <button class="btn btn-info item_cart"  type = "submit" >
                В корзину !
                </button >
             </form >
         </div >';

         if(!false == $bought) {
             echo
             '<div id="if-user-bought" class="alert alert-info  alert-dismissable user_comments" >
                 Вы уже покупали этот товар . Хотите оставить отзыв ?
                 <span  class="open-comments" > Yes</span >
                 <span class="close-comments" data-dismiss = "alert" > No</span >
             </div >';
         }
            echo '
                <div id="div-user-comment" class="form-control user_comments" >
                 <form id="form-user-comment" action = "/items/addcomment" method = "post" >
                        <input type = "hidden" name = "userId" value = "'.$bought['id'].'" >
                        <input type = "hidden" name = "id" value = "'.$item['id'].'" >
                        <textarea class="form-control" name="comment" rows="7" id="user-comment" maxlength="2000" required> 
                        </textarea>
                        <div id="counter"></div>
                        <button id="btn" class="btn btn-info col-md-12"  type = "submit" >Отправить отзыв !</button >
                        <div id="placeholder" class="alert alert-danger"></div>
                 </form >
                </div>
                 
        </div >
     <div ></div >

    <div id = "accordion" class="col-md-12" >

        <div class="card col-md-12" style = "text-align: center" >
            <div class="col-md-12 card-header" >
                <a class="card-link it-discr" data-toggle = "collapse" data-parent = "#accordion" href = "#collapseOne" >
            Открыть описание '.$item['title'].' .
                </a >
            </div >
            <div id = "collapseOne" class="collapse" >
                <div class="card-body" >'.$item['description'].'
       
                </div >
            </div >
        </div >
    </div >
    
    <div id = "accordion2" class="col-md-12" >

        <div class="card col-md-12" style = "text-align: center" >
            <div class="col-md-12 card-header" >
                <a class="card-link it-discr" data-toggle = "collapse" data-parent = "#accordion2" href = "#collapse2" >
            Открыть отзывы о  '.$item['title'].' .
                </a >
            </div >
            <div id = "collapse2" class="collapse" >
                         <div class="alert alert-info  alert-dismissable">
                          Отзывы могут оставлять только зарегестрированные пользователи,
                          после получения и оплаты товара.
                         <button type="button" class="close" data-dismiss="alert">&times;</button>
                         </div>';
            if(!false == $comments){
                foreach ($comments as $comment){
//                    var_dump($comment);die;
                       echo '<div class="card-body comment-content" >
                             <p><strong>Отзыв написан : '.$comment['name'].' '.$comment['surename'].' 
                                '.$comment['commentsDate'].'
                             </strong></p>
                             <p class="">'.$comment['content'].'
                             </p>
                             </div >';
                }
            }else{
                echo '<div class="card-body comment-content" >
                             <p><strong>На этот товар еще нет отзывов.
                             </strong></p>
                     </div >';
            }

            echo '</div >
        </div >
    </div >';
        } else {
                echo '<div class="col-md-12 alert alert-info page-error">
                            Выбранный Вами товар не продается в нашем магазине!
                      </div>';
        }
        ?>
</div>

<script>
    $(document).ready(function()  {
        $(".open-comments").click(function(){
            $("#div-user-comment").css("display","block");
        });
        $(".close-comments").click(function(){
            $("#div-user-comment").css("display","none");
        });
        var characters = 2000;
        $("#counter").html("Осталось <strong>"+  characters+"</strong> символов");
        $("#user-comment").val('').keyup(function(){

            var remaining = characters -  $(this).val().length;
            jQuery("#counter").html("Осталось <strong>"+  remaining+"</strong> символов");
            if( remaining <= 20)
            {
                $("#counter").css("color","red");
            }
            else
            {
                $("#counter").css("color","black");
            }
        });

        $("#placeholder").append("Введите текст не более 2000 символов. Сообщение с НЕНОРМАТИВНОЙ ЛЕКСИКОЙ и " +
                                  "ОСКОРБЛЯЮЩЕЕ ДРУГИХ ПОЛЬЗОВАТЕЛЕЙ будет удалено. Автор  сообщения будет " +
                                  "ИСКЛЮЧЕН из числа пользователей НАВСЕГДА !");

        $("#form-user-comment").submit(function() {
            $.post(
                 $(this).attr('action'),
                 $(this).serialize(),
            );
            return false;
        });


        $(document).ajaxSuccess(function() {
            $("#ajax-respons").show().append("Ваш отзыв добавлен. Если Ваш отзыв не соответствует " +
                                              "предъявляемым требованиям он будет удален ! " +
                                              " С Уважением администрация My Edu Project !");
            $(" textarea ").val('');
            $("#div-user-comment").hide();
        });

        $(document).ajaxError(function(){
            $("#ajax-respons").show().append("Приносим извенения! Возникли временные трудности с работой сервера."+
                      "Служба поддержки уже занимается устранением проблемы. Попробуйте написать Ваш отзыв позже.");
        });

    });
</script>


