<?php Bitrix\Main\Loader::includeModule("iblock");


use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Iblock\PropertyEnumerationTable;


$data = Customer\Data::DATA;

$container = $data['container'];     // list


$itqex1 = IblockTable::query()
    ->setFilter(['CODE' => $container['CODE']])
    ->setSelect(['ID']);
$itqex1result1 = $itqex1->exec()->fetch();
$iblockId = $itqex1result1['ID'];


$ptqex1 = PropertyTable::query()
    ->setFilter(['IBLOCK_ID' => $iblockId])
    ->setSelect(['CODE', 'ID']);
$ptqex1result1 = $ptqex1->exec();


$ptqex1data  = [];
$ptqex1count = 0;
while ($ptqex1row = $ptqex1result1->fetch())
{
    $ptqex1data[$ptqex1row['CODE']] = $ptqex1row['ID'];
    $ptqex1count++;
}

    $p = $container['PROPERTY']['property'];
foreach ($container['PROPERTY']['list'] as $property)
{
    foreach($property['SETTINGS']['PROPERTY_ENUM'] as $propenum)
    {
        $xmlId = md5($property['CODE'] . $propenum['VALUE']);
        $petaex1result  = PropertyEnumerationTable::createObject()
            ->setPropertyId($ptqex1data[$property['CODE']])
            ->setSort($propenum['SORT'])
            ->setDef($propenum['DEF'])
            ->setValue($propenum['VALUE'])
            ->setXmlId($xmlId)
            ->save();
    }
}
