<?php // data for init section


namespace Customer;


/*
    php exec.php \
        --moduleName "iblock" --apiType "new" \
        --pathToData "usr/iblock/fetch_element_by_property_single_2.php"
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
                    'single' => [
                        'PROPERTY_NAME'  => 'DELIVERY_TYPE_AVAILABLE',
                        'PROPERTY_VALUE' => ['AIRPLANE', 'SEMI_TRUCK']      // [46, 47]
                    ]
                ],
            ]
        ]
    ];
}