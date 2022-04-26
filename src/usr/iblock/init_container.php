<?php // data for init container


$message = [
    [
        'MESSAGE_ID'     => 'ELEMENT_ADD',
        'MESSAGE_TEXT'   => 'Добавить поставщика',
    ],
    [
        'MESSAGE_ID'     => 'ELEMENT_DELETE',
        'MESSAGE_TEXT'   => 'Удалить поставщика',
    ],
    [
        'MESSAGE_ID'     => 'ELEMENT_EDIT',
        'MESSAGE_TEXT'   => 'Редактировать поставщика',
    ],
    [
        'MESSAGE_ID'     => 'ELEMENT_NAME',
        'MESSAGE_TEXT'   => 'Поставщик',
    ],
    [
        'MESSAGE_ID'     => 'ELEMENTS_NAME',
        'MESSAGE_TEXT'   => 'Поставщики',
    ],
    [
        'MESSAGE_ID'     => 'SECTION_ADD',
        'MESSAGE_TEXT'   => 'Добавить группу постащиков',
    ],
    [
        'MESSAGE_ID'     => 'SECTION_DELETE',
        'MESSAGE_TEXT'   => 'Удалить группу поставщиков',
    ],
    [
        'MESSAGE_ID'     => 'SECTION_EDIT',
        'MESSAGE_TEXT'   => 'Редактировать группу поставщиков',
    ],
    [
        'MESSAGE_ID'     => 'SECTION_NAME',
        'MESSAGE_TEXT'   => 'Группа поставщиков',
    ],
    [
        'MESSAGE_ID'     => 'SECTIONS_NAME',
        'MESSAGE_TEXT'   => 'Группы поставщиков',
    ],
];
$field = [
    [
        'FIELD_ID'      => 'ACTIVE',
        'IS_REQUIRED'   => 'Y',
        'DEFAULT_VALUE' => 'Y',
    ],
    [
        'FIELD_ID'      => 'ACTIVE_FROM',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => '',
    ],
    [
        'FIELD_ID'      => 'ACTIVE_TO',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => '',
    ],
    [
        'FIELD_ID'      => 'CODE',
        'IS_REQUIRED'   => 'Y',
        'DEFAULT_VALUE' => 'a:8:{s:6:"UNIQUE";s:1:"Y";s:15:"TRANSLITERATION";s:1:"Y";s:9:"TRANS_LEN";i:100;s:10:"TRANS_CASE";s:1:"L";s:11:"TRANS_SPACE";s:1:"_";s:11:"TRANS_OTHER";s:1:"_";s:9:"TRANS_EAT";s:1:"Y";s:10:"USE_GOOGLE";s:1:"Y";}',
    ],
    [
        'FIELD_ID'      => 'DETAIL_PICTURE',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => 'a:17:{s:5:"SCALE";s:1:"N";s:5:"WIDTH";s:0:"";s:6:"HEIGHT";s:0:"";s:13:"IGNORE_ERRORS";s:1:"N";s:6:"METHOD";s:8:"resample";s:11:"COMPRESSION";i:95;s:18:"USE_WATERMARK_TEXT";s:1:"N";s:14:"WATERMARK_TEXT";s:0:"";s:19:"WATERMARK_TEXT_FONT";s:0:"";s:20:"WATERMARK_TEXT_COLOR";s:0:"";s:19:"WATERMARK_TEXT_SIZE";s:0:"";s:23:"WATERMARK_TEXT_POSITION";s:2:"tl";s:18:"USE_WATERMARK_FILE";s:1:"N";s:14:"WATERMARK_FILE";s:0:"";s:20:"WATERMARK_FILE_ALPHA";s:0:"";s:23:"WATERMARK_FILE_POSITION";s:2:"tl";s:20:"WATERMARK_FILE_ORDER";N;}',
    ],
    [
        'FIELD_ID'      => 'DETAIL_TEXT',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => '',
    ],
    [
        'FIELD_ID'      => 'DETAIL_TEXT_TYPE',
        'IS_REQUIRED'   => 'Y',
        'DEFAULT_VALUE' => 'text',
    ],
    [
        'FIELD_ID'      => 'DETAIL_TEXT_TYPE_ALLOW_CHANGE',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => 'Y',
    ],
    [
        'FIELD_ID'      => 'IBLOCK_SECTION',
        'IS_REQUIRED'   => 'N', // Привязка к разделам Y - включена, N - отключена
        'DEFAULT_VALUE' => 'a:1:{s:22:"KEEP_IBLOCK_SECTION_ID";s:1:"N";}',
    ],
    [
        'FIELD_ID'      => 'LOG_ELEMENT_ADD',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => '',
    ],
    [
        'FIELD_ID'      => 'LOG_ELEMENT_DELETE',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => '',
    ],
    [
        'FIELD_ID'      => 'LOG_ELEMENT_EDIT',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => '',
    ],
    [
        'FIELD_ID'      => 'LOG_SECTION_ADD',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => '',
    ],
    [
        'FIELD_ID'      => 'LOG_SECTION_DELETE',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => '',
    ],
    [
        'FIELD_ID'      => 'LOG_SECTION_EDIT',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => '',
    ],
    [
        'FIELD_ID'      => 'NAME',
        'IS_REQUIRED'   => 'Y',
        'DEFAULT_VALUE' => '',
    ],
    [
        'FIELD_ID'      => 'PREVIEW_PICTURE',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => 'a:20:{s:11:"FROM_DETAIL";s:1:"N";s:5:"SCALE";s:1:"N";s:5:"WIDTH";s:0:"";s:6:"HEIGHT";s:0:"";s:13:"IGNORE_ERRORS";s:1:"N";s:6:"METHOD";s:8:"resample";s:11:"COMPRESSION";i:95;s:18:"DELETE_WITH_DETAIL";s:1:"N";s:18:"UPDATE_WITH_DETAIL";s:1:"N";s:18:"USE_WATERMARK_TEXT";s:1:"N";s:14:"WATERMARK_TEXT";s:0:"";s:19:"WATERMARK_TEXT_FONT";s:0:"";s:20:"WATERMARK_TEXT_COLOR";s:0:"";s:19:"WATERMARK_TEXT_SIZE";s:0:"";s:23:"WATERMARK_TEXT_POSITION";s:2:"tl";s:18:"USE_WATERMARK_FILE";s:1:"N";s:14:"WATERMARK_FILE";s:0:"";s:20:"WATERMARK_FILE_ALPHA";s:0:"";s:23:"WATERMARK_FILE_POSITION";s:2:"tl";s:20:"WATERMARK_FILE_ORDER";N;}',
    ],
    [
        'FIELD_ID'      => 'PREVIEW_TEXT',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => '',
    ],
    [
        'FIELD_ID'      => 'PREVIEW_TEXT_TYPE',
        'IS_REQUIRED'   => 'Y',
        'DEFAULT_VALUE' => 'text',
    ],
    [
        'FIELD_ID'      => 'PREVIEW_TEXT_TYPE_ALLOW_CHANGE',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => 'Y',
    ],
    [
        'FIELD_ID'      => 'SECTION_CODE',
        'IS_REQUIRED'   => 'Y',
        'DEFAULT_VALUE' => 'a:8:{s:6:"UNIQUE";s:1:"Y";s:15:"TRANSLITERATION";s:1:"Y";s:9:"TRANS_LEN";i:100;s:10:"TRANS_CASE";s:1:"L";s:11:"TRANS_SPACE";s:1:"_";s:11:"TRANS_OTHER";s:1:"_";s:9:"TRANS_EAT";s:1:"Y";s:10:"USE_GOOGLE";s:1:"Y";}',
    ],
    [
        'FIELD_ID'      => 'SECTION_DESCRIPTION',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => '',
    ],
    [
        'FIELD_ID'      => 'SECTION_DESCRIPTION_TYPE',
        'IS_REQUIRED'   => 'Y',
        'DEFAULT_VALUE' => 'text',
    ],
    [
        'FIELD_ID'      => 'SECTION_DESCRIPTION_TYPE_ALLOW_CHANGE',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => 'Y',
    ],
    [
        'FIELD_ID'      => 'SECTION_DETAIL_PICTURE',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => 'a:17:{s:5:"SCALE";s:1:"N";s:5:"WIDTH";s:0:"";s:6:"HEIGHT";s:0:"";s:13:"IGNORE_ERRORS";s:1:"N";s:6:"METHOD";s:8:"resample";s:11:"COMPRESSION";i:95;s:18:"USE_WATERMARK_TEXT";s:1:"N";s:14:"WATERMARK_TEXT";s:0:"";s:19:"WATERMARK_TEXT_FONT";s:0:"";s:20:"WATERMARK_TEXT_COLOR";s:0:"";s:19:"WATERMARK_TEXT_SIZE";s:0:"";s:23:"WATERMARK_TEXT_POSITION";s:2:"tl";s:18:"USE_WATERMARK_FILE";s:1:"N";s:14:"WATERMARK_FILE";s:0:"";s:20:"WATERMARK_FILE_ALPHA";s:0:"";s:23:"WATERMARK_FILE_POSITION";s:2:"tl";s:20:"WATERMARK_FILE_ORDER";N;}',
    ],
    [
        'FIELD_ID'      => 'SECTION_NAME',
        'IS_REQUIRED'   => 'Y',
        'DEFAULT_VALUE' => '',
    ],
    [
        'FIELD_ID'      => 'SECTION_PICTURE',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => 'a:20:{s:11:"FROM_DETAIL";s:1:"N";s:5:"SCALE";s:1:"N";s:5:"WIDTH";s:0:"";s:6:"HEIGHT";s:0:"";s:13:"IGNORE_ERRORS";s:1:"N";s:6:"METHOD";s:8:"resample";s:11:"COMPRESSION";i:95;s:18:"DELETE_WITH_DETAIL";s:1:"N";s:18:"UPDATE_WITH_DETAIL";s:1:"N";s:18:"USE_WATERMARK_TEXT";s:1:"N";s:14:"WATERMARK_TEXT";s:0:"";s:19:"WATERMARK_TEXT_FONT";s:0:"";s:20:"WATERMARK_TEXT_COLOR";s:0:"";s:19:"WATERMARK_TEXT_SIZE";s:0:"";s:23:"WATERMARK_TEXT_POSITION";s:2:"tl";s:18:"USE_WATERMARK_FILE";s:1:"N";s:14:"WATERMARK_FILE";s:0:"";s:20:"WATERMARK_FILE_ALPHA";s:0:"";s:23:"WATERMARK_FILE_POSITION";s:2:"tl";s:20:"WATERMARK_FILE_ORDER";N;}',
    ],
    [
        'FIELD_ID'      => 'SECTION_XML_ID',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => '',
    ],
    [
        'FIELD_ID'      => 'SORT',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => '0',
    ],
    [
        'FIELD_ID'      => 'TAGS',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => '',
    ],
    [
        'FIELD_ID'      => 'XML_ID',
        'IS_REQUIRED'   => 'Y',
        'DEFAULT_VALUE' => '',
    ],
    [
        'FIELD_ID'      => 'XML_IMPORT_START_TIME',
        'IS_REQUIRED'   => 'N',
        'DEFAULT_VALUE' => '2022-04-25 08:14:18',
    ],
];


