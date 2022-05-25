
<?php if (!empty($errors)) : ?>
    <div class="errors" style="color: red;">
        <? foreach ($errors as $error): ?>
            <p> <?= $error; ?> </p>
        <? endforeach; ?>
    </div>
<? endif; ?>

<form action="" method="post">

    <label> Логин </label> <input type="text" name="user_login"> <br>
    <label> ФИО </label> <input type="text" name="user_fio"> <br>
    <label> Email </label> <input type="email" name="user_email"> <br>
    <label> Пароль </label> <input type="password" name="user_password"> <br>
    <label> Повторите пароль </label> <input type="password" name="repeat_password"> <br>
    <input type="submit" value="Зарегистрироваться">

</form>
