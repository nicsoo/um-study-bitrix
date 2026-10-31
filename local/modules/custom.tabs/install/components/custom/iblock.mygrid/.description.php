<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentDescription = array(
    'NAME' => 'CUSTOM GRID',
    'DESCRIPTION' => 'Выводит кастомную таблицу с кнопкой экспорта в эксель',
    'CACHE_PATH' => 'Y',
    'SORT' => 30,
    'PATH' => array(                                    
        'ID' => 'custom',                                 
        'NAME' => 'Custom grid',
    )
);