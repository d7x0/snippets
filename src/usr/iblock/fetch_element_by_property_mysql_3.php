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
    const MAP_PROPERTY_CODE_VALUE_TYPE = [
        'TITLE'         => 'IEP_VALUE',
        'KEYWORDS'      => 'IEP_VALUE',
        'META_DESCRIPTION' => 'IEP_VALUE',
        'BRAND_REF'     => 'IEP_VALUE',
        'NEWPRODUCT'    => 'IPEN_VALUE',
        'SALELEADER'    => 'IPEN_VALUE',
        'SPECIALOFFER'  => 'IPEN_VALUE',
        'ARTNUMBER'     => 'IEP_VALUE',
        'MANUFACTURER'  => 'IEP_VALUE',
        'MATERIAL'      => 'IEP_VALUE',
        'COLOR'         => 'IEP_VALUE',
        'MORE_PHOTO'    => 'IEP_VALUE',
        'RECOMMEND'     => 'IEP_VALUE',
        'BLOG_POST_ID'  => 'IEP_VALUE_NUM',
        'BLOG_COMMENTS_CNT' => 'IEP_VALUE_NUM',
        'BACKGROUND_IMAGE'  => 'IEP_VALUE',
        'TREND'         => 'IPEN_VALUE',
    ];

    const DATA = [
        'type' => [
            'CODE' => 'clothes',
        ],
        'element' => [
            'section' => [
                'CODE' => ['t-shirts', 'sportswear']
            ],
            'element' => [
                'PROPERTY' => [
                    'L' => [
//                        [
//                            'PROPERTY_NAME'  => 'SALELEADER',
//                            'PROPERTY_VALUE' => ['да']
//                        ],
//                        [
//                            'PROPERTY_NAME'  => 'NEWPRODUCT',
//                            'PROPERTY_VALUE' => ['да']
//                        ],
                    ],
                    'S' => [
                        [
                            'PROPERTY_NAME'  => 'MATERIAL',
                            'PROPERTY_VALUE' => 'трикотаж'
                        ],
//                        [
//                            'PROPERTY_NAME'  => 'MATERIAL',
//                            'PROPERTY_VALUE' => '95% хлопок, 5% эластан',
//                        ],
                    ]
                ],
            ]
        ]
    ];
}