<?php // data for init property


namespace Customer;


/*
    php exec.php \
        --moduleName "iblock" --apiType "new" \
        --pathToData "usr/iblock/init_property_3.php"
*/
class Data
{
    const DATA = [
        'container' => [
            'CODE' => 'supplier-steel',
            'PROPERTY' => [
                'default' => [
                    'ACTIVE'        => 'Y',
                    'LIST_TYPE'     => 'L',
                    'MULTIPLE'      => 'Y',
                    'LINK_IBLOCK_ID' => 0,
                ],
                'list' => [
                    [   // property 1
                        'NAME' => 'Договор на поставку',
                        'CODE' => 'FILE_CONTRACT_DELIVERY',
                        'MULTIPLE' => 'N',
                        'PROPERTY_TYPE' => 'F',
                    ],  // property 1
                    [   // property 2
                        'NAME' => 'Договора на случай форс мажорных обстоятельств',
                        'CODE' => 'FILE_CONTRACT_LIST_FORCEMAJOR',
                        'PROPERTY_TYPE' => 'F',
                    ],  // property 2
                    [   // property 3
                        'NAME' => 'Привязка к поставщику металла',
                        'CODE' => 'REFERENCE_TO_SUPPLIER_STEEL',
                        'PROPERTY_TYPE' => 'E',
                    ],  // property 3
                    [   // property 4
                        'NAME' => 'Привязка к разделу поставщиков бетона',
                        'CODE' => 'REFERENCE_TO_SECTION_SUPPLIER_CONCRETE',
                        'PROPERTY_TYPE' => 'G',
                        'LINK_IBLOCK_ID' => 8,
                    ],  // property 4
                ]
            ]
        ]
    ];
}