<?php

namespace App\Services;

use App\Services\Capitalizer;
use App\Services\Logger;

class Master
{
    private Transform $capitalizer;
    private Transform $dasher;
//    private Logger $logger;
    private string $message;

    /**
     * @param Transform $capitalizer
     * @param Transform $dasher
     * @param string $message
     */
    public function __construct(Transform $capitalizer, Transform $dasher, string $message)
    {
        $this->capitalizer = $capitalizer;
        $this->dasher = $dasher;
        $this->message = $message;
    }

    public function log() {
        $this->logger->index($this->message);

    }

    public function capitalize() {
        return $this->capitalizer->transform($this->message);
    }

    public function dash() {
        return $this->dasher->transform($this->message);
    }

}