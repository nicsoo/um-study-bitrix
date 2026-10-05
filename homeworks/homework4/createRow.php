<?php

use App\Models\HospitalsTable;
use Bitrix\Main\Type\Date;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("Список Домашних работ");

$result = HospitalsTable::addMulti([
	[
		'NAME' => "Больница 1",
		'DATE_OF_FOUNDATION' => new Date('25.11.2000'),
		'CITY_ID' => 72,
		'TYPE_ID' => 73,
	],
	[
		'NAME' => "Больница 2",
		'DATE_OF_FOUNDATION' => new Date('19.06.2016'),
		'CITY_ID' => 71,
		'TYPE_ID' => 74,
	],
]);

if ($result->isSuccess()) {
	echo "Записи созданы!";
} else {
	echo $result->getError();
}