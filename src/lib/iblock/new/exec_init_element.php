<?php Bitrix\Main\Loader::includeModule("iblock");

use Bitrix\Iblock\TypeTable;
use Bitrix\Iblock\TypeLanguageTable;
use Bitrix\Iblock\IblockTable;

// add type
$tta1 = TypeTable::createObject();
$tta1result =  $tta1->setId('contragent')
    ->save();

// add type lang
$tlta11 = TypeLanguageTable::createObject();
$tlta1result1 =  $tlta11->setIblockTypeId('contragent')
    ->setLanguageId('ru')
    ->setName('Контрагенты')
    ->save();

// add container
$ita1 = IblockTable::createObject();
$ita1result =  $ita1->setIblockTypeId('catalog')
    ->setLid('s1')
    ->setCode('computers')
    ->setName('Компьютеры')
    ->save();

