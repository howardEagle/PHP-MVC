<?php
/**
 * Created by PhpStorm.
 * User: howard
 * Date: 24.03.2015
 * Time: 0:14
 */

namespace core\base;


class View
{
    /* @var \core\base\Controller */
    private $controller;

    public $title;

    protected $metaTags = array();

    public function __construct($controller = null)
    {
        if ($controller) {
            $this->controller = $controller;
        }
    }

    public function getOwner()
    {
        return $this->controller;
    }

    /**
     * @param $view
     * @param array $data
     * @param bool $return
     * @return string
     */
    public function renderFile($view, $data = [], $return = false)
    {
        if (($viewFile = $this->getViewFile($view)) !== false) {
            // we use special variable names here to avoid conflict when extracting data
            if (is_array($data)) {
                extract($data, EXTR_PREFIX_SAME, 'data');
            }

            if ($return) {
                ob_start();
                ob_implicit_flush(false);
                require($viewFile);
                return ob_get_clean();
            } else {
                require($viewFile);
            }
        }
    }

    public function render($view, $data = null, $return = false)
    {
        if ($this->preRender($view)) {
            $output = $this->renderPartial($view, $data, true);
            if (($layoutFile = $this->getOwner()->getLayoutFile($this->getOwner()->layout))
                !== false
            ) {

                $output = $this->renderFile($layoutFile, array('content' => $output), true);
                $this->setHeader($output);
            }

            if ($return) {
                return $output;
            } else {
                echo $output;
            }
        }
    }

    /**
     * @param string $output
     */
    public function setPageTitle(&$output)
    {
        $title = $this->getOwner()->title;
        if ($title) {
            preg_match('/<title>(.*)<\/title>/i', $output, $matches);
            $output = preg_replace('/(<title>)(.*)(<\/title>)/i', '$1' . $title . '$3', $output);
        }
    }

    /**
     * @param string $output
     */
    private function setHeader(&$output)
    {
        $html = '';
        if ($this->metaTags) {
            foreach ($this->metaTags as $name => $content) {
                $html .= "<meta name=$name content='$content'>\n";
            }
        }

        $this->setPageTitle($output);

        $count = 0;
        $output = preg_replace('/(<title\b[^>]*>|<\\/head\s*>)/is', '<###head###>$1', $output, 1, $count);
        if ($count) {
            $output = str_replace('<###head###>', $html, $output);
        } else {
            $output = $html . $output;
        }

    }

    /**
     * @param $view
     * @param null $data
     * @param bool $return
     * @return string
     * @throws \Exception
     */
    public function renderPartial($view, $data = null, $return = false)
    {
        if (($viewFile = $this->getViewFile($view)) !== false) {
            $output = $this->renderFile($view, $data, true);

            if ($return) {
                return $output;
            } else {
                echo $output;
            }
        } else {
            throw new \Exception(get_class($this) . ' cannot find the requested view ' . $view);
        }
    }

    /**
     * @param $view
     * @return bool|string
     */
    public function getViewFile($view)
    {
        $DS = DIRECTORY_SEPARATOR;
        if (strpos($view, $DS)) {
            $viewFile = $view;
        } else {
            $viewPath = \Pie::$app->getBasePath() . $DS . 'views';
            $viewFile = $viewPath . $DS . $this->getOwner()->id . $DS . str_replace('.php', '', $view) . '.php';
        }

        if (file_exists($viewFile)) {
            return $viewFile;
        } else {
            return false;
        }
    }

    public function preRender($view)
    {
        return true;
    }

    public function setMetaTag($content, $name)
    {
        $this->metaTags[$name] = $content;
    }
}