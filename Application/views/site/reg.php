


<div class="col-md-12 login">


    <h2>Создать аккаунт.</h2>
    <form action="/site/reg" method="post">
        <div class="form-group">
            <label for="login" style="color: <?=$colorLog;?>; font-style: italic;font-size: 20px"><?=$authLogin; ?></label>
            <input type="text" class="form-control" id="login"
                   placeholder="Enter login" name="login" required>
        </div>
        <div class="form-group">
            <label for="pwd" style="font-style: italic;font-size: 20px"><?=$authPass; ?></label>
            <input type="password" class="form-control" id="pwd"
                   placeholder="Enter password" name="password" required>
        </div>
        <div class="form-group">
            <label for="rpwd" style="color:<?=$colorRP;?>; font-style: italic;font-size: 20px"><?=$authRepPass; ?></label>
            <input type="password" class="form-control" id="rpwd"
                   placeholder="Repeat password" name="rpassword" required>
        </div>
        <div class="form-group">
            <label for="email" style="color:<?=$colorEm;?>;font-style: italic;font-size: 20px"><?=$authEmail; ?></label>
            <input type="text" class="form-control" id="email"
                   placeholder="Enter email" name="email" required>
        </div>
        <div class="form-group">
            <label for="name" style="font-style: italic;font-size: 20px"><?=$authName; ?></label>
            <input type="text" class="form-control" id="name"
                   placeholder="Enter your name" name="name">
        </div>
        <div class="form-group">
            <label for="surename" style="font-style: italic;font-size: 20px"><?=$authSureName; ?></label>
            <input type="text" class="form-control" id="surename"
                   placeholder="Enter your surename" name="surename">
        </div>
        <div class="form-group">
            <label for="phone" style="font-style: italic;font-size: 20px"><?=$authPhone; ?></label>
            <input type="text" class="form-control" id="phone"
                   placeholder="Enter your phone number" name="phone" required>
        </div>
        <div class="form-group">
            <label for="phone2" style="font-style: italic;font-size: 20px"><?=$authPhone2; ?></label>
            <input type="text" class="form-control" id="phone2"
                   placeholder="Enter your additional phone number" name="phone2">
        </div>

        <button type="submit" class="btn btn-info" style="width: 100%">Регистрация</button>
    </form>


</div>

