<?php
/**
 * Created by PhpStorm.
 * User: howard
 * Date: 22.03.2015
 * Time: 19:04
 */
namespace core\base;

class Controller
{
    static $instance;
    public $id;
    public $layout = 'column1';
    public $action;
    public $title;

    /* @var \core\base\View */
    private $_view;

    private function __construct()
    {
        $this->init();
    }

    private function __wakeup()
    {
    }

    private function __clone()
    {
    }

    private function init()
    {
        $class = new \ReflectionClass($this);
        $this->id = strtolower(str_replace('Controller', '', $class->getShortName()));
        $this->_view = new View($this);
        if(!$this->title) {
            $this->title = ucfirst($this->id) . ' - ' . \Pie::$app->name;
        }
    }

    public static function getInstance()
    {
        static::$instance = new static();
        return static::$instance;
    }

    public function getView()
    {
        return $this->_view;
    }

    public function setView($view)
    {
        $this->_view = $view;
    }

    /**
     * @param $layout
     * @return bool|string
     */
    public function getLayoutFile($layout)
    {
        $DS = DIRECTORY_SEPARATOR;
        $viewPath = \Pie::$app->getBasePath() . $DS . 'views';
        $viewFile = $viewPath . $DS . 'layouts' . $DS . $layout . '.php';

        if (file_exists($viewFile)) {
            return $viewFile;
        } else {
            return false;
        }
    }

    public function __call($name, $arguments)
    {
        $this->runActionByPath(\Pie::$app->config['errorAction']);
    }

    public static function runActionByPath($path = null)
    {

        $url = $_GET['r'];
        if ($path) {
            $url = $path;
        }
        $url = rtrim($url, '/');
        $params = explode('/', $url);
        if (!empty($params[0]) && !empty($params[1])) {
            $name = $params[0];
            $controllerName = ucfirst($name) . 'Controller';
            /* @var $controller \core\base\Controller */
            $controller = \Pie::$app->config['controllerNamespace'] . '\\' . $controllerName;
            $instance = $controller::getInstance();
            $action = 'action' . ucfirst($params[1]);
            $instance->$action();
        }
    }

    public function render($view, $data = [])
    {
        return $this->getView()->render($view, $data);
    }

    public function redirect($url, $status = '302')
    {
        header("Location: $url", true, $status);
    }
}