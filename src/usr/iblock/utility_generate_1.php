<?php


use Utility\Iblock\Generator\PropertyCodeValueType;


/*
    php exec.php \
        --pathToData "usr/iblock/utility_generate_1.php"
*/
PropertyCodeValueType::writeToFile([
    'PATH_TO_FILE' => __DIR__ . '/_generated_map_property_code_value_type.php',
    'IBLOCK_CODE'  => 'clothes',
]);


