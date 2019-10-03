<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Concerns;

use Strawberry\Shopify\Models\Model;

trait UpdatesResource
{
    /**
     * Updates an existing resource by its ID.
     */
    public function update(int $id, array $data): Model
    {
        $json = $this->prepareJson($data, $this->postKey());

        $response = $this->client->put(
            $this->uri((string) $id),
            $json
        );

        return $this->toModel($response);
    }
}
