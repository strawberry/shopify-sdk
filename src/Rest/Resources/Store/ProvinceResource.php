<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Store;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Province;
use Strawberry\Shopify\Rest\Resources\ChildResource;

final class ProvinceResource extends ChildResource
{
    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Province::class;

    /**
     * Retrieves a list of provinces for a country.
     *
     * @see https://help.shopify.com/en/api/reference/store-properties/province#index-2019-07
     */
    public function get(array $fields = [], ?int $sinceId = null): Collection
    {
        $response = $this->client->get($this->uri(), [
            'fields' => implode(',', $fields),
            'since_id' => $sinceId
        ]);

        return $this->toCollection($response);
    }

    /**
     * Retrieves a single province for a country.
     *
     * @see https://help.shopify.com/en/api/reference/store-properties/province#show-2019-07
     */
    public function find(int $id, array $fields = []): Province
    {
        $response = $this->client->get($this->uri((string) $id), [
            'fields' => implode(',', $fields),
        ]);

        return $this->toModel($response);
    }

    /**
     * Updates an existing province for a country.
     *
     * @see https://help.shopify.com/en/api/reference/store-properties/province#update-2019-07
     */
    public function update(int $id, array $data): Province
    {
        $json = $this->prepare($data, $this->singularResourceKey());

        $response = $this->client->put($this->uri((string) $id), $json);

        return $this->toModel($response);
    }

    /**
     * Retrieves a count of provinces for a country.
     *
     * @see https://help.shopify.com/en/api/reference/store-properties/province#count-2019-07
     */
    public function count(): int
    {
        $response = $this->client->get($this->uri('count'));

        return (int) $this->data($response, 'count');
    }
}
