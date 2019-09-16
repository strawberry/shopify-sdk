<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Concerns;

trait DeletesResource
{
    /**
     * Deletes the resource with the given ID.
     */
    public function delete(int $id): void
    {
        $this->client->delete(
            $this->uri((string) $id)
        );
    }
}
