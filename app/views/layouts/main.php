<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Web Application</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" type="text/css" href="/css/main.css"/>
</head>
<body>
<?php use \core\base\Session; ?>
<!-- BEGIN wrapper -->
<div id="wrapper">
    <!-- BEGIN header -->
    <div id="header">
        <!-- begin pages -->
        <ul class="pages">
            <li><a href="/?r=user/about">About me</a></li>
            <li><a href="/?r=user/register">Register</a></li>
        </ul>
        <!-- end pages -->
        <form action="http://all-free-download.com/free-website-templates/">
            <input type="text" name="s" id="s" value=""/>
            <button type="submit">Search</button>
        </form>
        <div class="break"></div>
        <!-- begin logo -->
        <div class="logo">
            <h1><a href="/"><?php echo Pie::$app->name; ?></a></h1>

            <p>To be continue...</p>
        </div>
        <!-- end logo -->
        <!-- begin sponsor -->
        <div class="sponsor"><a href="http://all-free-download.com/free-website-templates/"><img
                    src="images/ad468x60.gif" alt=""/></a></div>
        <!-- end sponsor -->
        <!-- begin categories -->
        <ul class="categories">
            <li><a href="/?r=post">Posts</a></li>
            <li>
                <?php
                $userId = $_SESSION['user_id'];
                if (empty($userId)) : ?>
                    <a href="/?r=user/login">Login</a>
                <?php else : ?>
                    <a href="/?r=user/logout">Logout</a>
                <?php endif ?>
            </li>
        </ul>
        <!-- end categories -->
    </div>
    <!-- END header -->
    <!-- BEGIN content -->

    <?= $content; ?>
    <!-- end recent posts -->

    <!-- END content -->

</div>
<!-- END wrapper -->
<!-- BEGIN footer -->
<div id="footer">
    <p class="l">Copyright &copy; <?= date('Y') ?> - All Rights Reserved.
        <br><strong>Pie version <?php echo Pie::$app->getVersion() ?></strong>
        Page loaded for: <?php echo microtime(true) - PIE_BEGIN_TIME; ?>
    </p>
</div>
<!-- END footer -->
</body>
</html>
