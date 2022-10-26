<?php

namespace App\Exceptions;

use App\Constants\Errors;
use Symfony\Component\HttpFoundation\Response;

class UserHasNotEnoughBalanceException extends BaseException
{
    /**
     * @var string
     */
    protected $message = Errors::USER_HAS_NOT_ENOUGH_BALANCE;

    /**
     * @var string
     */
    protected $code = Response::HTTP_BAD_REQUEST;
}
