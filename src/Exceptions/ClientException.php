<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Exceptions;

use RuntimeException;

final class ClientException extends RuntimeException
{
    public static function credentialsNotSet(): self
    {
        return new self('No credentials set for Shopify SDK.');
    }
}
