<?php

namespace App;

use Exception;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use tgMdk\TGMDK_Logger;

try {
    $logger = new Logger('commandSampleLogger');
    $formatter = new LineFormatter();
    $formatter->includeStacktraces(true);
    $stdoutHandler = new StreamHandler('php://stdout', Logger::DEBUG);
    $stdoutHandler->setFormatter($formatter);
    $logger->pushHandler($stdoutHandler);
    $fileHandler = new RotatingFileHandler(__DIR__ . '/logs/tgmdk.log');
    $fileHandler->setFormatter($formatter);
    $logger->pushHandler($fileHandler);
    TGMDK_Logger::setLogger($logger);
} catch (Exception $e) {
    die($e->getMessage());
}
