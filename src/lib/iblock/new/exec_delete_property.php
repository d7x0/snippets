<?php Bitrix\Main\Loader::includeModule("iblock");


use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Iblock\ElementPropertyTable;
use Bitrix\Iblock\PropertyEnumerationTable;
use Bitrix\Iblock\PropertyFeatureTable;
use Bitrix\Iblock\SectionPropertyTable;


$data = Customer\Data::DATA;


$container = $data['container'];     // list


$itqex1 = IblockTable::query()
    ->setFilter(['CODE' => $container['CODE']])
    ->setSelect(['ID']);
$itqex1result1 = $itqex1->exec()->fetch();
$iblockId = $itqex1result1['ID'];                                       // get iblock id


$idListProperty  = [];
$ptqex1pq = PropertyTable::query()
    ->setFilter(['IBLOCK_ID' => $iblockId])
    ->setSelect(['CODE', 'ID'])
    ->exec();
while ($ptqex1prow = $ptqex1pq->fetch())
{
    if(!in_array($ptqex1prow['CODE'], $container['PROPERTY']))
    {
        continue;
    }

    array_push($idListProperty, $ptqex1prow['ID']);              // get property id
}

$idListPropertyEnum = [];
$petglex1peq   = PropertyEnumerationTable::query()
    ->setFilter(['PROPERTY_ID' => $idListProperty])
    ->setSelect(['ID'])
    ->exec();
while($petglex1perow = $petglex1peq->fetch())
{
    array_push($idListPropertyEnum, $petglex1perow['ID']);       // get property enum id
}


$idListPropertyFeature = [];
$ptqex1pfq = PropertyFeatureTable::query()
    ->setFilter(['PROPERTY_ID' => $idListProperty])
    ->setSelect(['ID'])
    ->exec();
while($ptqex1pfrow = $ptqex1pfq->fetch())
{
    array_push($idListPropertyFeature, $ptqex1pfrow['ID']);      // get property feature id
}


$idListSectionProperty = [];
$ptqex1spq = SectionPropertyTable::query()
    ->setFilter(['PROPERTY_ID' => $idListProperty])
    ->setSelect(['IBLOCK_ID', 'SECTION_ID', 'PROPERTY_ID'])
    ->exec();
while($ptqex1spqrow = $ptqex1spq->fetch())
{
    array_push($idListSectionProperty, $ptqex1spqrow);      // get property feature id
}

$idListElementProperty = [];
$eptglex1prq = ElementPropertyTable::query()
    ->setFilter(['IBLOCK_PROPERTY_ID' => $idListProperty])
    ->setSelect(['ID'])
    ->exec();
while($eptglex1prrow= $eptglex1prq->fetch())
{
    array_push($idListElementProperty, $eptglex1prrow['ID']);    // get element property id
}




foreach ($idListElementProperty as $id)
{
    $itu1result = ElementPropertyTable::getByPrimary($id)->fetchObject()->delete();
}

foreach ($idListPropertyEnum as $id)
{
    $petdex1qu = PropertyEnumerationTable::getByPrimary([
        'ID' => $id
    ])->fetchObject();
    $petdex1result = $petdex1qu->delete();
}

foreach ($idListPropertyFeature as $id)
{
    $ptd1 = PropertyFeatureTable::getByPrimary($id)->fetchObject()->delete();
}

foreach ($idListSectionProperty as $id)
{
    $ptd1 = SectionPropertyTable::getByPrimary([
        'IBLOCK_ID'     => $id['IBLOCK_ID'],
        'SECTION_ID'    => $id['SECTION_ID'],
        'PROPERTY_ID'   => $id['PROPERTY_ID'],
    ])->fetchObject();
    $ptd1result = $ptd1->delete();
}

foreach ($idListProperty as $id)
{
    $ptd1 = PropertyTable::getByPrimary($id)->fetchObject()->delete();
}

