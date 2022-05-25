
<a href="./users.php" style="margin-right: 1rem; ">
    Список пользователей
</a>
<? if (!checkAuthorized($connect)): ?>
    <a href="./register.php" style="margin-right: 1rem; ">
        Регистрация
    </a>
    <a href="./authorization.php">
        Вход
    </a>
<? endif; ?>
<? if (checkAuthorized($connect)): ?>
    <a href="./logout.php">
        Выход
    </a>
<? endif; ?>