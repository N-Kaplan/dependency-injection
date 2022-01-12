<?php

namespace App\Services;

class Dasher implements Transform
{

    public function transform(string $string): string
    {
        return str_replace(' ', '-', $string);
    }
}