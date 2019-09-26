<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Exceptions;

use Exception;

final class InvalidShopifyRequest extends Exception
{
    public static function hmacDoesNotMatch()
    {
        return new static('Computed HMAC digest does not match header');
    }
}
