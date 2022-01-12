<?php

namespace App\Services;

use App\Services\Capitalizer;
use App\Services\Logger;

class Master
{
    private Transform $capitalizer;
    private Transform $dasher;
    private Logger $logger;

    /**
     * @param Transform $capitalizer
     * @param Transform $dasher
     * @param \App\Services\Logger $logger
     */
    public function __construct(Transform $capitalizer, Transform $dasher, \App\Services\Logger $logger)
    {
        $this->capitalizer = $capitalizer;
        $this->dasher = $dasher;
        $this->logger = $logger;
    }

    public function log(string $message) {
        $this->logger->index($message);
    }

    public function capitalize(string $message) {
        $this->capitalizer->transform($message);
    }

    public function dash(string $message) {
        $this->dasher->transform($message);
    }

}