<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentDescription = array(
    'NAME' => 'CUSTOM TAB',
    'DESCRIPTION' => 'Выводит кастомную вкладку в сделку',
    'CACHE_PATH' => 'Y',
    'SORT' => 30,
    'PATH' => array(                                    
        'ID' => 'custom',                                 
        'NAME' => 'Custom-CRM-components',
    )
);