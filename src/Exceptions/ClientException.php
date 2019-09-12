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

    public static function childDoesntExist(string $parent, string $child): self
    {
        return new self("Child resource [$child] does not exist on parent [$parent]");
    }
}
