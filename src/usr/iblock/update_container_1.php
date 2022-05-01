<?php // data for update property


namespace Customer;


/*
    php exec.php \
        --moduleName "iblock" --apiType "new" \
        --pathToData "usr/iblock/update_container_1.php"
*/
class Data
{
    const DATA = [
        'container' => [
            'CODE' => 'supplier-steel',
            'PROPERTY' => [
                'default' => [
                    'L' => [
                        'DEF' => 'N',
                    ],
                    'N' => [

                    ]
                ],
                'list' => [
                    [   // property 1
                        'CODE' => 'PAYMENT_TYPE',
                        'SETTINGS' => [
                            'PROPERTY_TYPE' => 'L',
                            'PROPERTY_ENUM' => [
                                [
                                    'VALUE' => 'PAYMENT_TYPE_REQUISIT',
                                    'DEF' => 'Y',
                                    'SORT' => 100,
                                ],
                                [
                                    'VALUE' => 'PAYMENT_TYPE_CARD',
                                    'DEF' => 'N',
                                    'SORT' => 200,
                                ],
                            ]
                        ]
                    ],  // property 1
                    [   // property 2
                        'CODE' => 'ORDER_COST_MINIMUM',
                        'SETTINGS' => [
                            'PROPERTY_TYPE' => 'N',

                        ]
                    ],  // property 2
                ]
            ]
        ]
    ];
}