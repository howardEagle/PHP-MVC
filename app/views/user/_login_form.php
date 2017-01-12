<?php
/* @var $model app\models\User */
?>
<div class="form register">
    <form name=" login_form" method="POST">
        <label for="user_login">Логін</label>
        <input type="text" name="user_login" id="user_login" value="<?= !empty($_POST['user_login']) ? $_POST['user_login'] : ''; ?>">
        <label for="user_password">Пароль</label>
        <input type="password" name="user_password" id="user_password">
        <input type="submit" name="submit" value="Вхід">
    </form>
</div>