<?php
/**
 * Created by PhpStorm.
 * User: howard
 * Date: 27.04.2015
 * Time: 17:22
 */

namespace app\models;


class UserQuery extends MUserDaoFactory
{
    function loadDataObject(Array $row = null)
    {
        return new User($row);
    }
}