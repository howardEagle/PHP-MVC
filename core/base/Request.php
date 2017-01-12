<?php
/**
 * Created by PhpStorm.
 * User: howard
 * Date: 22.03.2015
 * Time: 19:06
 */

namespace core\base;

class Request
{
    public $error = null;

    public function __construct($parse = true)
    {
        $this->normalizeRequest();
        if($parse) {
            $this->parseUrl();
        }
    }

    /**
     * Normalizes the request data.
     */
    protected function normalizeRequest()
    {
        // normalize request
        if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
            if (isset($_GET))
                $_GET = $this->stripSlashes($_GET);
            if (isset($_POST))
                $_POST = $this->stripSlashes($_POST);
            if (isset($_REQUEST))
                $_REQUEST = $this->stripSlashes($_REQUEST);
            if (isset($_COOKIE))
                $_COOKIE = $this->stripSlashes($_COOKIE);
        }
    }


    public function parseUrl()
    {
        $url = $this->parseUrlPath();
        $errorPath = \Pie::$app->config['errorAction'];
        try {
            /* @var $controller \core\base\Controller */
            if (empty($url[0])) {
                $controllerName = \Pie::$app->config['defaultController'];
            } else {
                $controllerName = $url[0];
            }

            $controller = \Pie::$app->config['controllerNamespace'] . '\\'
                . ucfirst($controllerName) . 'Controller';

            if (!class_exists($controller)) {
                $this->handleError(500, 'Internal server error');
                Controller::runActionByPath($errorPath);
                return;
            }

            \Pie::$app->setController($url[0]);
            $instance = $controller::getInstance();
            if (empty($url[1])) {
                if (!method_exists($instance, 'actionIndex')) {
                    $this->handleError(404, "Default action <b>index</b> not found in {$controllerName}.");
                    Controller::runActionByPath($errorPath);
                } else {
                    $instance->actionIndex();
                }
            } else {
                $action = 'action' . ucfirst($url[1]);
                if (!method_exists($instance, $action)) {
                    $this->handleError(404, "Action <b>{$url[1]}</b> not found.");
                    $instance->errorAction();
                } else {
                    $instance->$action();
                }
            }

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }

    public function handleError($code = null, $message = null)
    {
        http_response_code($code);
        if (!$code && !$message) {
            $error = error_get_last();
        } else {
            $error = array(
                'code' => $code,
                'message' => $message
            );
        }

        $this->error = $error;
        \Pie::$app->request = $this;
    }

    public function getError()
    {
        return $this->error;
    }

    public function setError($error)
    {
        $this->error = $error;
    }

    public function getParams()
    {
        parse_str($_SERVER["QUERY_STRING"], $params);
        return $params;
    }

    public function parseUrlPath($path = null)
    {
        $url = $_GET['r'];
        if ($path) {
            $url = $path;
            $result = array();
        } else {
            $url = rtrim($url, '/');
            $result = explode('/', $url);
        }

        return $result;
    }

    public function isPost()
    {
        if (!empty($_POST)) {
            return true;
        }

        return false;
    }

    public function isGet()
    {
        if (!empty($_GET)) {
            return true;
        }

        return false;
    }

    /**
     * Strips slashes from input data.
     * This method is applied when magic quotes is enabled.
     * @param mixed $data input data to be processed
     * @return mixed processed data
     */
    public function stripSlashes(&$data)
    {
        if (is_array($data)) {
            if (count($data) == 0) {
                return $data;
            }
            $keys = array_map('stripslashes', array_keys($data));
            $data = array_combine($keys, array_values($data));
            return array_map(array($this, 'stripSlashes'), $data);
        } else {
            return stripslashes($data);
        }
    }

}