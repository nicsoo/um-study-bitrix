<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentParameters = [
    'GROUPS' => [],
    'PARAMETERS' => [
        'IBLOCK_ID' => [
            'PARENT' => 'BASE',
            'NAME' => 'ID IBLOCK',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ],
        'GRID_ID' => [
            'PARENT' => 'BASE',
            'NAME' => 'ID GRID',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ],
    ]

];