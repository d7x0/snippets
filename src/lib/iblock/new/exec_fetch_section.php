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
    //    offset
    dump('        Code:                                     Id:     Parent Id:    Name:');

    $sectionListExist = [];
    $stqex1q = SectionTable::query()                             // get existing sections
        ->setFilter(['IBLOCK_ID' => $iblock['ID']])
        ->setSelect(['ID', 'IBLOCK_SECTION_ID', 'CODE', 'NAME'])->exec();


    $mask = "           %-34.24s        %-4.4s    %-7.4s       %-24.24s" . PHP_EOL;


    if($stqex1q->fetch() == false)
    {
        print "           Нет разделов" .PHP_EOL;
    }

    while ($stqex1row = $stqex1q->fetch())
    {
        printf($mask, $stqex1row['CODE'], $stqex1row['ID'], $stqex1row['IBLOCK_SECTION_ID'], $stqex1row['NAME']);
    };
}


