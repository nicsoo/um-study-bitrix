<?php

use Bitrix\Main\ORM\Fields;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$db = \Bitrix\Main\Application::getConnection();

if (!$db->isTableExists('hospitals_table')) {
    $fields = [
        'ID' => new Fields\IntegerField('ID'),
        'NAME' => (new Fields\StringField('NAME'))
            ->configureRequired()
            ->configureSize(255),
        'DATE_OF_FOUNDATION' => new Fields\DateField('DATE_OF_FOUNDATION'),
        'CITY_ID' => new Fields\IntegerField('CITY_ID'),
        'TYPE_ID' => new Fields\IntegerField('TYPE_ID'),
    ];

    $db->createTable('hospitals_table', $fields, ['ID'], ['ID']);
} else {
    echo 'База данных уже существует!';
}