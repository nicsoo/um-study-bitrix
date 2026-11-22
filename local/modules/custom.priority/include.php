<?php

defined('B_PROLOG_INCLUDED') || die();

\Bitrix\Main\Loader::registerAutoLoadClasses(
    'custom.priority', // Имя вашего модуля
    [
        // Класс => относительный путь от папки модуля
        'Custom\Priority\PriorityProp' => 'lib/PriorityProp.php',
    ]
);