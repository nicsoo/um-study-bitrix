<?php

use App\Models\HospitalsTable;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$list = HospitalsTable::getList([
    'select' => [
        'ID',
        'NAME',
        'DATE_OF_FOUNDATION',
        'CITIES',
        'TYPES',
        'AGE_DAYS',

    ],
])->fetchCollection();

foreach ($list as $hospital) {
    echo "ID: " . $hospital->get('ID') . "<br>";
    echo "Имя: " . $hospital->get('NAME') . "<br>";
    echo "Дата основания: " . $hospital->get('DATE_OF_FOUNDATION') . "<br>";
    echo "Город: " . $hospital->get('CITIES')->get('NAME') . "<br>";
    echo "Тип клиники: " . $hospital->get('TYPES')->get('NAME') . "<br>";
    echo "Сколько дней с момента основания: " . $hospital->get('AGE_DAYS') . "<br>";
    echo "<br>";
}

