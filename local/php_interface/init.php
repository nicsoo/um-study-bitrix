<?php

    \Bitrix\Main\UI\Extension::load('custom.time');
    \Bitrix\Main\UI\Extension::load('main.popup');
    

    if (file_exists(__DIR__ . '/../../vendor/autoload.php')) {
        require_once (__DIR__ . '/../../vendor/autoload.php');
    }


