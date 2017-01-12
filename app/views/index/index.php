<?php
/* @var $this core\base\View */

$this->setMetaTag('Index page', 'description');
$this->setMetaTag('index, page, yeah!', 'keywords');

?>
<h1><?php echo $this->title; ?></h1>
<div class="content">
    <?php echo $content;?>
</div>