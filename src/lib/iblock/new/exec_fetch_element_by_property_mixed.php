<?php Bitrix\Main\Loader::includeModule("iblock");


use Bitrix\Main\Application;


$data = Customer\Data::DATA;


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

$iblockCode = $data['type']['CODE'];
$property = $data['element']['element']['PROPERTY'];


// build query for L
    $stringPropertyFilterValue     = "";
    $stringPropertyFilterValueLike = "";
foreach ($property['L'] as $arrayPropertyFilterValueItem)
{
    foreach ($arrayPropertyFilterValueItem['PROPERTY_VALUE'] as $propertyEnumItem)
    {
        $stringPropertyFilterValue .= "'" . $propertyEnumItem . "', ";

        $like = "
            RUNTIME_LIST_ELEMENT_ID.IEP_VALUE LIKE CONCAT('%', (
                SELECT ID
                FROM b_iblock_property_enum
                WHERE VALUE LIKE '$propertyEnumItem'
            ), '%')
        ";

        $stringPropertyFilterValueLike .= $like . " AND "; }}

    $stringPropertyFilterValue = substr($stringPropertyFilterValue, 0 ,-2);
    $stringPropertyFilterValueLike = trim(substr($stringPropertyFilterValueLike, 0 ,-4));


// build query for S
    $stringPropertyFilterValueWhere = "";
foreach ($property['S'] as $propertyString)
{
    $propertyFilterName  = $propertyString['PROPERTY_NAME'];
    $propertyFilterValue = $propertyString['PROPERTY_VALUE'];

    $where = "
        IBLOCK_ELEMENT_ID IN (
            SELECT IBLOCK_ELEMENT_ID
            FROM b_iblock_element_property
            WHERE IBLOCK_PROPERTY_ID = (
                SELECT ID
                FROM b_iblock_property
                WHERE CODE LIKE '$propertyFilterName'
            )
              AND VALUE LIKE '$propertyFilterValue'
        )
    ";

    $stringPropertyFilterValueWhere .= $where . " AND "; }
    $stringPropertyFilterValueWhere = trim(substr($stringPropertyFilterValueWhere, 0 ,-4));



$query = "
    SELECT I.ID AS I_ID, I.NAME AS I_NAME,
           IE.ID AS IE_ID, IE.NAME AS IE_NAME,
           IEP.VALUE_NUM AS IEP_VALUE_NUM, IEP.VALUE AS IEP_VALUE,
           IP.NAME AS IP_NAME, IP.ID AS IP_ID, IP.CODE AS IP_CODE,
           IPEN.VALUE AS IPEN_VALUE
    FROM b_iblock_element_property IEP
             LEFT JOIN b_iblock_element IE ON IEP.IBLOCK_ELEMENT_ID = IE.ID
             LEFT JOIN b_iblock_property IP ON IEP.IBLOCK_PROPERTY_ID = IP.ID
             LEFT JOIN b_iblock I ON IE.IBLOCK_ID = I.ID
             LEFT JOIN b_iblock_property_enum IPEN ON IP.ID = IPEN.PROPERTY_ID
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
      AND $stringPropertyFilterValueWhere
      AND IE.IBLOCK_ID = (
        SELECT ID
        FROM b_iblock
        WHERE CODE LIKE 'supplier-steel'
    )
    ORDER BY IE.ID
";


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
