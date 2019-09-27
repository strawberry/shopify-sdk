<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Exceptions\Api;

final class RateLimitExceeded extends ApiException
{
    /**
     * The number of milliseconds that must pass before the request
     * can be retried.
     */
    public function retryAfter(): int
    {
        if (! $this->response->hasHeader('Retry-After')) {
            return 0;
        }

        return (int) ($this->response->getHeaderLine('Retry-After') * 1000000);
    }
}
