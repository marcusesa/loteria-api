<?php

define('DS', DIRECTORY_SEPARATOR);
define('API_PATH', realpath(__DIR__) . DS);

date_default_timezone_set('America/Sao_Paulo');

/**
 * Autoload Composer 
 */

require API_PATH . DS . 'vendor' . DS . 'autoload.php';
