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
		'ALLOW_SORT' => true,
		'NAV_OBJECT' => $arResult['NAV'],
		'SHOW_PAGINATION' => true,
		'SHOW_PAGESIZE' => true,
		'PAGE_SIZES' => [
			['NAME' => '5', 'VALUE' => '5'],
			['NAME' => '10', 'VALUE' => '10'],
			['NAME' => '25', 'VALUE' => '25'],
		],
	]
);

?>