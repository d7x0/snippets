<?php Bitrix\Main\Loader::includeModule("iblock");


use Bitrix\Iblock\TypeTable;
use Bitrix\Iblock\TypeLanguageTable;
use Bitrix\Iblock\ElementTable;
use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\IblockSiteTable;
use Bitrix\Iblock\IblockFieldTable;
use Bitrix\Iblock\IblockMessageTable;
use Bitrix\Iblock\IblockGroupTable;
use Unlock\Iblock\ElementUnlockedTable;


$d = $data;
$dt = $data['type'];        // list
$de = $data['element'];     // list


$itqex1 = IblockTable::query()
    ->setFilter(['CODE' => $dt['CODE']])
    ->setSelect(['ID']);
$itqex1result1 = $itqex1->exec()->fetch();
$iblockId = $itqex1result1['ID'];


$dee = $de['element'];

foreach ($de['list'] as $element)
{
    $eta1 = ElementUnlockedTable::createObject();
    $eta1result = $eta1 ->setTimestampX(new \Bitrix\Main\Type\DateTime())
        ->setIblockId($iblockId)
        ->setName($element['NAME'])
        ->save();
}


