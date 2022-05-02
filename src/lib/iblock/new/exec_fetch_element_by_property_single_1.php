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

$propertyFilterName  = $property['single']['PROPERTY_NAME'];
$propertyFilterValue = $property['single']['PROPERTY_VALUE'];


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
                SELECT IBLOCK_ELEMENT_ID
                FROM b_iblock_element_property
                WHERE IBLOCK_PROPERTY_ID IN (
                    SELECT ID AS IBLOCK_PROPERTY_ID
                    FROM b_iblock_property
                    WHERE CODE LIKE '$propertyFilterName'
                )
                AND VALUE IN (
                    SELECT ID AS ID
                    FROM b_iblock_property_enum
                    WHERE VALUE LIKE'$propertyFilterValue'
                )
            )
            AND IE.IBLOCK_ID IN (
                SELECT ID AS IBLOCK_ID
                FROM b_iblock
                WHERE CODE LIKE '$iblockCode'
            )
        ")->fetchAll(); // возвращает элементы со всеми свойствами у которых свойство
                        // $propertyFilterName = $propertyFilterValue

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

dump($etqex11data);  /*

     ^ array:2 [
          319 => array:4 [
            "PROPERTY" => array:8 [
              "ORDER_COST_MINIMUM" => array:2 [
                "NAME" => "Минимальная сумма заказа"
                "VALUE" => "100.0000"
              ]
              "ORDER_MUNUFACTURE_TIME" => array:2 [
                "NAME" => "Время изготовления заказа"
                "VALUE" => "144 часа"
              ]
              "PAYMENT_TYPE" => array:2 [
                "NAME" => "Форма оплаты"
                "VALUE" => "57"
              ]
              "PAYMENT_BANK" => array:2 [
                "NAME" => "Банк оплаты"
                "VALUE" => "ПАО Банк «ФК Oткpытиe»"
              ]
              "SHIPMENT_ON_DAY_PAY" => array:2 [
                "NAME" => "Отгрузка в день оплаты"
                "VALUE" => "42"
              ]
              "PAYMENT_DEFERMENT" => array:2 [
                "NAME" => "Отсрочка платежа"
                "VALUE" => "43"
              ]
              "DELIVERY_TYPE_AVAILABLE" => array:2 [
                "NAME" => "Вид транспорта для доставки"
                "VALUE" => "44"
              ]
              "DELIVERY_WEIGHT_LIMIT" => array:2 [
                "NAME" => "Максимальный вес доставки"
                "VALUE" => "200.0000"
              ]
            ]
            "IBLOCK_ID" => "7"
            "IBLOCK_NAME" => "Металл"
            "NAME" => "Уральская литейная компания"
          ]
          322 => array:4 [
            "PROPERTY" => array:7 [
              "ORDER_COST_MINIMUM" => array:2 [
                "NAME" => "Минимальная сумма заказа"
                "VALUE" => "50.0000"
              ]
              "ORDER_MUNUFACTURE_TIME" => array:2 [
                "NAME" => "Время изготовления заказа"
                "VALUE" => "72 часа"
              ]
              "PAYMENT_TYPE" => array:2 [
                "NAME" => "Форма оплаты"
                "VALUE" => "56"
              ]
              "PAYMENT_BANK" => array:2 [
                "NAME" => "Банк оплаты"
                "VALUE" => "ПАО Банк «ФК Oткpытиe»"
              ]
              "SHIPMENT_ON_DAY_PAY" => array:2 [
                "NAME" => "Отгрузка в день оплаты"
                "VALUE" => "42"
              ]
              "DELIVERY_TYPE_AVAILABLE" => array:2 [
                "NAME" => "Вид транспорта для доставки"
                "VALUE" => "46"
              ]
              "DELIVERY_WEIGHT_LIMIT" => array:2 [
                "NAME" => "Максимальный вес доставки"
                "VALUE" => "500.0000"
              ]
            ]
            "IBLOCK_ID" => "7"
            "IBLOCK_NAME" => "Металл"
            "NAME" => "ООО "ЛАЗЕРВЕРК""
          ]
        ]
*/

