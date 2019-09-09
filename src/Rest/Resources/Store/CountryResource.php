<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Store;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Country;
use Strawberry\Shopify\Rest\Resources\Resource;

final class CountryResource extends Resource
{
    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Country::class;

    /**
     * Retrieves a list of countries.
     *
     * @see https://help.shopify.com/en/api/reference/store-properties/country#index-2019-07
     */
    public function get(array $fields = [], ?int $sinceId = null): Collection
    {
        $response = $this->client->get('countries.json', [
            'fields' => implode(',', $fields),
            'since_id' => $sinceId
        ]);

        return $this->toCollection($response);
    }

    /**
     * Retrieves a specific country.
     *
     * @see https://help.shopify.com/en/api/reference/store-properties/country#show-2019-07
     */
    public function find(int $id, array $fields = []): Country
    {
        $response = $this->client->get("countries/{$id}.json", [
            'fields' => implode(',', $fields),
        ]);

        return $this->toModel($response);
    }

    /**
     * Create a country.
     *
     * @see https://help.shopify.com/en/api/reference/store-properties/country#create-2019-07
     */
    public function create(array $data): Country
    {
        $json = $this->prepareJson($data, $this->singularResourceKey());

        $response = $this->client->post("countries.json", $json);

        return $this->toModel($response);
    }

    /**
     * Updates an existing country.
     *
     * @see https://help.shopify.com/en/api/reference/store-properties/country#update-2019-07
     */
    public function update(int $id, array $data): Country
    {
        $json = $this->prepare($data, $this->singularResourceKey());

        $response = $this->client->put("countries/{$id}.json", $json);

        return $this->toModel($response);
    }

    /**
     * Deletes a country.
     *
     * @see https://help.shopify.com/en/api/reference/store-properties/country#destroy-2019-07
     */
    public function delete(int $id): void
    {
        $this->client->delete("countries/{$id}.json");
    }

    /**
     * Retrieves a count of countries.
     *
     * @see https://help.shopify.com/en/api/reference/store-properties/country#count-2019-07
     */
    public function count(): int
    {
        $response = $this->client->get('countries/count.json');

        return (int) $this->data($response, 'count');
    }
}
