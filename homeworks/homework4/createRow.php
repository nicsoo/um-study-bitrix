<?php

use App\Models\HospitalsTable;
use Bitrix\Main\Type\Date;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("Список Домашних работ");

$result = HospitalsTable::addMulti([
	[
		'NAME' => "Больница 1",
		'DATE_OF_FOUNDATION' => new Date('25.11.2000'),
		'CITY_ID' => 34,
		'TYPE_ID' => 36,
	],
	[
		'NAME' => "Больница 2",
		'DATE_OF_FOUNDATION' => new Date('19.06.2016'),
		'CITY_ID' => 35,
		'TYPE_ID' => 37,
	],
]);

if ($result->isSuccess()) {
	echo "Записи созданы!";
} else {
	echo $result->getError();
}