<?php Bitrix\Main\Loader::includeModule("iblock");


use Bitrix\Iblock\TypeTable;
use Bitrix\Iblock\TypeLanguageTable;
use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\IblockSiteTable;
use Bitrix\Iblock\IblockFieldTable;
use Bitrix\Iblock\IblockMessageTable;
use Bitrix\Iblock\IblockGroupTable;


$data = Customer\Data::DATA;

$type      = $data['type'];        // list
$container = $data['container'];   // list


foreach ($type as $t)
{
    $ttqex1 = TypeTable::query()
        ->setFilter(['ID' => $t['ID']])
        ->setSelect(['ID']);
    $ttqex1result1 = $ttqex1->exec()->fetch();

    if($ttqex1result1['ID'] == $t['ID'])                               // check type iblock id
    {
        dump('Type with ID: "' . $ttqex1result1['ID'] . '" already exist');
        dump('Type not created');
    }
    else
    {
        // init type
        $tta1 = TypeTable::createObject();
        $tta1result  = $tta1->setId($t['ID'])
            ->save();
        // init type lang
        foreach ($t['LANG'] as $langId => $lang)
        {
            // init type lang in b_iblock_type_lang
            $tlta11 = TypeLanguageTable::createObject();
            $tlta1result1 =  $tlta11->setIblockTypeId($t['ID'])
                ->setLanguageId($langId)
                ->setName($lang['NAME'])
                ->setElementsName($lang['ELEMENT_NAME'])
                ->setSectionsName($lang['SECTION_NAME'])
                ->save();
        }
    }

    foreach ($container as $c)
    {
        $itqex1q = IblockTable::query()
            ->setFilter(['CODE' => $c['CODE']])
            ->setSelect(['CODE', 'ID'])
            ->exec();
        $itqex1res = $itqex1q->fetch();

        if($itqex1res['CODE'] == $c['CODE'])
        {
            dump('Container with ID: "' . $itqex1res['CODE'] . '" already exist');
            dump('Container not created');
            continue;
        }

        // init container in b_iblock
        $ita1 = IblockTable::createObject();
        $ita1result =  $ita1->setIblockTypeId($t['ID'])
            ->setCode($c['CODE'])
            ->setName($c['NAME'])
            ->setLid($c['SETTINGS']['SITE_ID'])
            ->setActive($c['SETTINGS']['ACTIVE'])
            ->setWorkflow($c['SETTINGS']['WORKFLOW'])
            ->setListMode($c['SETTINGS']['LIST_MODE'])
            ->setSectionProperty($c['SETTINGS']['SECTION_PROPERTY'])
            ->setPropertyIndex($c['SETTINGS']['PROPERTY_INDEX'])
            ->save();
        $iblockId = $ita1result->getId();                                   // get iblock id

        // link container to site in b_iblock_site
        $ista1 =  IblockSiteTable::createObject();
        $ista1result =  $ista1->setIblockId($iblockId)
            ->setSiteId($c['SETTINGS']['SITE_ID'])
            ->save();

        // init field in b_iblock_fields
        foreach ($c['FIELD'] as $field)
        {
            $pta1 = IblockFieldTable::createObject();
            $pta1   ->setIblockId($iblockId)
                ->setFieldId($field['FIELD_ID'])
                ->setIsRequired($field['IS_REQUIRED'])
                ->setDefaultValue($field['DEFAULT_VALUE'])
                ->save();
        }

        // init message in b_iblock_messages
        foreach ($c['MESSAGE'] as $message)
        {
            $imta1  = IblockMessageTable::createObject();
            $imta1  ->setIblockId($iblockId)
                ->setMessageId($message['MESSAGE_ID'])
                ->setMessageText($message['MESSAGE_TEXT'])
                ->save();
        }

        // init permission in b_iblock_group
        foreach ($c['SETTINGS']['GROUP'] as $group)
        {
            $igta1 = IblockGroupTable::createObject();
            $igta1result =  $igta1->setIblockId($iblockId)
                ->setGroupId($group['GROUP_ID'])
                ->setPermission($group['PERMISSION'])
                ->save();
        }
    }
}