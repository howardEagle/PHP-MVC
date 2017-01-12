<h1>Регистрация</h1>
<?php
/* @var $this \core\base\View */
/* @var $model app\models\User */
/* @var $message string */
if (!$message) {
    echo $this->renderPartial('_reg_form', array('model' => $model));
} else {
    echo "<div class='success'>$message</div>";
}
?>