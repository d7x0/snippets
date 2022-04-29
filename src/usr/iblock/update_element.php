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
            'SET_PROPERTY_FOR_ELEMENT_IN_ENUM'    => '11 12',
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
            'element' => [
                [
                    'SECTION_CODE' => 'supplier-steel-ural',        // 17
                    'ELEMENTS_ID'   => '319 '
                ],
                [
                    'SECTION_CODE' => 'supplier-steel-europe',      // 16
                    'ELEMENTS_ID'   => '320 322 '
                ],
                [
                    'SECTION_CODE' => 'supplier-steel-siberia',     // 18
                    'ELEMENTS_ID'   => '321 '
                ]
            ],
            'section' => [  // experimental, view: https://github.com/d7x0/examples/issues/1
                'supplier-steel-country-russia' => [
                    'supplier-steel-europe',
                    'supplier-steel-ural',
                    'supplier-steel-siberia',
                    'supplier-steel-east'
                ],
            ]
        ]
    ];
}