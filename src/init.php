<?php /* Optimization options:
         #define JIT_CACHE_ENABLE    0
Zend Engine Optimization Header */ // php!>


define('ENABLE_REFLECTION_MODE', false);


define("PATH_DOCUMENT_ROOT", "/home/bitrix/www");


$_SERVER["DOCUMENT_ROOT"] = empty($_SERVER["DOCUMENT_ROOT"]) ? PATH_DOCUMENT_ROOT :
                                  $_SERVER["DOCUMENT_ROOT"];

require_once(PATH_DOCUMENT_ROOT . "/bitrix/modules/main/include/prolog_before.php");
require_once(PATH_DOCUMENT_ROOT . '/bitrix/vendor/autoload.php');

define(NO_KEEP_STATISTIC, true);     //запрет сбора статистики
define(NOT_CHECK_PERMISSIONS, true); //отключение проверки прав на доступ к файлам и каталогам
define(BX_BUFFER_USED, true);        // сбросит уровень буферизации CMain::EndBufferContent
define(LID, "s1");

set_time_limit(0);

while (ob_get_level()) { /* цикл, который сбросит все буферы */
    ob_end_flush();
}