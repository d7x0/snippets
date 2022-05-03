<?php Bitrix\Main\Loader::includeModule("iblock");
  use Bitrix\Main\Application;


$mapPropertyCodeValueType = [
    'ORDER_COST_MINIMUM'        => 'IEP_VALUE_NUM',     // N
    'ORDER_MUNUFACTURE_TIME'    => 'IEP_VALUE',         // S
    'PAYMENT_TYPE'              => 'IPEN_VALUE',        // L
    'PAYMENT_BANK'              => 'IEP_VALUE',         // S

    'SHIPMENT_ON_DAY_PAY'       => 'IPEN_VALUE',        // L
    'PAYMENT_DEFERMENT'         => 'IPEN_VALUE',        // L
    'DELIVERY_TYPE_AVAILABLE'   => 'IPEN_VALUE',        // L MULTIPLE
    'DELIVERY_WEIGHT_LIMIT'     => 'IEP_VALUE_NUM',     // N
];


require_once __DIR__ . "/../../query/". $options['queryBuilder'] .".php";

$connection = Application::getConnection();
$queryResponse = $connection->query($query)->fetchAll(); // возвращает элементы со всеми свойствами у которых
                                                         // выбрано несколько значений множественнго свойства типа L

$etqex11data = [];
foreach ($queryResponse as $row)
{
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

    $etqex11data[$row['IE_ID']]['IBLOCK_ID']   = $row['I_ID'];
    $etqex11data[$row['IE_ID']]['IBLOCK_NAME'] = $row['I_NAME'];
    $etqex11data[$row['IE_ID']]['NAME']        = $row['IE_NAME'];

    $etqex11data[$row['IE_ID']]['PROPERTY'][$row['IP_CODE']]['NAME'] = $row['IP_NAME'];

    $valueType = $mapPropertyCodeValueType[$row['IP_CODE']];
    $etqex11data[$row['IE_ID']]['PROPERTY'][$row['IP_CODE']]['VALUE'] = $row[$valueType];
}

dump($etqex11data);
