<?php


$iblockCode = $data['type']['CODE'];
$codeListSection = $data['element']['section']['CODE'];
$property   = $data['element']['element']['PROPERTY'];


// build query for L
$stringPropertyFilterValue     = "";
$stringPropertyFilterValueLike = "";
foreach ($property['L'] as $arrayPropertyFilterValueItem)
{
    foreach ($arrayPropertyFilterValueItem['PROPERTY_VALUE'] as $propertyEnumItem)
    {
        $propertyName = $arrayPropertyFilterValueItem['PROPERTY_NAME'];
        $stringPropertyFilterValue .= "'" . $propertyEnumItem . "', ";

        $like = "
            RUNTIME_LIST_ELEMENT_ID.IEP_VALUE LIKE CONCAT('%', (
                SELECT ID
                FROM b_iblock_property_enum
                WHERE VALUE LIKE '$propertyEnumItem' AND PROPERTY_ID = (
                    SELECT ID
                    FROM b_iblock_property
                    WHERE CODE LIKE '$propertyName'
                )
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


// build query for section
$stringCodeListSection = "";
foreach ($codeListSection as $codeSection)
{
    $stringCodeListSection .= "'" . $codeSection . "', ";
}
$stringCodeListSection = substr($stringCodeListSection, 0, -2);
$stringSectionFilterValueLike = "
        AND IE.IBLOCK_SECTION_ID IN (
            SELECT ID
            FROM b_iblock_section
            WHERE CODE IN ($stringCodeListSection)
        )
    ";


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

if(empty($stringCodeListSection))
{
    $stringSectionFilterValueLike = "";
}

if(empty($queryPartEnum) && empty($stringPropertyFilterValueWhere))
{
    dump('Not found properties in filter');
    die;
}


$queryHeader = include __DIR__ . '/_query_header.php';
$queryFooter = include __DIR__ . '/_query_footer.php';


return "
    $queryHeader
        $queryPartEnum
        $stringPropertyFilterValueWhere
    $queryFooter
";