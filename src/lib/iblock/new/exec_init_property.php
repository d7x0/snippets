<?php Bitrix\Main\Loader::includeModule("iblock");


use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\PropertyTable;


$data = Customer\Data::DATA;

$container = $data['container'];     // list


$itqex1 = IblockTable::query()
    ->setFilter(['CODE' => $container['CODE']])
    ->setSelect(['ID']);
$itqex1result1 = $itqex1->exec()->fetch();
$iblockId = $itqex1result1['ID'];

$p = $container['PROPERTY']['property'];

foreach ($container['PROPERTY']['list'] as $property)
{
    $pta1 = PropertyTable::createObject();
    $pta1result =  $pta1->setIblockId($iblockId)
        ->setName($property['NAME'])
        ->setCode($property['CODE'])
        ->setActive($p['ACTIVE'])
        ->setPropertyType($p['PROPERTY_TYPE'])
        ->save();
}
