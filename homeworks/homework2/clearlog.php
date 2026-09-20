<?php

use \App\Debug\Logger;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

Logger::clearLog();

LocalRedirect('/otus/students_dz/homework2/');
