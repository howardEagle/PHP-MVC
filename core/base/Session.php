<?php
/**
 * User: howard
 * Date: 24.03.2015
 * Time: 23:27
 */

namespace core\base;


class Session
{
    /**
     * Add to session
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Return session by key
     *
     * @param string $key
     * @return mixed
     */
    public static function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * Delete by key
     *
     * @param string $key
     * @return void
     */
    final public static function remove($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}