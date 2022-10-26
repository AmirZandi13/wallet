<?php

namespace App\Exceptions;

use App\Constants\Errors;
use Symfony\Component\HttpFoundation\Response;

class UnauthorizedException extends BaseException
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
