<?php $data = Customer\Data::DATA;


$iblockCode = $data['type']['CODE'];
$property   = $data['element']['element']['PROPERTY'];


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
        IE.ID IN (
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


$queryPartEnum = "
    WHERE IE.ID IN (
        SELECT RUNTIME_LIST_ELEMENT_ID.IEP_ELEMENT_ID
        FROM
            ( SELECT IEP.IBLOCK_ELEMENT_ID AS IEP_ELEMENT_ID, GROUP_CONCAT(IEP.VALUE SEPARATOR ', ') AS IEP_VALUE
             FROM b_iblock_property_enum IPEN
                      LEFT JOIN b_iblock_property IP ON IPEN.PROPERTY_ID = IP.ID
                      LEFT JOIN b_iblock_element_property IEP ON IP.ID = IEP.IBLOCK_PROPERTY_ID
             WHERE IP.IBLOCK_ID = (
                    SELECT ID
                    FROM b_iblock
                    WHERE CODE LIKE '$iblockCode'
                )
               AND IPEN.VALUE IN ($stringPropertyFilterValue)
             GROUP BY IEP.IBLOCK_ELEMENT_ID ) AS RUNTIME_LIST_ELEMENT_ID
        WHERE $stringPropertyFilterValueLike
    )
";


if(empty($stringPropertyFilterValue))
{
    $queryPartEnum       = "";
    $whereStatementBegin = "WHERE";
}
else
{
    $whereStatementBegin = "AND";
}

$stringPropertyFilterValueWhere = empty($stringPropertyFilterValueWhere) ? ""
    : "$whereStatementBegin $stringPropertyFilterValueWhere";

if(empty($queryPartEnum) && empty($stringPropertyFilterValueWhere))
{
    dump('Not found properties in filter');
    die;
}


$query = "
    SELECT I.ID AS I_ID, I.NAME AS I_NAME,
           IE.ID AS IE_ID, IE.NAME AS IE_NAME,
           IEP.VALUE_NUM AS IEP_VALUE_NUM, IEP.VALUE AS IEP_VALUE, IEP.VALUE_ENUM AS IEP_VALUE_ENUM,
           IP.NAME AS IP_NAME, IP.ID AS IP_ID, IP.CODE AS IP_CODE, IP.MULTIPLE AS IP_MULTIPLE,
           IPEN.VALUE AS IPEN_VALUE
    FROM b_iblock_element IE
             LEFT JOIN b_iblock_element_property IEP ON IEP.IBLOCK_ELEMENT_ID = IE.ID
             LEFT JOIN b_iblock_property IP ON IEP.IBLOCK_PROPERTY_ID = IP.ID
             LEFT JOIN b_iblock I ON IE.IBLOCK_ID = I.ID
             LEFT JOIN b_iblock_property_enum IPEN ON IEP.VALUE_ENUM = IPEN.ID
      $queryPartEnum
      $stringPropertyFilterValueWhere
      AND IE.IBLOCK_ID = (
        SELECT ID
        FROM b_iblock
        WHERE CODE LIKE '$iblockCode'
    )
    ORDER BY IE.ID
";