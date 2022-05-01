<?php // data for update property


namespace Customer;


/*
    php exec.php \
        --moduleName "iblock" --apiType "new" \
        --pathToData "usr/iblock/update_container_2.php"
*/
class Data
{
    const DATA = [
        'container' => [
            'CODE' => 'supplier-steel',
            'PROPERTY' => [
                'default' => [
                    'L' => [
                        'LIST_TYPE' => 'C',
                    ]
                ],
                'list' => [
                    [   // property 1
                        'CODE' => 'SHIPMENT_ON_DAY_PAY',
                        'SETTINGS' => [
                            'PROPERTY_TYPE' => 'L',
                            'PROPERTY_ENUM' => [
                                [
                                    'VALUE' => 'SHIPMENT_ON_DAY_PAY_ENABLE',
                                    'DEF' => 'N',
                                ],
                            ]
                        ]
                    ],  // property 1
                    [   // property 2
                        'CODE' => 'PAYMENT_DEFERMENT',
                        'SETTINGS' => [
                            'PROPERTY_TYPE' => 'L',
                            'PROPERTY_ENUM' => [
                                [
                                    'VALUE' => 'PAYMENT_DEFERMENT_ENABLE',
                                    'DEF' => 'N',
                                ],
                            ]
                        ]
                    ],  // property 2
                    [   // property 3
                        'CODE' => 'DELIVERY_TYPE_AVAILABLE',
                        'SETTINGS' => [
                            'PROPERTY_TYPE' => 'L',
                            'PROPERTY_ENUM' => [
                                [
                                    'VALUE' => 'AIRPLANE',
                                    'DEF' => 'N',
                                ],
                                [
                                    'VALUE' => 'SHIP',
                                    'DEF' => 'N',
                                ],
                                [
                                    'VALUE' => 'SEMI_TRUCK',
                                    'DEF' => 'N',
                                ],
                                [
                                    'VALUE' => 'SPACE',
                                    'DEF' => 'N',
                                ],
                            ]
                        ]
                    ],  // property 3
                ]
            ]
        ]
    ];
}