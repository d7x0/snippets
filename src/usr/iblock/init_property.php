<?php // data for init property


namespace Customer;


class Data
{
    const DATA = [
        'container' => [
            'CODE' => 'supplier-steel',
            'PROPERTY' => [
                'default' => [
                    'ACTIVE'        => 'Y',
                    'PROPERTY_TYPE' => 'S',
                ],
                'list' => [
                    [   // element 1
                        'NAME' => 'Минимальная сумма заказа',
                        'CODE' => 'ORDER_COST_MINIMUM',
                    ],  // element 1
                    [   // element 2
                        'NAME' => 'Время изготовления заказа',
                        'CODE' => 'ORDER_MUNUFACTURE_TIME',
                    ],  // element 2
                    [   // element 3
                        'NAME' => 'Форма оплаты',
                        'CODE' => 'PAYMENT_TYPE',
                        'PROPERTY_TYPE' => 'L',
                    ],  // element 3
                    [   // element 4
                        'NAME' => 'Банк оплаты',
                        'CODE' => 'PAYMENT_BANK',
                    ],  // element 4
                ]
            ]
        ]
    ];
}