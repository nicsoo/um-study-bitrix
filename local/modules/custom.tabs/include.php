<?php

defined('B_PROLOG_INCLUDED') || die();

use Bitrix\Main\Loader;
Loader::registerAutoLoadClasses(
    'custom.tabs',
    [
        'Custom\Tabs\EntityDetailsTabs' => 'lib/Tabs/EntityDetailsTabs.php',
    ]
);