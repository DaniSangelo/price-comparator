<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class UnauthorizedException extends Exception
{
    public function __construct($message = 'Unauthorized', $code = Response::HTTP_UNAUTHORIZED)
    {
        parent::__construct($message, $code);
    }
}
