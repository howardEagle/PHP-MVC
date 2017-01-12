<?php
/**
 * Created by PhpStorm.
 * User: howard
 * Date: 13.04.2015
 * Time: 14:58
 */

namespace backend\controllers;

use core\base\Controller;

class MainController extends Controller {

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionError()
    {
        if ($error = \Pie::$app->request->getError()) {
            $this->render('error', $error);
        }
    }
}