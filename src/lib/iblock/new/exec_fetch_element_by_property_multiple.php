<?php Bitrix\Main\Loader::includeModule("iblock");


use Bitrix\Main\Application;


$data = Customer\Data::DATA;


$mapPropertyCodeValueType = [
    'ORDER_COST_MINIMUM'        => 'VALUE_NUM',
    'ORDER_MUNUFACTURE_TIME'    => 'VALUE',
    'PAYMENT_TYPE'              => 'VALUE',
    'PAYMENT_BANK'              => 'VALUE',

    'SHIPMENT_ON_DAY_PAY'       => 'VALUE',
    'PAYMENT_DEFERMENT'         => 'VALUE',
    'DELIVERY_TYPE_AVAILABLE'   => 'VALUE',
    'DELIVERY_WEIGHT_LIMIT'     => 'VALUE_NUM',
];

$iblockCode = $data['type']['CODE'];
$property = $data['element']['element']['PROPERTY'];


$propertyFilterName       = $property['single']['PROPERTY_NAME'];
$arrayPropertyFilterValue = $property['single']['PROPERTY_VALUE'];

    $stringPropertyFilterValue     = "";
    $stringPropertyFilterValueLike = "";
foreach ($arrayPropertyFilterValue as $arrayPropertyFilterValueItem)
{
    $stringPropertyFilterValue .= "'" . $arrayPropertyFilterValueItem . "', ";

    $like = "
        RUNTIME_LIST_ELEMENT_ID.IEP_VALUE LIKE CONCAT('%', (
            SELECT ID
            FROM b_iblock_property_enum
            WHERE VALUE LIKE '$arrayPropertyFilterValueItem'
        ), '%')
    ";

    $stringPropertyFilterValueLike .= $like . " AND "; }

    $stringPropertyFilterValue = substr($stringPropertyFilterValue, 0 ,-2);
    $stringPropertyFilterValueLike = trim(substr($stringPropertyFilterValueLike, 0 ,-4));


$connection = Application::getConnection();
$queryResponse = $connection->query(" 
            SELECT I.ID AS I_ID, I.NAME AS I_NAME,
                   IE.ID AS IE_ID, IE.NAME AS IE_NAME,
                   VALUE_NUM, VALUE,
                   IP.NAME AS IP_NAME, IP.ID AS IP_ID, IP.CODE AS IP_CODE
            FROM b_iblock_element_property
                     LEFT JOIN b_iblock_element IE ON IBLOCK_ELEMENT_ID = IE.ID
                     LEFT JOIN b_iblock_property IP ON IBLOCK_PROPERTY_ID = IP.ID
                     LEFT JOIN b_iblock I ON IE.IBLOCK_ID = I.ID
            WHERE IBLOCK_ELEMENT_ID IN (
                SELECT RUNTIME_LIST_ELEMENT_ID.IEP_ELEMENT_ID
                FROM
                    ( SELECT IEP.IBLOCK_ELEMENT_ID AS IEP_ELEMENT_ID, GROUP_CONCAT(IEP.VALUE SEPARATOR ', ') AS IEP_VALUE
                     FROM b_iblock_property_enum IPEN
                              LEFT JOIN b_iblock_property IP ON IPEN.PROPERTY_ID = IP.ID
                              LEFT JOIN b_iblock_element_property IEP ON IP.ID = IEP.IBLOCK_PROPERTY_ID
                     WHERE IP.IBLOCK_ID = (
                            SELECT ID
                            FROM b_iblock
                            WHERE CODE LIKE 'supplier-steel'
                        )
                       AND IPEN.VALUE IN ($stringPropertyFilterValue)
                     GROUP BY IEP.IBLOCK_ELEMENT_ID ) AS RUNTIME_LIST_ELEMENT_ID
                WHERE $stringPropertyFilterValueLike
            )
              AND IE.IBLOCK_ID = (
                SELECT ID
                FROM b_iblock
                WHERE CODE LIKE 'supplier-steel'
            )
        ")->fetchAll(); // возвращает элементы со всеми свойствами у которых множественное свойство
                        // $propertyFilterName = [$propertyFilterValue0, ..]

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

    if(!is_array($etqex11data[$row['IE_ID']]['PROPERTY'][$row['IP_ID']]))
    {
        $etqex11data[$row['IE_ID']]['PROPERTY'][$row['IP_CODE']] = [];
    }

    $etqex11data[$row['IE_ID']]['IBLOCK_ID']   = $row['I_ID'];
    $etqex11data[$row['IE_ID']]['IBLOCK_NAME'] = $row['I_NAME'];
    $etqex11data[$row['IE_ID']]['NAME'] = $row['IE_NAME'];

    $etqex11data[$row['IE_ID']]['PROPERTY'][$row['IP_CODE']]['NAME'] = $row['IP_NAME'];

    $valueType = $mapPropertyCodeValueType[$row['IP_CODE']];
    $etqex11data[$row['IE_ID']]['PROPERTY'][$row['IP_CODE']]['VALUE'] = $row[$valueType];
}

dump($etqex11data);