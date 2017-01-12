<?php
/* @var $model app\models\User */
?>
<?php
foreach($model->getErrors() as $attr => $error) {
    echo $error;
}
?>
<div class="form register" >
    <form name="reg_form" method="POST">
        <label for="user_name">Ім'я</label>
        <input type="text" name="user_name" id="user_name" value="<?= $model->getName();?>">
        <label for="user_login">Логін</label>
        <input type="text" name="user_login" id="user_login" value="<?= $model->getLogin();?>">
        <label for="user_password">Пароль</label>
        <input type="password" name="user_password" id="user_login">
        <label for="user_password_check">Пароль ще раз</label>
        <input type="password" name="user_password_check" id="user_password_check">
        <input type="submit" name="user_submit">
    </form>
</div>
