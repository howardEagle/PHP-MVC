<?php
/**
 * Created by PhpStorm.
 * User: howard
 * Date: 27.04.2015
 * Time: 17:21
 */

namespace app\models;


use core\base\Session;

class User extends MUserDaoObject {

    protected static $_errors = array();

    public static function rules()
    {
        return array(
            array('login,password', 'required'),
            array('login', 'unique')
        );
    }


    public function validate()
    {
        $result = true;
        $fields = $this->getFields();
        $rules = self::rules();
        foreach($rules as $rule) {
            $attrs = explode(',', $rule[0]);
            $existsAttrs = array_intersect($fields, $attrs);
            if(count($existsAttrs) && $rule[1] == 'required') {
                foreach($existsAttrs as $attribute) {
                    if(!$this->getFieldValue($attribute)) {
                        self::$_errors[$attribute] = "Field {$attribute} must be set";
                        $result = false;
                    }
                }
            }

        }

        return $result;
    }

    public function getErrors()
    {
        return self::$_errors;
    }

    public function login()
    {
        session_start();
        $_SESSION['user_id'] = $this->getId();
        //var_dump(Session::get('user_id'));
    }
}