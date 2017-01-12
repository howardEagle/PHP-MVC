<?php

/**
 * User: howard
 * Date: 22.03.2015
 * Time: 19:09
 */

namespace core\base;

defined('PIE_BEGIN_TIME') or define('PIE_BEGIN_TIME', microtime(true));

defined('PIE_DEBUG') or define('PIE_DEBUG', false);

use Parm\Config;
use Parm\Mysql\DatabaseNode;

class BaseApp
{
    public static $app;

    public $name = 'My cool application';

    public $charset = 'utf-8';

    public $language = 'en-US';

    public $layout = 'main';

    /**
     * @var \core\base\Request
     */
    public $request;

    private $_controller;

    private $_basePath;

    private $user = null;

    private $defaultConfig = [
        'name' => 'My cool application',
        'charset' => 'utf-8',
        'language' => 'en-US',
        'defaultController' => 'index',
        'controllerNamespace' => 'app\controllers',
        'request' => array(
            'class' => 'core\base\Request'
        ),
        'timeZone' => 'Europe/Kiev'
    ];

    public $config = array();

    public function __construct($config)
    {
        self::$app = $this;
        $this->configure($config);
    }

    /**
     * Returns a string representing the current version of the Yii framework.
     * @return string the version of Yii framework
     */
    public static function getVersion()
    {
        return '0.0.1';
    }

    private function configure($config)
    {
        $this->config = $config = array_merge($this->defaultConfig, $config);
        $this->setBasePath($config['basePath']);
        $requestClass = $this->config['request']['class'];
        $this->setTimeZone($this->config['timeZone']);

        if(!empty($this->config['name'])) {
            $this->setName($this->config['name']);
        }

        if(!isset($this->config['db'])) {
            throw new \Exception('Database was not set');
        }
        $this->setDb($this->config['db']);

        mb_internal_encoding($config['charset']);
        $this->request = new $requestClass();
        $this->registerVendors();
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setController($name)
    {
        $controllerFile = ucfirst($name) . 'Controller';
        $controller = $this->config['controllerNamespace'] . '\\' . $controllerFile;
        if (class_exists($controller)) {

        } else {
            $controller = $this->config['controllerNamespace'] . '\\'
                . $this->config['defaultController'] . 'Controller';
        }

        $this->_controller = $controller::getInstance();
    }

    public function getController()
    {
        return $this->_controller;
    }

    public function getBasePath()
    {
        return $this->_basePath;
    }

    public function setBasePath($path)
    {
        if (($this->_basePath = realpath($path)) === false || !is_dir($this->_basePath)) {
            throw new \Exception('Application base path "{path}" is not a valid directory.', 500);
        }
    }

    public function getRootPath()
    {
        return $_SERVER['DOCUMENT_ROOT'];
    }

    public static function loader($className)
    {
        $filename = \Pie::$app->getRootPath() . DIRECTORY_SEPARATOR . str_replace('\\', '/', $className) . ".php";
        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return true;
            }
        }
        return false;
    }

    public function getRequest()
    {
        if (null === $this->request) {
            $this->request = new Request(false);
        }
        return $this->request;
    }

    /**
     * Returns the time zone used by this application.
     * @return string the time zone used by this application.
     * @see http://php.net/manual/en/function.date-default-timezone-get.php
     */
    public function getTimeZone()
    {
        return date_default_timezone_get();
    }

    /**
     * Sets the time zone used by this application.
     * @param string $value the time zone used by this application.
     * @see http://php.net/manual/en/function.date-default-timezone-set.php
     */
    public function setTimeZone($value)
    {
        date_default_timezone_set($value);
    }

    public function registerVendors()
    {
        $path = \Pie::$app->getRootPath() . DIRECTORY_SEPARATOR . 'vendor';
        require($path . DIRECTORY_SEPARATOR . 'autoload.php');
    }


    /**
     * @param array $params
     */
    public function setDb(array $params)
    {
        Config::addDatabase($params['db'],
            new DatabaseNode($params['db'], $params['host'], $params['username'], $params['password']));
    }

    public function run()
    {
    }
}
