<?php 
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$APPLICATION->IncludeComponent(
	'bitrix:main.ui.grid',
	'',
	[
		'GRID_ID' => $arResult['GRID_ID'],
		'COLUMNS' => $arResult['COLUMNS'],
		'ROWS' => $arResult['ROWS'],
		'AJAX_MODE' => 'Y',
		'AJAX_ID' => \CAjax::getComponentID('bitrix:main.ui.grid', '.default', ''),
		'AJAX_OPTION_JUMP' => 'N',
		'AJAX_OPTION_HISTORY' => 'N',
		
	]
);
?>