<?
/* @var $model app\models\User */
/* @var $errors array */
?>
    <h1>Вхід на сайт</h1>
<?php
if (count($errors)) {
    echo '<div class="errors"><b>Исправьте ошибки</b>:<ul>';
    foreach ($errors as $attr => $error) {
        echo "<li>$error</li>";
    }
    echo '</ul></div>';
}
?>
<? $this->renderPartial('_login_form', array('model' => $model)); ?>