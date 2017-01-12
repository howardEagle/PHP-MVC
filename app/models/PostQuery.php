<?php
/**
 * Created by PhpStorm.
 * User: howard
 * Date: 24.04.2015
 * Time: 0:39
 */

namespace app\models;

class PostQuery extends MPostDaoFactory
{
    function loadDataObject(Array $row = null)
    {
        return new Post($row);
    }
}