<?php // data for init section


namespace Customer;


/*
    launch command:
        php exec.php \
            --moduleName "iblock" --apiType "new" \
            --pathToData "usr/iblock/fetch_element_by_property_single_1.php"
    processing code:
        src/lib/iblock/new/exec_fetch_element_by_property_single.php
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
                    'S' => [
                        [
                            'PROPERTY_NAME'  => 'ORDER_MUNUFACTURE_TIME',
                            'PROPERTY_VALUE' => '72 часа'
                        ],
                        [
                            'PROPERTY_NAME'  => 'DELIVERY_WEIGHT_LIMIT',
                            'PROPERTY_VALUE' => '500 тонн'
                        ]
                    ]
                ],
            ]
        ]
    ];
}