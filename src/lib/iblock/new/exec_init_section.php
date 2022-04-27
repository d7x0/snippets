<?php Bitrix\Main\Loader::includeModule("iblock");


use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\SectionTable;


$data = Customer\Data::DATA;

$container = $data['container'];   // list
$section   = $data['section'];     // list


$itqex1 = IblockTable::query()
    ->setFilter(['CODE' => $container['CODE']])
    ->setSelect(['ID']);
$itqex1result1 = $itqex1->exec()->fetch();
$iblockId = $itqex1result1['ID'];


$se = $section['element'];

foreach ($section['list'] as $s)
{
    $code = $container['CODE'] . '-' . $s['CODE'];
    $sta1 = SectionTable::createObject();
    $sta1result = $sta1->setTimestampX(new \Bitrix\Main\Type\DateTime())
        ->setIblockId($iblockId)
        ->setName($s['NAME'])
        ->setActive($se['ACTIVE'])
        ->setCode($code)
        ->save();
}


