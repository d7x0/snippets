<?php // data for update property


namespace Customer;


class Data
{
    const DATA = [
        'container' => [
            'CODE' => 'supplier-steel',
            'PROPERTY' => [
                'property' => [
                    'L' => [
                        'DEF' => 'N',
                    ]
                ],
                'list' => [
                    [   // element 1
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
                    ],  // element 1
                ]
            ]
        ]
    ];
}