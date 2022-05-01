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
while ($ptqex1row = $ptqex1result1->fetch())
{
    $ptqex1data[$ptqex1row['CODE']] = $ptqex1row['ID'];
}

$ptqex2 = PropertyEnumerationTable::query()
    ->setSelect(['PROPERTY_ID', 'VALUE', 'ID']);
$ptqex2result1 = $ptqex2->exec();
$ptqex2data  = [];
while ($ptqex2row = $ptqex2result1->fetch())
{
    if(!is_array($ptqex2data[$ptqex2row['PROPERTY_ID']]))
    {
        $ptqex2data[$ptqex2row['PROPERTY_ID']] = [];
    }
    array_push($ptqex2data[$ptqex2row['PROPERTY_ID']], $ptqex2row['VALUE']);
}

foreach ($container['PROPERTY']['list'] as $index => $property)
{
    $type = $property['SETTINGS']['PROPERTY_TYPE'];
    $container['PROPERTY']['list'][$index]['SETTINGS'] = array_merge(
        $property['SETTINGS'], $container['PROPERTY']['default'][$type]);
}

foreach ($container['PROPERTY']['list'] as $property)
{
    $ptu1  = PropertyTable::getByPrimary($ptqex1data[$property['CODE']])->fetchObject();
    $petaex1result = $ptu1->setPropertyType($property['SETTINGS']['PROPERTY_TYPE'])
                          ->setListType($property['SETTINGS']['LIST_TYPE'])
                          ->save();

    switch ($property['SETTINGS']['PROPERTY_TYPE'])
    {
        case 'L':
            $sort = 100;
            foreach($property['SETTINGS']['PROPERTY_ENUM'] as $propenum)
            {
                if(in_array($propenum['VALUE'], $ptqex2data[$ptqex1data[$property['CODE']]]))
                {
                    dump('Property enum ' . $propenum['VALUE'] . ' for property '
                                          . $property['CODE'] . ' already exist');
                    continue;
                }

                $xmlId = md5($property['CODE'] . $propenum['VALUE']);
                $petaex1result  = PropertyEnumerationTable::createObject()
                    ->setPropertyId($ptqex1data[$property['CODE']])
                    ->setSort($sort)
                    ->setDef($propenum['DEF'])
                    ->setValue($propenum['VALUE'])
                    ->setXmlId($xmlId)
                    ->save();

                $sort += 100;
            }
            break;
        case 'S' :
        case 'N' :

            break;
        default:

            break;
    }
}
