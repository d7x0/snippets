<?php Bitrix\Main\Loader::includeModule("iblock");


use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\SectionTable;


$data = Customer\Data::DATA;


$listIblock = [];
$itqex1 = IblockTable::query()
    ->setFilter(['CODE' => $data['CODE']])
    ->setSelect(['ID', 'CODE', 'NAME'])->exec();
while ($itqex1row = $itqex1->fetch())
{
    $listIblock[$itqex1row['ID']] = $itqex1row;
}

foreach ($listIblock as $iblock)
{
    dump('iblock: ' . $iblock['NAME']);
    dump('    id: ' . $iblock['ID']);
    dump('    section:');

    $sectionListExist = [];
    $stqex1q = SectionTable::query()                             // get existing sections
        ->setFilter(['IBLOCK_ID' => $iblock['ID']])
        ->setSelect(['ID', 'IBLOCK_SECTION_ID', 'CODE', 'NAME'])->exec();
    $stqex1res = $stqex1q->fetchAll();

    if(empty($stqex1res))
    {
        print "           Нет разделов" .PHP_EOL;
        continue;
    }

    $mask = "           %-41.39s %-4.4s %-16.8s %-32.32s" . PHP_EOL;
    dump('        Code:                                     Id:     Parent Id:    Name:');
    foreach ($stqex1res as $stqex1row)
    {
        printf($mask, $stqex1row['CODE'], $stqex1row['ID'], $stqex1row['IBLOCK_SECTION_ID'], $stqex1row['NAME']);
    }
}


