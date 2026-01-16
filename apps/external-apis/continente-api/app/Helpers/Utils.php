<?php

namespace App\Helpers;

class Utils
{
    public static function base64Decode($value)
    {
        return base64_decode($value);
    }
}