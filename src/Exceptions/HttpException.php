<?php

namespace Strawberry\Shopify\Exceptions;

use Exception;

final class HttpException extends Exception
{
    public static function failedRequest(Exception $exception): self
    {
        return new self('Unable to complete the HTTP request', 0, $exception);
    }
}