<?php Bitrix\Main\Loader::includeModule("iblock");


use Bitrix\Iblock\IblockTable;
use Unlock\Iblock\ElementUnlockedTable;


$data = Customer\Data::DATA;

$type = $data['type'];           // list
$element = $data['element'];     // list


$itqex1 = IblockTable::query()
    ->setFilter(['CODE' => $type['CODE']])
    ->setSelect(['ID']);
$itqex1result1 = $itqex1->exec()->fetch();
$iblockId = $itqex1result1['ID'];


$ee = $element['element'];

foreach ($element['list'] as $el)
{
    $eta1 = ElementUnlockedTable::createObject();
    $eta1result = $eta1 ->setTimestampX(new \Bitrix\Main\Type\DateTime())
        ->setIblockId($iblockId)
        ->setName($el['NAME'])
        ->setCode($el['CODE'])
        ->save();
}


