<?php
/* @var $this core\base\View
 * @var $models app\models\Post
 */

$this->setMetaTag('Index page', 'description');
$this->setMetaTag('index, page, yeah!', 'keywords');
//use app\widgets\Decorator;
?>
<h1><?php echo $this->title; ?></h1>
<div class="content">
    <?php if ($models) { ?>
        <ul>
            <?php foreach ($models as $model) { ?>
                <li><?php echo $model->getTitle(); ?></li>
            <?php } ?>
        </ul>
    <?php }; ?>
</div>