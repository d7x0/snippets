<?php Bitrix\Main\Loader::includeModule("iblock");


use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Iblock\ElementPropertyTable;
use Bitrix\Iblock\PropertyEnumerationTable;
use Unlock\Iblock\ElementUnlockedTable;


$data = Customer\Data::DATA;

$container = $data['container'];
$element   = $data['element'];       // list


$itqex1 = IblockTable::query()
    ->setFilter(['CODE' => $container['CODE']])
    ->setSelect(['ID']);
$itqex1result1 = $itqex1->exec()->fetch();
$iblockId = $itqex1result1['ID'];                               // get iblock id


$ptqex1data  = [];
$ptqex1 = PropertyTable::query()
    ->setFilter(['IBLOCK_ID' => $iblockId])
    ->setSelect(['CODE', 'ID', 'PROPERTY_TYPE']);
$ptqex1result1 = $ptqex1->exec();
while ($ptqex1row = $ptqex1result1->fetch())
{
    $ptqex1data[$ptqex1row['CODE']] = $ptqex1row;               // get iblock property
}

$eldefault
       = $element['default'];
foreach ($element['list'] as $el)
{
    if(is_string($el['ID']))
    {
        dump('ID must ba a Integer type, check DATA constant');
        break;
    }

    // get enum id
    $eptglex1pres = [];
    $eptglex1prq = ElementPropertyTable::getList([
        'filter' => ['IBLOCK_ELEMENT_ID'  => $el['ID']],
        'select' => ['IBLOCK_PROPERTY_ID', 'ID']
    ]);
    while($eptglex1prrow = $eptglex1prq->fetch())
    {
        $eptglex1pres[$eptglex1prrow['IBLOCK_PROPERTY_ID']] = $eptglex1prrow['ID'];
    }

    // get enum value
    $petglex1res = [];
    $petglex1   = PropertyEnumerationTable::query();
    $petglex1   ->setFilter(['PROPERTY_ID' => array_keys($eptglex1pres)])
                ->setSelect(['ID', 'PROPERTY_ID', 'VALUE']);
    $petglex1q  = $petglex1->exec();
    while($petglex1row = $petglex1q->fetch())
    {
        $petglex1res[$petglex1row['PROPERTY_ID']][$petglex1row['VALUE']] = $petglex1row['ID'];
    }

    foreach ($el['PROPERTY'] as $elpropertycode => $elpropertyvalue)
    {
        $elPrId              = empty($eptglex1pres) ? null : $eptglex1pres[$ptqex1data[$elpropertycode]['ID']];
        $elpropertyvalueEnum = empty($petglex1res)  ? null : $petglex1res[$ptqex1data[$elpropertycode]['ID']][$elpropertyvalue];


        if($ptqex1data[$elpropertycode]['PROPERTY_TYPE'] == 'S')
        {
            if(is_null($elPrId))
            {
                $itu1 = ElementPropertyTable::createObject();
                $itu1result = $itu1 ->setIblockElementId($el['ID'])
                                    ->setIblockPropertyId($ptqex1data[$elpropertycode]['ID'])
                                    ->setValue($elpropertyvalue)
                                    ->setValueEnum(null)
                                    ->save();
            }
            else
            {
                $itu1 = ElementPropertyTable::getByPrimary($elPrId)->fetchObject();
                $itu1result = $itu1 ->setValue($elpropertyvalue)
                                    ->setValueEnum(null)
                                    ->save();
            }
        }

        if($ptqex1data[$elpropertycode]['PROPERTY_TYPE'] == 'L')
        {
            if(is_null($elPrId))
            {
                // get $elpropertyvalueEnum by value
                $petglex1   = PropertyEnumerationTable::query();
                $petglex1  ->setFilter(['VALUE' => $elpropertyvalue])
                            ->setSelect(['ID']);
                $petglex1res = $petglex1->exec()->fetch();
                $elpropertyvalueEnum = $petglex1res['ID'];

                $itu1 = ElementPropertyTable::createObject();
                $itu1result = $itu1 ->setIblockElementId($el['ID'])
                                    ->setIblockPropertyId($ptqex1data[$elpropertycode]['ID'])
                                    ->setValue($elpropertyvalueEnum)
                                    ->setValueEnum($elpropertyvalueEnum)
                                    ->save();
            }
            else
            {
                $itu1 = ElementPropertyTable::getByPrimary($elPrId)->fetchObject();
                $itu1result = $itu1 ->setValue($elpropertyvalueEnum)
                                    ->setValueEnum($elpropertyvalueEnum)
                                    ->save();
            }

        }
    }
}
