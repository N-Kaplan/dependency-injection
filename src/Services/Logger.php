<?php

namespace App\Services;

use Psr\Log\LoggerInterface;

//see: https://symfony.com/doc/current/logging.html
//see: https://github.com/php-fig/log/blob/master/src/LoggerInterface.php
Class Logger {
    public function index(LoggerInterface $logger, $message)
    {
        $logger->info($message);
    }
}
