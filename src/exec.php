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

if(count($options) < 3)
{
    dump('Command line argument count < 3. Operation aborted');
    die;
}

require_once $options['pathToData'];
require_once $pathExec;