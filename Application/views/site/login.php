


<div class="col-md-12 login">


    <h2>Вход в аккаунт.</h2>
    <form action="/site/login" method="post">
        <div class="form-group">
            <label for="login" style="color: <?=$color;?>; font-style: italic;font-size: 20px"><?=$authLogin; ?></label>
            <input type="text" class="form-control" id="login"
                   placeholder="Enter login" name="login" required>
        </div>
        <div class="form-group">
            <label for="pwd" style="color: <?=$color;?>; font-style: italic;font-size: 20px"><?=$authPass; ?></label>
            <input type="password" class="form-control" id="pwd"
                   placeholder="Enter password" name="password" required>
        </div>

        <button type="submit" class="btn btn-info" style="width: 100%">Войти</button>
    </form>


</div>

