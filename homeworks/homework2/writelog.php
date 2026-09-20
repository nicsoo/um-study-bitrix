<?

use \App\Debug\Logger;

 require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<?php
$APPLICATION->SetTitle("Добавление в лог");
?>
    <ul class="list-group">
        <li class="list-group-item">
            <a href="/local/storage/logs/log_custom.log">Файл лога</a>,
            в лог добавлено 'Открыта страница writelog.php'
        </li>
    </ul>
<?
Logger::addLog('Открыта страница writelog.php');

?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>