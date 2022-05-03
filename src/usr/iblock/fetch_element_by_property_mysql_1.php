<?php // data for init section


namespace Customer;


/*
    launch command:
        php exec.php \
            --moduleName "iblock" --apiType "new" \
            --pathToData "usr/iblock/fetch_element_by_property_mysql_1.php" \
            --queryBuilder "build_query_mixed"
   processing code:
        src/lib/iblock/new/exec_fetch_element_by_property_mysql.php
*/
class Data
{
    const DATA = [
        'type' => [
            'CODE' => 'supplier-steel',
        ],
        'element' => [
            'section' => [
                'CODE' => []
            ],
            'element' => [
                'PROPERTY' => [
                    'L' => [
                        [
                            'PROPERTY_NAME'  => 'DELIVERY_TYPE_AVAILABLE',
                            'PROPERTY_VALUE' => ['AIRPLANE', 'SEMI_TRUCK']
                        ],
                        [
                            'PROPERTY_NAME'  => 'PAYMENT_TYPE',
                            'PROPERTY_VALUE' => ['PAYMENT_TYPE_REQUISIT']
                        ],
                        [
                            'PROPERTY_NAME'  => 'SHIPMENT_ON_DAY_PAY',
                            'PROPERTY_VALUE' => ['SHIPMENT_ON_DAY_PAY_ENABLE']
                        ],
                        [
                            'PROPERTY_NAME'  => 'PAYMENT_DEFERMENT',
                            'PROPERTY_VALUE' => ['PAYMENT_DEFERMENT_ENABLE']
                        ]
                    ],
                    'S' => [
                        [
                            'PROPERTY_NAME'  => 'PAYMENT_BANK',
                            'PROPERTY_VALUE' => 'ПАО Банк «ФК Oткpытиe»'
                        ],
                        [
                            'PROPERTY_NAME'  => 'DELIVERY_WEIGHT_LIMIT',
                            'PROPERTY_VALUE' => '500 тонн'
                        ],
                    ]
                ],
            ]
        ]
    ];
}