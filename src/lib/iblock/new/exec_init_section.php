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
$iblockId = $itqex1result1['ID'];                           // get iblock id


$sectionListExist = [];
$stqex1q = SectionTable::query()                             // get existing sections
    ->setFilter(['IBLOCK_ID' => $iblockId])
    ->setSelect(['CODE'])->exec();
while ($stqex1row = $stqex1q->fetch())
{
    array_push($sectionListExist, $stqex1row['CODE']);
};


   $se = $section['element'];
foreach ($section['list'] as $s)
{
    if(in_array($container['CODE'] . "-" . $s['CODE'], $sectionListExist))
    {
        dump('Section with ID: "' . $s['CODE'] . '" already exist');
        dump('Section not created');
        continue;
    }

    $code = $container['CODE'] . '-' . $s['CODE'];
    $sta1 = SectionTable::createObject();
    $sta1result = $sta1->setTimestampX(new \Bitrix\Main\Type\DateTime())
        ->setIblockId($iblockId)
        ->setName($s['NAME'])
        ->setActive($se['ACTIVE'])
        ->setCode($code)
        ->save();
}


