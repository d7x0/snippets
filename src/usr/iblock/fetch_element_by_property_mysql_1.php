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
    const MAP_PROPERTY_CODE_VALUE_TYPE = [
        'ORDER_COST_MINIMUM'        => 'IEP_VALUE_NUM',     // N
        'ORDER_MUNUFACTURE_TIME'    => 'IEP_VALUE',         // S
        'PAYMENT_TYPE'              => 'IPEN_VALUE',        // L
        'PAYMENT_BANK'              => 'IEP_VALUE',         // S

        'SHIPMENT_ON_DAY_PAY'       => 'IPEN_VALUE',        // L
        'PAYMENT_DEFERMENT'         => 'IPEN_VALUE',        // L
        'DELIVERY_TYPE_AVAILABLE'   => 'IPEN_VALUE',        // L MULTIPLE
        'DELIVERY_WEIGHT_LIMIT'     => 'IEP_VALUE_NUM',     // N

        'FILE_CONTRACT_DELIVERY'        => 'IEP_VALUE',     // F
        'FILE_CONTRACT_LIST_FORCEMAJOR' => 'IEP_VALUE',     // F MULTIPLE

        'REFERENCE_TO_SUPPLIER_STEEL'            => 'IEP_VALUE',  // E MULTIPLE
        'REFERENCE_TO_SECTION_SUPPLIER_CONCRETE' => 'IEP_VALUE',  // G MULTIPLE
    ];

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
                            'PROPERTY_VALUE' => [
                                '?????? ???????? ?????? O????p??????e??',
                            ],
                            'PROPERTY_VALUE_CONCAT_OPERATOR' => 'OR',
                        ],
                        [
                            'PROPERTY_NAME'  => 'DELIVERY_WEIGHT_LIMIT',
                            'PROPERTY_VALUE' => [
                                '500 ????????'
                            ],
                            'PROPERTY_VALUE_CONCAT_OPERATOR' => 'OR',
                        ]
                    ]
                ],
            ]
        ]
    ];
}