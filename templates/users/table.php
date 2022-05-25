
<table>

    <thead>
        <tr>
            <th> ID </th>
            <th> Логин </th>
            <th> ФИО </th>
            <th> Email </th>
            <? if (checkAuthorized($connect)): ?>
            <th> Действия </th>
            <? endif; ?>
        </tr>
    </thead>

    <tbody>
    <? foreach ($users as $user): ?>
        <tr>
            <td> <?= $user['user_id']; ?> </td>
            <td> <?= $user['user_login']; ?> </td>
            <td> <?= $user['user_fio']; ?> </td>
            <td> <?= $user['user_email']; ?> </td>
            <? if (checkAuthorized($connect)): ?>
            <td>
                <a href="./user_edit.php?id=<?= $user['user_id']; ?>"> Редактировать </a>
                <button onclick="remove('user', <?= $user['user_id']; ?>)"> Удалить </button>
            </td>
            <? endif; ?>
        </tr>
    <? endforeach; ?>
    </tbody>

</table>
