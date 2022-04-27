<?php // data for init property


namespace Customer;


class Data
{
    const DATA = [
        'container' => [
            'CODE' => 'supplier-steel',
            'PROPERTY' => [
                'property' => [
                    'ACTIVE'        => 'Y',
                    'PROPERTY_TYPE' => 'S',
                ],
                'list' => [
                    [   // element 1
                        'NAME' => 'Минимальная сумма заказа',
                        'CODE' => 'COST_MINIMUM',
                    ],  // element 1
                    [   // element 2
                        'NAME' => 'Время изготовления заказа',
                        'CODE' => 'ORDER_MUNUFACTURE_TIME',
                    ],  // element 2
                ]
            ]
        ]
    ];
}