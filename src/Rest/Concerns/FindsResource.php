<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Concerns;

use Strawberry\Shopify\Models\Model;

trait FindsResource
{
    /**
     * Retrieves a resource with the given ID.
     */
    public function find(int $id, array $options = []): Model
    {
        $response = $this->client->get($this->uri((string) $id), $options);

        return $this->toModel($response);
    }
}
