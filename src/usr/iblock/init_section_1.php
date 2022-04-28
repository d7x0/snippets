<?php // data for init section


namespace Customer;


/*
    php exec.php \
    --moduleName "iblock" --apiType "new" \
    --pathToData "usr/iblock/init_section_1.php"
*/
class Data
{
    const DATA = [
        'container'    => [
            'CODE' => 'supplier-steel'
        ],
        'section' => [
            'element' => [
                'ACTIVE' => 'Y',
            ],
            'list' => [
                [   // element 1
                    'NAME' => 'Европа',
                    'CODE' => 'europe',
                ],  // element 1
                [   // element 2
                    'NAME' => 'Урал',
                    'CODE' => 'ural',
                ],  // element 2
                [   // element 3
                    'NAME' => 'Сибирь',
                    'CODE' => 'siberia',
                ],  // element 3
                [   // element 4
                    'NAME' => 'Восток',
                    'CODE' => 'east',
                ],  // element 4
            ]
        ]
    ];
}