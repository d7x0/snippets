<?php // data for update element


namespace Customer;


class Variable
{
    const SETTINGS = [
        'CODE' => 'supplier-steel',
        'MODE' => [
            'SET_PROPERTY_FOR_ALL_EXIST_ELEMENT'  => 'Y',
            'SET_PROPERTY_FOR_ELEMENT_IN_SECTION' => 'supplier-steel-siberia',
            'SET_PROPERTY_FOR_ELEMENT_IN_RANGE'   => '160 - 180',
            'SET_PROPERTY_FOR_ELEMENT_IN_ENUM'    => '11, 12',
        ],
    ];

    const DATA = [
        'property' => [
            'default' => [
                'PROPERTY' => [
                    'PAYMENT_TYPE' => 'PAYMENT_TYPE_CARD',
                    'PAYMENT_BANK' => 'ПАО Банк «ФК Oткpытиe»'
                ]
            ],
            'list' => [
                [   // element 1
                    'ID'       => 'ELEMENT_ID',
                    'PROPERTY' => [

                    ]
                ],  // element 1
                [   // element 1
                    'ID'       => 'ELEMENT_ID',
                    'PROPERTY' => [

                    ]
                ],  // element 1
            ]
        ],
        'section' => [
            'section-code' => 'parent-section-code',
        ]
    ];
}