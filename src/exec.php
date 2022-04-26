<?php /* Optimization options:
         #define JIT_CACHE_ENABLE    0
Zend Engine Optimization Header php!> */


require_once("init.php");


$options = getopt('ptc:ptd:', array(
    'moduleName:',
    'apiType:',
    'pathToData:',
));


$nameExec = substr($options['pathToData'], strripos($options['pathToData'], "/") + 1);
$pathExec = "lib" . DIRECTORY_SEPARATOR . $options['moduleName']
                  . DIRECTORY_SEPARATOR . $options['apiType']
                  . DIRECTORY_SEPARATOR . "exec_" . $nameExec;

require_once $options['pathToData'];
require_once $pathExec;