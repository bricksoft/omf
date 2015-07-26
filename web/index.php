<?php

// remove this in productive environments!
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

/* Require and initialize Autoloader */
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'autoload_custom.php';
$app = App\core::get_instance();
$app->dispatch();
?>