<?php // data for init section


namespace Customer;


/*
    php exec.php \
        --moduleName "iblock" --apiType "new" \
        --pathToData "usr/iblock/fetch_element_by_property_list_1.php"
*/
class Data
{
    const DATA = [
        'type' => [
            'CODE' => 'supplier-steel',
        ],
        'element' => [
            'element' => [
                'PROPERTY' => [
                    'L' => [
                        'PROPERTY_NAME'  => 'DELIVERY_TYPE_AVAILABLE',
                        'PROPERTY_VALUE' => ['AIRPLANE', 'SEMI_TRUCK']
                    ]
                ],
            ]
        ]
    ];
}