<?php

namespace App\Services;

use App\Services\Capitalizer;
use App\Services\Logger;

class Master
{
    private Transform $capitalizer;
    private Transform $dasher;
    private Logger $logger;
    private string $message;

    /**
     * @param Transform $capitalizer
     * @param Transform $dasher
     * @param \App\Services\Logger $logger
     */
    public function __construct(Transform $capitalizer, Transform $dasher, \App\Services\Logger $logger, string $message)
    {
        $this->capitalizer = $capitalizer;
        $this->dasher = $dasher;
        $this->logger = $logger;
        $this->message = $message;
    }

    public function log(string $message) {
//        $this->logger->index($message);
        
    }

    public function capitalize(string $message) {
        $this->capitalizer->transform($message);
    }

    public function dash(string $message) {
        $this->dasher->transform($message);
    }

}