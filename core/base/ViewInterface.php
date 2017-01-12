<?php
/**
 * Created by PhpStorm.
 * User: howard
 * Date: 14.04.2015
 * Time: 0:58
 */

namespace core\base;


interface ViewInterface
{
    public function getLayoutFile($layout);

    public function run();
}