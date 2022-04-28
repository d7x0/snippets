<?php Bitrix\Main\Loader::includeModule("iblock");


use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\SectionTable;
use Bitrix\Iblock\SectionElementTable;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Iblock\ElementPropertyTable;
use Bitrix\Iblock\PropertyEnumerationTable;
use Unlock\Iblock\ElementUnlockedTable;


$data     = Customer\Variable::DATA;
$settings = Customer\Variable::SETTINGS;


//
// Update property
//

$itqex1 = IblockTable::query()
    ->setFilter(['CODE' => $settings['CODE']])
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


if($settings['MODE']['SET_PROPERTY_FOR_ALL_EXIST_ELEMENT'] == 'Y')
{
    $data['property']['list'] = [];
    $idListElement   = [];
    $etqex1 = ElementUnlockedTable::query()
        ->setFilter(['IBLOCK_ID' => $iblockId])
        ->setSelect(['ID']);
    $etqex1result1 = $etqex1->exec();
    while ($etqex1row = $etqex1result1->fetch())
    {
        array_push($data['property']['list'], [
            'ID'       => intval($etqex1row['ID']),
            'PROPERTY' => $data['property']['default']['PROPERTY']
        ]);
    }
}

foreach ($data['property']['list'] as $property)      // $el
{
    if(is_string($property['ID']))
    {
        dump('ID must ba a Integer type, check DATA constant');
        break;
    }

    // get enum id
    $eptglex1pres = [];
    $eptglex1prq = ElementPropertyTable::getList([
        'filter' => ['IBLOCK_ELEMENT_ID'  => $property['ID']],
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


    foreach ($property['PROPERTY'] as $propertycode => $propertyvalue)
    {
        $propertyid              = empty($eptglex1pres) ? null : $eptglex1pres[$ptqex1data[$propertycode]['ID']];
        $propertyvalueEnum = empty($petglex1res)  ? null : $petglex1res[$ptqex1data[$propertycode]['ID']][$propertyvalue];

        if($ptqex1data[$propertycode]['PROPERTY_TYPE'] == 'S')
        {
            if(is_null($propertyid))
            {
                $itu1 = ElementPropertyTable::createObject();
                $itu1result = $itu1 ->setIblockElementId($property['ID'])
                                    ->setIblockPropertyId($ptqex1data[$propertycode]['ID'])
                                    ->setValue($propertyvalue)
                                    ->setValueEnum(null)
                                    ->save();
            }
            else
            {
                $itu1 = ElementPropertyTable::getByPrimary($propertyid)->fetchObject();
                $itu1result = $itu1 ->setValue($propertyvalue)
                                    ->setValueEnum(null)
                                    ->save();
            }
        }

        if($ptqex1data[$propertycode]['PROPERTY_TYPE'] == 'L')
        {
            if(is_null($propertyid))
            {
                // get $propertyvalueEnum by value
                $petglex1   = PropertyEnumerationTable::query();
                $petglex1  ->setFilter(['VALUE' => $propertyvalue])
                            ->setSelect(['ID']);
                $petglex1res = $petglex1->exec()->fetch();
                $propertyvalueEnum = $petglex1res['ID'];

                $itu1 = ElementPropertyTable::createObject();
                $itu1result = $itu1 ->setIblockElementId($property['ID'])
                                    ->setIblockPropertyId($ptqex1data[$propertycode]['ID'])
                                    ->setValue($propertyvalueEnum)
                                    ->setValueEnum($propertyvalueEnum)
                                    ->save();
            }
            else
            {
                $itu1 = ElementPropertyTable::getByPrimary($propertyid)->fetchObject();
                $itu1result = $itu1 ->setValue($propertyvalueEnum)
                                    ->setValueEnum($propertyvalueEnum)
                                    ->save();
            }

        }
    }
}


//
// Update section element
//

$codeListSection = [];
foreach ($data['section']['element'] as $section)
{
    array_push($codeListSection, $section['SECTION_CODE']);
}

$idListSection = [];
$stqex1 = SectionTable::query()
    ->setFilter(['CODE' => $codeListSection])
    ->setSelect(['ID', 'CODE'])
    ->exec();
while ($stqex1row = $stqex1->fetch())
{
    $idListSection[$stqex1row['CODE']] = $stqex1row['ID'];
}

$idListElementSection = [];
$setqex1 = SectionElementTable::query()
    ->setSelect(['IBLOCK_ELEMENT_ID', 'IBLOCK_SECTION_ID'])->exec();
while ($setqex1row = $setqex1->fetch())
{
    $idListElementSection[$setqex1row['IBLOCK_ELEMENT_ID']] = $setqex1row['IBLOCK_SECTION_ID'];
}

foreach ($data['section']['element'] as $section)
{
    $idListElement = explode(" ", $section['ELEMENTS_ID']);

    foreach ($idListElement as $idElement)
    {
        $idElement = intval(trim($idElement));
        if($idElement == 0) { continue; }

        $itu1 = ElementUnlockedTable::getByPrimary($idElement)->fetchObject();
        $itu1result = $itu1 ->setIblockSectionId($idListSection[$section['SECTION_CODE']])
                            ->setInSections('Y')
                            ->save();

        if(in_array($idElement, array_keys($idListElementSection)))
        {
            $setd1 = SectionElementTable::getByPrimary([
                'IBLOCK_SECTION_ID' => $idListElementSection[$idElement],
                'IBLOCK_ELEMENT_ID' => $idElement,
            ])->fetchObject();
            $setd1result = $setd1->delete();
        }

        $seta1 = SectionElementTable::createObject();
        $seta1result =$seta1->setIblockSectionId($idListSection[$section['SECTION_CODE']])
            ->setIblockElementId($idElement)
            ->save();
    }
}


//
// Update section section
//

$idListSection = [];
$stqex1 = SectionTable::query()
    ->setFilter(['IBLOCK_ID' => $iblockId])
    ->setSelect(['ID', 'CODE'])
    ->exec();
while ($stqex1row = $stqex1->fetch())
{
    $idListSection[$stqex1row['CODE']] = $stqex1row['ID'];
}

$connection = \Bitrix\Main\Application::getConnection();

foreach ($data['section']['section'] as $codeSectionParent => $codeListSectionChild)
{
    foreach ($codeListSectionChild as $codeSectionChild)
    {
        $idSectionChild  = intval($idListSection[$codeSectionChild]);
        $idSectionParent = intval($idListSection[$codeSectionParent]);

        $queryResponse = $connection->query("
            UPDATE b_iblock_section
            SET IBLOCK_SECTION_ID = $idSectionParent, DEPTH_LEVEL = 2
            WHERE ID = $idSectionChild
        ");
    }
}