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
                        [
                            'PROPERTY_NAME'  => 'SHIPMENT_ON_DAY_PAY',
                            'PROPERTY_VALUE' => 'SHIPMENT_ON_DAY_PAY_ENABLE'
                        ],
                        [
                            'PROPERTY_NAME'  => 'PAYMENT_DEFERMENT',
                            'PROPERTY_VALUE' => 'PAYMENT_DEFERMENT_ENABLE'
                        ]
                    ]
                ],
            ]
        ]
    ];
}