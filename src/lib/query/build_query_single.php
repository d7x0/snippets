<?php


$iblockCode = $data['type']['CODE'];
$property = $data['element']['element']['PROPERTY'];


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


$queryHeader = include __DIR__ . '/_query_header.php';
$queryFooter = include __DIR__ . '/_query_footer.php';

return "
    $queryHeader
    WHERE $stringPropertyFilterValueWhere
    $queryFooter
";