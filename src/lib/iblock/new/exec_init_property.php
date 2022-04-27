<?php Bitrix\Main\Loader::includeModule("iblock");


use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Iblock\PropertyFeatureTable;
use Bitrix\Iblock\SectionPropertyTable;


$data = Customer\Data::DATA;

$container = $data['container'];     // list


$itqex1 = IblockTable::query()
    ->setFilter(['CODE' => $container['CODE']])
    ->setSelect(['ID']);
$itqex1result1 = $itqex1->exec()->fetch();
$iblockId = $itqex1result1['ID'];


$ptqex1 = PropertyTable::query()
    ->setFilter(['IBLOCK_ID' => $iblockId])
    ->setSelect(['CODE']);
$ptqex1result1 = $ptqex1->exec();


$ptqex1data  = [];
$ptqex1count = 0;
while ($ptqex1row = $ptqex1result1->fetch())
{
    array_push($ptqex1data, $ptqex1row['CODE']);
    $ptqex1count++;
}

    $p = $container['PROPERTY']['property'];
foreach ($container['PROPERTY']['list'] as $property)
{
    if(in_array($property['CODE'], $ptqex1data))
    {
        continue;
    }

    if(array_key_exists('PROPERTY_TYPE', $property))
    {
        $p['PROPERTY_TYPE'] = $property['PROPERTY_TYPE'];
    }

    $pta1 = PropertyTable::createObject();
    $pta1result =  $pta1->setIblockId($iblockId)
        ->setName($property['NAME'])
        ->setCode($property['CODE'])
        ->setActive($p['ACTIVE'])
        ->setPropertyType($p['PROPERTY_TYPE'])
        ->save();
    $ptid = $pta1->getId();


    $ptfa1 = PropertyFeatureTable::createObject();
    $ptfa1result =  $ptfa1->setPropertyId($ptid)
        ->setModuleId('iblock')
        ->setFeatureId('LIST_PAGE_SHOW')
        ->setIsEnabled('N')
        ->save();
    $ptfa2 = PropertyFeatureTable::createObject();
    $ptfa2result =  $ptfa2->setPropertyId($ptid)
        ->setModuleId('iblock')
        ->setFeatureId('DETAIL_PAGE_SHOW')
        ->setIsEnabled('N')
        ->save();


    $pta1 = SectionPropertyTable::createObject();
    $pta1result =  $pta1->setIblockId($iblockId)
        ->setSectionId(0)
        ->setPropertyId($ptid)
        ->setSmartFilter('Y')
        ->setDisplayType('F')
        ->setDisplayExpanded('N')
        ->setFilterHint('')
        ->save();
}
