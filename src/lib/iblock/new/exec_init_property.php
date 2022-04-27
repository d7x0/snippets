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
$iblockId = $itqex1result1['ID'];                               // get iblock id


$ptqex1data  = [];
$ptqex1q = PropertyTable::query()
    ->setFilter(['IBLOCK_ID' => $iblockId])
    ->setSelect(['CODE'])->exec();
while ($ptqex1row = $ptqex1q->fetch())
{
    array_push($ptqex1data, $ptqex1row['CODE']);
}

    $propdefault
       = $container['PROPERTY']['default'];
foreach ($container['PROPERTY']['list'] as $property)
{
    if(in_array($property['CODE'], $ptqex1data))
    {
        dump('Property with ID: "' . $property['CODE'] . '" already exist');
        dump('Property not created');
        continue;
    }

    $proptype = array_key_exists('PROPERTY_TYPE', $property)
        ? $property['PROPERTY_TYPE'] : $propdefault['PROPERTY_TYPE'];
    $property['PROPERTY_TYPE'] = $proptype;
    $property['ACTIVE'] = $propdefault['ACTIVE'];


    $pta1 = PropertyTable::createObject();
    $pta1result =  $pta1->setIblockId($iblockId)
        ->setName($property['NAME'])
        ->setCode($property['CODE'])
        ->setActive($property['ACTIVE'])
        ->setPropertyType($property['PROPERTY_TYPE'])
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
