<?php

namespace App\Exceptions;

use App\Constants\Errors;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class UnauthorizedException extends Exception
{
    /**
     * @var string
     */
    protected $message = Errors::UNAUTHORIZED;

    /**
     * @var string
     */
    protected $code = Response::HTTP_UNAUTHORIZED;
}
