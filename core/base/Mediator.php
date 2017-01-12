<?php
/**
 * Created by PhpStorm.
 * User: howard
 * Date: 30.03.2015
 * Time: 0:02
 */

namespace core\base;


class Mediator
{
    protected $events = array();

    public function attach($eventName, $callback)
    {
        if (!isset($this->events[$eventName])) {
            $this->events[$eventName] = array();
        }
        $this->events[$eventName][] = $callback;
    }

    public function trigger($eventName, $data = null)
    {
        foreach ($this->events[$eventName] as $callback) {
            $callback($eventName, $data);
        }
    }
}