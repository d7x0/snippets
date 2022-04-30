<?php // data for init element


namespace Customer;


/*
    php exec.php \
        --moduleName "iblock" --apiType "new" \
        --pathToData "usr/iblock/init_element.php"
*/
class Data
{
    const DATA = [
        'type'    => [
            'CODE' => 'supplier-steel'
        ],
        'element' => [
            'element' => [
                'IN_SECTIOINS' => 'N',
            ],
            'list' => [
                [   // element 1
                    'NAME' => 'Уральская литейная компания',
                    'CODE' => 'ulk'
                ],  // element 1
                [   // element 2
                    'NAME' => 'ООО "Новые Композитные Технологии"',
                    'CODE' => 'nkt'
                ],  // element 2
                [   // element 3
                    'NAME' => 'ООО "ФЕРУС НОВОСИБИРСК"',
                    'CODE' => 'fn'
                ],  // element 3
                [   // element 4
                    'NAME' => 'ООО "ЛАЗЕРВЕРК"',
                    'CODE' => 'lzv'
                ],  // element 4
            ]
        ]
    ];
}