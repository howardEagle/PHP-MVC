<?php
/**
 * Created by PhpStorm.
 * User: howard
 * Date: 04.04.2015
 * Time: 1:04
 */

namespace core\base;

use ReflectionClass;

class Decorator extends View implements ViewInterface
{

    public static $widgets = array();

    /**
     * @var self
     */
    public static $ins;
    public static $path = null;
    public static function init()
    {
        self::$ins = new self;
    }

    public static function begin($path = '')
    {
        self::$path = $path;
        self::init();
        ob_start();
        ob_implicit_flush(false);
    }


    /**
     * Ends a widget.
     * Note that the rendering result of the widget is directly echoed out.
     * @return static the widget instance that is ended.
     * @throws InvalidCallException if [[begin()]] and [[end()]] calls are not properly nested
     */
    public static function end()
    {
        $out1 = ob_get_contents();
        $c = self::$ins->renderFile(self::$path, ['content' => $out1], true);
        ob_clean();
        echo $c;
    }

    /**
     * @param $layout
     * @return bool|string
     */
    public function getLayoutFile($layout)
    {
        $DS = DIRECTORY_SEPARATOR;
        $viewPath = \Pie::$app->getBasePath() . $DS . 'views';
        $viewFile = $viewPath . $layout . '.php';

        if (file_exists($viewFile)) {
            return $viewFile;
        } else {
            return false;
        }
    }

    /**
     * Returns the directory containing the view files for this widget.
     * The default implementation returns the 'views' subdirectory under the directory containing the widget class file.
     * @return string the directory containing the view files for this widget.
     */
    public function getViewPath()
    {
        $class = new ReflectionClass($this);
        return dirname($class->getFileName()) . DIRECTORY_SEPARATOR . 'views';
    }

    /**
     * @return string
     */
    public function run()
    {
    }
}