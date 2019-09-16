<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Concerns;

use Illuminate\Contracts\Support\Arrayable;
use Strawberry\Shopify\Models\Model;

trait CreatesResource
{
    /**
     * Creates a resource.
     *
     * @param  Arrayable|array  $data
     */
    public function create($data): Model
    {
        $json = $this->prepareJson($data, $this->singularResourceKey());

        $response = $this->client->post(
            $this->uri(), $json
        );

        return $this->toModel($response);
    }
}
