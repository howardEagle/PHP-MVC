<?php
/**
 * Created by PhpStorm.
 * User: howard
 * Date: 13.04.2015
 * Time: 15:51
 */

namespace backend\controllers;


use app\models\Post;
use core\base\Controller;

class PostController extends Controller
{
    public function actionCreate()
    {
        $post = new Post();
        $post->setTitle('Ada');
        $post->setContent('Lovelace');
        $post->setCreatedAt((new \DateTime('now'))->format('Y-m-d H:i:s'));
        $post->setStatus(1);
        $post->save();
        $id =  $post->getId();

        $this->render('create', array('id' => $id));
    }
}