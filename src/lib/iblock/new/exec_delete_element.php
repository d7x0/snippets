<?php Bitrix\Main\Loader::includeModule("iblock");


use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\ElementPropertyTable;
use Unlock\Iblock\ElementUnlockedTable;


$data = Customer\Data::DATA;


$container = $data['container'];     // list


$itqex1 = IblockTable::query()
    ->setFilter(['CODE' => $container['CODE']])
    ->setSelect(['ID']);
$itqex1result1 = $itqex1->exec()->fetch();
$iblockId = $itqex1result1['ID'];                                  // get iblock id

$codeListElement = [];
foreach ($container['element'] as $element)
{
    array_push($codeListElement, $element['CODE']);         // get element code
}

$idListElement = [];
$etqex1 = ElementUnlockedTable::query()
    ->setFilter(['IBLOCK_ID' => $iblockId, 'CODE' => $codeListElement])
    ->setSelect(['ID']);
$etqex1result1 = $etqex1->exec();
while ($etqex1row = $etqex1result1->fetch())
{
    array_push($idListElement, $etqex1row['ID']);           // get element id
}

$idListElementProperty = [];
$eptglex1epq = ElementPropertyTable::query()
    ->setFilter(['IBLOCK_ELEMENT_ID' => $idListElement])
    ->setSelect(['ID'])
    ->exec();
while ($eptglex1eprow = $eptglex1epq->fetch())
{
    array_push($idListElementProperty, $eptglex1eprow['ID']);           // get element property id
}


foreach ($idListElementProperty as $id)
{
    $itu1result = ElementPropertyTable::getByPrimary($id)->fetchObject()->delete();
}

foreach ($idListElement as $id)
{
    $itu1result = ElementUnlockedTable::getByPrimary($id)->fetchObject()->delete();
}

