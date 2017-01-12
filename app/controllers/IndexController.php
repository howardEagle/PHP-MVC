<?php
/**
 * User: howard
 * Date: 22.03.2015
 * Time: 18:59
 */

namespace app\controllers;

use \core\base\Controller;

class IndexController extends Controller
{

    public $layout= 'column2';

    public function actionIndex()
    {
        $this->title = 'Index page';
        $this->render('index', array('content' => 'Index controller index'));
    }

    public function actionView()
    {
        //$this->title = 'View page';
        $this->render('view', array('content' => 'IView'));
    }

    public function actionError()
    {
        if ($error = \Pie::$app->request->getError()) {
            $this->render('error', $error);
        }
    }
}