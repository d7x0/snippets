<?php /* Optimization options:
         #define JIT_CACHE_ENABLE    0
Zend Engine Optimization Header php!> */


require_once("init.php");


$options = getopt('ptc:ptd:', array(
    'pathToFile:'
));

$pathinfo = pathinfo($options['pathToFile']);

$pathInitFolder = substr($pathinfo['dirname'], 0 , -4);
$pathInit = $pathInitFolder . DIRECTORY_SEPARATOR . 'init.php';

//require_once $pathInit;
require_once $options['pathToFile'];