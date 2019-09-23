<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Concerns;

use Illuminate\Support\Collection;

trait ListsResource
{
    /**
     * Retrieves a list of the resources.
     */
    public function get(array $options = []): Collection
    {
        $response = $this->client->get($this->uri(), $options);

        return $this->toCollection($response);
    }
}
