<?php /* Optimization options:
         #define JIT_CACHE_ENABLE    0
Zend Engine Optimization Header php!> */


require_once("init.php");


$options = getopt('ptc:ptd:', array(
    'moduleName:',
    'apiType:',
    'pathToData:',
    'queryBuilder:',
));


$nameFileData = substr($options['pathToData'], strripos($options['pathToData'], DIRECTORY_SEPARATOR) + 1);
$nameFileAPI = substr_count($options['pathToData'], "_") >= 2
    ? substr($nameFileData, 0, strripos($nameFileData, "_")) . ".php"
    : $nameFileData;


$pathExec = "lib" . DIRECTORY_SEPARATOR . $options['moduleName']
                  . DIRECTORY_SEPARATOR . $options['apiType']
                  . DIRECTORY_SEPARATOR . "exec_" . $nameFileAPI;

if(count($options) < 3)
{
    dump('Command line argument count < 3. Operation aborted');
    die;
}

$pathToData = trim($options['pathToData']);
$pathExec   = trim($pathExec);


require_once $pathToData;
require_once $pathExec;