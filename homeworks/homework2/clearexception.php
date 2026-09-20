<?php

use App\Debug\Logger;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");


Logger::clearLog("exceptions.log");

LocalRedirect('/otus/students_dz/homework2/');
