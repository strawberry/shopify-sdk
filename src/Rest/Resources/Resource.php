<?php

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
    protected $model = Shop::class;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Transforms the given response to a model.
     */
    protected function toModel(Response $response, string $key = null): Model
    {
        $key = $key ?? $this->guessKey();
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
        string $key = null
    ): Collection {
        $key = $key ?? Str::plural($this->guessKey());

        return (new Collection(
            $this->data($response, $key)
        ))->mapInto($this->model);
    }

    /**
     * Normalise the given key. If an empty string was given, then we will try
     * and guess the key from the classname for this resource.
     */
    private function guessKey(): string
    {
        return Str::snake(class_basename($this->model));
    }

    /**
     * Grab the data from the response.
     */
    private function data(Response $response, string $key): array
    {
        return Arr::get($response->getContent(), $key);
    }
}
