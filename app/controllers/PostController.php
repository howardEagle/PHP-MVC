<?php
/**
 * Created by PhpStorm.
 * User: howard
 * Date: 13.04.2015
 * Time: 15:12
 */

namespace app\controllers;


use app\models\Post;
use app\models\PostQuery;
use core\base\Controller;

class PostController extends Controller
{

    public function actionIndex()
    {
        $this->title = 'Post index page';
        $pq = new PostQuery();
        $models = $pq->query();
        $this->render('index', array('models' => $models));
    }
}