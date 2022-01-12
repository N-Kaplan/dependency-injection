<?php

namespace App\Services;

class Capitalizer implements Transform
{
    public function transform(string $string): string
    {
        $string = strtolower($string);
        for ($i = 0, $length = strlen($string); $i < $length; $i += 2) {
            $string[$i] = strtoupper($string[$i]);
        }
        return $string;

    }

}