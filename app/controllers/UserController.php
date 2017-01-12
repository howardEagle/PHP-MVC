<?php
/**
 * Created by PhpStorm.
 * User: howard
 * Date: 27.04.2015
 * Time: 16:35
 */

namespace app\controllers;


use app\models\User;
use app\models\UserQuery;
use core\base\Controller;
use core\base\Session;
use Parm\Binding\ContainsBinding;

class UserController extends Controller
{

    public function actionRegister()
    {
        $user = new User();
        $message = '';
        if (isset($_POST['user_submit'])) {
            $user->setName($_POST['user_name']);
            $user->setLogin($_POST['user_login']);
            if (!empty($_POST['user_password'])) {
                $user->setPassword(md5(md5(trim($_POST['user_password']))));
            }
            if ($user->validate()) {
                $user->save();
                $message = 'Ви були успішно зареєстровані';
            }
        }

        $this->render('register', array('model' => $user, 'message' => $message));
    }

    public function actionLogin()
    {
        $pq = new UserQuery();
        $errors = array();
        if (isset($_POST['submit'])) {
            if (empty($_POST['user_login'])) {
                $errors['user_login'] = "Field 'login' must be set";
            }
            if (empty($_POST['user_password'])) {
                $errors['user_password'] = "Field 'password' must be set";
            }

            $model = $pq->whereEquals('login', $_POST['user_login'])
                ->whereEquals('password', md5(md5($_POST['user_password'])))
                ->getFirstObject();

            if ($model) {
                $model->login();
                $this->redirect('/');
            } else {
                $errors[] = 'Комбінація логін/пароль не співпадають';
            }
        }

        $this->render('login', array('errors' => $errors));
    }

    public function actionLogout()
    {
        $session = new Session();
        $session->remove('user_id');
        session_destroy();
        $this->redirect('/');
    }
}