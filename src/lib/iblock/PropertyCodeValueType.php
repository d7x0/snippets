<?php


namespace Utility\Iblock\Generator;


use Bitrix\Main\Loader;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Iblock\IblockTable;
use Utility\Writer;


class PropertyCodeValueType
{
    private const MAP = [
        'N' => 'IEP_VALUE_NUM',
        'L' => 'IPEN_VALUE',
        'S' => 'IEP_VALUE',
        'F' => 'IEP_VALUE',
        'E' => 'IEP_VALUE',
        'G' => 'IEP_VALUE',
    ];

    /**
     * @param array $parameters [
     *      @param string PATH_TO_FILE
     *      @param string IBLOCK_CODE
     * ]
     * */
    public static function writeToFile($parameters)
    {
        Loader::includeModule("iblock");

        $map =self::MAP;

        $itqex1q = IblockTable::query()
            ->setFilter(['CODE' => $parameters['IBLOCK_CODE']])
            ->setSelect(['ID']);
        $itqex1res = $itqex1q->exec()->fetch();


        $ptqex1q = PropertyTable::query()
            ->setFilter(['IBLOCK_ID' => $itqex1res['ID']])
            ->setSelect(['CODE', 'NAME', 'PROPERTY_TYPE']);
        $ptqex1res = $ptqex1q->exec();


            $text  = "";
            $text .= '<' . '?php' . PHP_EOL . PHP_EOL;
            $text .= 'const MAP_PROPERTY_CODE_VALUE_TYPE = [' . PHP_EOL;

        while ($ptqex1row = $ptqex1res->fetch())
        {
            $text  .= "    '" . $ptqex1row['CODE'] . "' => " . "'" . $map[$ptqex1row['PROPERTY_TYPE']] . "'," . PHP_EOL;
        }
            $text .= '];' . PHP_EOL;

        $writer = new Writer();
        $writer->writeFileText($parameters['PATH_TO_FILE'], $text, 'php');

        dump("Create file: " . $parameters['PATH_TO_FILE']);
    }
}