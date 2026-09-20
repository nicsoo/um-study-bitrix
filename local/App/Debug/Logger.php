<?php

    namespace App\Debug;

use Bitrix\Main\Diag\ExceptionHandlerFormatter;
use Bitrix\Main\Diag\FileExceptionHandlerLog;

    class Logger extends FileExceptionHandlerLog {

        private $level;

        /**
         * addLog
         *
         * @param string $message Сообщение, которое необходимо записать в файл лога
         * @param string $logFile Название файла лога в директории /local/storage/logs/. По умолчанию - log_custom.log
         * @return void
         */
        public static function addLog(string $message, string $logFile = "log_custom.log"): void {
            $logPath = $_SERVER['DOCUMENT_ROOT'] . '/local/storage/logs/' . $logFile;
            $date = date('d.m.Y H:i:s');
            $formatMessage = $date . " | " . $message . "\n";
            file_put_contents($logPath, $formatMessage, FILE_APPEND); 
        }

        /**
         * clearLog
         *
         * @param string $logFile Название файла лога, который необходимо удалить в директории /local/storage/logs/. 
         * По умолчанию - log_custom.log
         * @return void
         */
        public static function clearLog(string $logFile = "log_custom.log"): void {
            $logPath = $_SERVER['DOCUMENT_ROOT'] . '/local/storage/logs/' . $logFile;
            file_put_contents($logPath, '');
        }

        public function write($exception, $logType) {
            $text = ExceptionHandlerFormatter::format($exception, false, $this->level);

            $context = [
                'type' => static::logTypeToString($logType),
            ];

            $logLevel = static::logTypeToLevel($logType);

            $message = "OTUS | {date} - Host: {host} - {type} - {$text}\n";

            $this->logger->log($logLevel, $message, $context);
        }

    }


