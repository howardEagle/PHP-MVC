<?php
/**
 * Created by PhpStorm.
 * User: howard
 * Date: 24.03.2015
 * Time: 23:28
 */

namespace core\base;


class Action
{

    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

}