<?php Bitrix\Main\Loader::includeModule("iblock");
  use Bitrix\Main\Application;

$data = Customer\Data::DATA;
$mapPropertyCodeValueType = Customer\Data::MAP_PROPERTY_CODE_VALUE_TYPE;


$query = include __DIR__ . "/../../query/". $options['queryBuilder'] .".php";

$connection = Application::getConnection();
$queryResponse = $connection->query($query)->fetchAll();


$etqex11data = [];
foreach ($queryResponse as $row)
{
    $valueType = $mapPropertyCodeValueType[$row['IP_CODE']];

    if(!is_array($etqex11data[$row['IE_ID']]))
    {
        $etqex11data[$row['IE_ID']] = [];
    }

    if(!is_array($etqex11data[$row['IE_ID']]['PROPERTY']))
    {
        $etqex11data[$row['IE_ID']]['PROPERTY'] = [];
    }

    if(!is_array($etqex11data[$row['IE_ID']]['PROPERTY'][$row['IP_CODE']]))
    {
        $etqex11data[$row['IE_ID']]['PROPERTY'][$row['IP_CODE']] = [];
    }

    if($row['IP_MULTIPLE'] == 'Y')
    {
        if(!is_array($etqex11data[$row['IE_ID']]['PROPERTY'][$row['IP_CODE']]['VALUE']))
        {
            $etqex11data[$row['IE_ID']]['PROPERTY'][$row['IP_CODE']]['VALUE'] = []; }
        array_push($etqex11data[$row['IE_ID']]['PROPERTY'][$row['IP_CODE']]['VALUE'], $row[$valueType]);
    }
    else
    {
        $etqex11data[$row['IE_ID']]['PROPERTY'][$row['IP_CODE']]['VALUE'] = $row[$valueType];
    }


    $etqex11data[$row['IE_ID']]['IBLOCK_ID']   = $row['I_ID'];
    $etqex11data[$row['IE_ID']]['IBLOCK_NAME'] = $row['I_NAME'];
    $etqex11data[$row['IE_ID']]['NAME']        = $row['IE_NAME'];
    $etqex11data[$row['IE_ID']]['IBLOCK_SECTION_ID'] = $row['IE_IBLOCK_SECTION_ID'];

    $etqex11data[$row['IE_ID']]['PROPERTY'][$row['IP_CODE']]['NAME'] = $row['IP_NAME'];
}


$etqex11short = [];
foreach ($etqex11data as $etqex11id => $etqex11item)
{
    $etqex11short[$etqex11id] = [
        'NAME' => $etqex11item['NAME'],
        'IBLOCK_SECTION_ID' => $etqex11item['IBLOCK_SECTION_ID'],
    ];
}

dump($etqex11data);