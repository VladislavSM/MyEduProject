
<?php
use MVS\MyEduProject\Core\Layout;
use MVS\MyEduProject\Core\Session;

     Layout::$pageTitle = 'Home Page';

if(Session::get('message') !==false &&
    $_SERVER['HTTP_REFERER'] === 'http://eduproject.loc/order/ordering'){

    $message = Session::get('message');

    echo '
        <div class="alert alert-info  alert-dismissable fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        '.$message.'</div>';
}

    echo ' <div class="col-md-12">
        <br><h2 class="" style="font-size: 4vw;font-family: Georgia; text-align: center">'.$homePage.'</h2>
          </div>';

?>






