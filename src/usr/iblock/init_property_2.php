<?php // data for init property


namespace Customer;


/*
    php exec.php \
        --moduleName "iblock" --apiType "new" \
        --pathToData "usr/iblock/init_property_2.php"
*/
class Data
{
    const DATA = [
        'container' => [
            'CODE' => 'supplier-steel',
            'PROPERTY' => [
                'default' => [
                    'ACTIVE'        => 'Y',
                    'PROPERTY_TYPE' => 'L',
                    'LIST_TYPE'     => 'C',
                    'MULTIPLE'      => 'N'
                ],
                'list' => [
                    [   // property 1
                        'NAME' => 'Отгрузка в день оплаты',
                        'CODE' => 'SHIPMENT_ON_DAY_PAY',
                    ],  // property 1
                    [   // property 2
                        'NAME' => 'Отсрочка платежа',
                        'CODE' => 'PAYMENT_DEFERMENT',
                    ],  // property 2
                    [   // property 3
                        'NAME' => 'Вид транспорта для доставки',
                        'CODE' => 'DELIVERY_TYPE_AVAILABLE',
                        'MULTIPLE' => 'Y'
                    ],  // property 3
                    [   // property 4
                        'NAME' => 'Максимальный вес доставки',
                        'CODE' => 'DELIVERY_WEIGHT_LIMIT',
                        'PROPERTY_TYPE' => 'N',
                    ],  // property 4
                ]
            ]
        ]
    ];
}