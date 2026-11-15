<?php

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use Bitrix\Iblock\ORM\PropertyValue;
use Bitrix\Main\Loader;

Loader::includeModule('iblock');

if (!check_bitrix_sessid()) {
    die();
}

$patientName = (string)($_POST['patientName'] ?? '');
$date = (string)($_POST['date'] ?? '');
$procedureId = (int)($_POST['procedureId'] ?? 0);
if ($patientName === '' || $date === '' || $procedureId === 0) {
    ShowError('Invalid data');
}

$date = new DateTime($date);

$result = \Bitrix\Iblock\Elements\ElementBookingTable::add([
    'NAME'   => $patientName,
    'DATEOFPROCEDURE' => $date,
    'ACTIVE' => 'Y',
]);

if ($result->isSuccess()) {
    $bookingID = $result->getID();
    $bookingObj = \Bitrix\Iblock\Elements\ElementBookingTable::getByPrimary($bookingID,[
        'select' => ['ID', 'NAME', 'PROCEDURES'],
    ])->fetchObject();
    $bookingObj->setProcedures($procedureId);
    $bookingObj->save();
    echo "Запись успешно оформлена!";
} else {
    echo implode("\n", $result->getErrorMessages());
}




