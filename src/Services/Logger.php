<?php

namespace App\Services;

use Psr\Log\LoggerInterface;

//see: https://symfony.com/doc/current/logging.html
//see: https://github.com/php-fig/log/blob/master/src/LoggerInterface.php
Class Logger {

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function index($message)
    {
        $this->logger->info($message);
    }
}
