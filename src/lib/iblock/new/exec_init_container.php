<?php Bitrix\Main\Loader::includeModule("iblock");


use Bitrix\Iblock\TypeTable;
use Bitrix\Iblock\TypeLanguageTable;
use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\IblockSiteTable;
use Bitrix\Iblock\IblockFieldTable;
use Bitrix\Iblock\IblockMessageTable;
use Bitrix\Iblock\IblockGroupTable;


$d = $data;
$dt = $data['type'];        // list
$dc = $data['container'];   // list


foreach ($dt as $dtdata)
{
    $ttqex1 = TypeTable::query()
        ->setFilter(['ID' => $dtdata['ID']])
        ->setSelect(['ID']);
    $ttqex1result1 = $ttqex1->exec()->fetch();

    if($ttqex1result1['ID'] == $dtdata['ID'])                               // check type iblock id
    {
        dump('break for: ' . $ttqex1result1['ID']);
        break;
    }

    // init type in b_iblock_type
    $tta1 = TypeTable::createObject();
    $tta1result  = $tta1->setId($dtdata['ID'])
                        ->save();

    foreach ($dtdata['LANG'] as $dtlangid => $dtlang)
    {
            // init type lang in b_iblock_type_lang
            $tlta11 = TypeLanguageTable::createObject();
            $tlta1result1 =  $tlta11->setIblockTypeId($dtdata['ID'])
                ->setLanguageId($dtlangid)
                ->setName($dtlang['NAME'])
                ->setElementsName($dtlang['ELEMENT_NAME'])
                ->setSectionsName($dtlang['SECTION_NAME'])
                ->save();
    }

    foreach ($dc as $dcdata)
    {
        // init container in b_iblock
        $ita1 = IblockTable::createObject();
        $ita1result =  $ita1->setIblockTypeId($dtdata['ID'])
            ->setCode($dcdata['CODE'])
            ->setName($dcdata['NAME'])
            ->setLid($dcdata['SETTINGS']['SITE_ID'])
            ->setActive($dcdata['SETTINGS']['ACTIVE'])
            ->setWorkflow($dcdata['SETTINGS']['WORKFLOW'])
            ->setListMode($dcdata['SETTINGS']['LIST_MODE'])
            ->setSectionProperty($dcdata['SETTINGS']['SECTION_PROPERTY'])
            ->setPropertyIndex($dcdata['SETTINGS']['PROPERTY_INDEX'])
            ->save();
        $iblockId = $ita1result->getId();                                   // get iblock id

        // link container to site in b_iblock_site
        $ista1 =  IblockSiteTable::createObject();
        $ista1result =  $ista1->setIblockId($iblockId)
            ->setSiteId($dcdata['SETTINGS']['SITE_ID'])
            ->save();

        // init field in b_iblock_fields
        foreach ($dcdata['FIELD'] as $dcfield)
        {
            $pta1 = IblockFieldTable::createObject();
            $pta1   ->setIblockId($iblockId)
                ->setFieldId($dcfield['FIELD_ID'])
                ->setIsRequired($dcfield['IS_REQUIRED'])
                ->setDefaultValue($dcfield['DEFAULT_VALUE'])
                ->save();
        }

        // init message in b_iblock_messages
        foreach ($dcdata['MESSAGE'] as $dcmessage)
        {
            $imta1  = IblockMessageTable::createObject();
            $imta1  ->setIblockId($iblockId)
                ->setMessageId($dcmessage['MESSAGE_ID'])
                ->setMessageText($dcmessage['MESSAGE_TEXT'])
                ->save();
        }

        // init permission in b_iblock_group
        foreach ($dcdata['SETTINGS']['GROUP'] as $dcgroup)
        {
            $igta1 = IblockGroupTable::createObject();
            $igta1result =  $igta1->setIblockId($iblockId)
                ->setGroupId($dcgroup['GROUP_ID'])
                ->setPermission($dcgroup['PERMISSION'])
                ->save();
        }
    }
}




