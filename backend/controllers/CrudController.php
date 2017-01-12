<?php
/**
 * Created by PhpStorm.
 * User: howard
 * Date: 13.04.2015
 * Time: 15:07
 */

namespace backend\controllers;


use core\base\Controller;
use Parm\Generator\DatabaseGenerator;
use Parm\Config;

class CrudController extends Controller {

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionCreate()
    {
        $generator = new DatabaseGenerator(Config::getDatabase('mvc'));
        $generator->setDestinationDirectory(\Pie::$app->getRootPath() . '/app/models/dao');
        $generator->setGeneratedNamespace("app\\models");
        $generator->generate();
        $this->render('createCrud');
    }
}