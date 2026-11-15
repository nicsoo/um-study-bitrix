<?php

defined('B_PROLOG_INCLUDED') || die();

use Bitrix\Main\Loader;
Loader::registerAutoLoadClasses(
    'custom.booking',
    [
        'Custom\Booking\CustomBookProp' => 'lib/iblock/CustomBookProp.php',
    ]
);