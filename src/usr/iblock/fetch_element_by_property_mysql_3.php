<?php // data for init section


namespace Customer;


/*
    launch command:
        php exec.php \
            --moduleName "iblock" --apiType "new" \
            --pathToData "usr/iblock/fetch_element_by_property_mysql_3.php" \
            --queryBuilder "build_query_mixed"
   processing code:
        src/lib/iblock/new/exec_fetch_element_by_property_mysql.php
*/
class Data
{
    const DATA = [
        'type' => [
            'CODE' => 'clothes',
        ],
        'element' => [
            'element' => [
                'PROPERTY' => [
                    'L' => [
                        [
                            'PROPERTY_NAME'  => 'SALELEADER',
                            'PROPERTY_VALUE' => ['да']
                        ],
                        [
                            'PROPERTY_NAME'  => 'NEWPRODUCT',
                            'PROPERTY_VALUE' => ['да']
                        ],
                    ],
                    'S' => [
                        [
                            'PROPERTY_NAME'  => 'MATERIAL',
                            'PROPERTY_VALUE' => 'кожа'
                        ],
                    ]
                ],
            ]
        ]
    ];
}