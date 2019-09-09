<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Strawberry\Shopify\Http\Client;
use Strawberry\Shopify\Http\Response;
use Strawberry\Shopify\Models\Model;

abstract class Resource
{
    /** @var Client */
    protected $client;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Transforms the given response to a model.
     */
    protected function toModel(Response $response, ?string $key = null): Model
    {
        $key = $key ?? $this->singularResourceKey();
        $model = $this->model;

        return new $model(
            $this->data($response, $key)
        );
    }

    /**
     * Transforms the given response to a collection of models.
     */
    protected function toCollection(
        Response $response,
        ?string $key = null
    ): Collection {
        $key = $key ?? $this->pluralResourceKey();

        return (new Collection(
            $this->data($response, $key)
        ))->mapInto($this->model);
    }

    public function singularResourceKey(): string
    {
        return $this->guessResourceKey();
    }

    public function pluralResourceKey(): string
    {
        return Str::plural($this->singularResourceKey());
    }

    protected function guessResourceKey(): string
    {
        return Str::snake(class_basename($this->model));
    }

    /**
     * Grab the data from the response.
     */
    protected function data(Response $response, string $key): array
    {
        return Arr::get($response->getContent(), $key);
    }

    /**
     * Prepares data to be sent to a write operation.
     */
    protected function prepareJson(array $data, string $key): array
    {
        return [$key => $data];
    }
}
