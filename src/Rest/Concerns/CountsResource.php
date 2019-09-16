<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Concerns;

trait CountsResource
{
    /**
     * Retrieves a count of the resource.
     */
    public function count(array $options = []): int
    {
        $response = $this->client->get(
            $this->uri('count'),
            $options
        );

        return (int) $this->data($response, 'count');
    }
}
