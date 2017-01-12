<?php
/**
 * User: howard
 * Date: 23.03.2015
 * Time: 21:18
 */

require('base/BaseApp.php');

/**
 * Pie is a helper class serving common framework functionality.
 *
 */
class Pie extends \core\base\BaseApp
{
}

spl_autoload_register(['Pie', 'loader'], true, true);