$data = [
    'type' => [
        [   // type 1
            'ID' => 'suppliers',
            'LANG' => [
                'ru' => [
                    'NAME' => 'Поставщики',
                    'SECTION_NAME' => 'Група поставщиков',
                    'ELEMENT_NAME' => 'Поставщики',
                ],
                'en' => [
                    'NAME' => 'Suppliers',
                    'SECTION_NAME' => 'Suppliers group',
                    'ELEMENT_NAME' => 'Supplier',
                ]
            ],
        ],  // type 1
    ],
    'container' => [
        [   // container 1
            'CODE'      => 'supplier-steel',
            'NAME'      => 'Металл',
            'FIELD'     => $field,
            'MESSAGE'   => $message,
            'SECTION' => [
                [   // section 1
                    'NAME' => ''
                ],  // section 1
                [   // section 2
                    'NAME' => ''
                ],  // section 2
            ],
            'SETTINGS'  => [
                'SITE_ID'   => 's1',
                'ACTIVE'    => 'Y',
                'GROUP'     => [
                    [
                        'GROUP_ID'   => 1,
                        'PERMISSION' => 'X',
                    ],
                    [
                        'GROUP_ID'   => 2,
                        'PERMISSION' => 'R',
                    ],
                ],
                'WORKFLOW'  => 'N',
                'LIST_MODE' => '',
                'SECTION_PROPERTY' => 'N',
                'PROPERTY_INDEX'   => 'N',
            ],
            'PROPERTY' => [
                [

                ],
            ],
            'PROPERTY_ENUM' => [
                [

                ],
            ],
        ],  // container 1
        [   // container 2
            'CODE'      => 'supplier-concrete',
            'NAME'      => 'Бетон',
            'FIELD'     => $field,
            'MESSAGE'   => $message,
            'SECTION' => [
                [   // section 1
                    'NAME' => ''
                ],  // section 1
                [   // section 2
                    'NAME' => ''
                ],  // section 2
            ],
            'SETTINGS'  => [
                'SITE_ID'   => 's1',
                'ACTIVE'    => 'Y',
                'GROUP'     => [
                    [
                        'GROUP_ID'   => 1,
                        'PERMISSION' => 'X',
                    ],
                    [
                        'GROUP_ID'   => 2,
                        'PERMISSION' => 'R',
                    ],
                ],
                'WORKFLOW'  => 'N',
                'LIST_MODE' => '',
                'SECTION_PROPERTY' => 'N',
                'PROPERTY_INDEX'   => 'N',
            ],
            'PROPERTY' => [
                [

                ],
            ],
            'PROPERTY_ENUM' => [
                [

                ],
            ],
        ],  // container 2
    ],
];