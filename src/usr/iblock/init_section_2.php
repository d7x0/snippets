<?php // data for init section


namespace Customer;


/*
    php exec.php \
    --moduleName "iblock" --apiType "new" \
    --pathToData "usr/iblock/init_section_2.php"
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
                    'NAME' => 'Россия',
                    'CODE' => 'country-russia',
                ],  // element 1
                [   // element 1
                    'NAME' => 'Европа',
                    'CODE' => 'region-europe',
                ],  // element 1
            ]
        ]
    ];
}