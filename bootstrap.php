<?php

define('DS', DIRECTORY_SEPARATOR);
define('API_PATH', realpath(__DIR__) . DS);

/**
 * Autoload Composer 
 */

require API_PATH . DS . 'vendor' . DS . 'autoload.php';
