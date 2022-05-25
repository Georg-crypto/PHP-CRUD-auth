
<?php if (!empty($errors)) : ?>
    <div class="errors" style="color: red;">
        <? foreach ($errors as $error): ?>
            <p> <?= $error; ?> </p>
        <? endforeach; ?>
    </div>
<? endif; ?>

<form action="" method="post">

    <label> Email </label> <input type="email" name="email"> <br>
    <label> Пароль </label> <input type="password" name="password"> <br>
    <input type="submit" value="Войти">

</form>

