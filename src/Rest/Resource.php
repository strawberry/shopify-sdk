<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Strawberry\Shopify\Exceptions\ClientException;
use Strawberry\Shopify\Factories\ModelFactory;
use Strawberry\Shopify\Http\Client;
use Strawberry\Shopify\Http\Response;
use Strawberry\Shopify\Models\Model;

abstract class Resource
{
    /** @var Client */
    protected $client;

    /**
     * A list of the child resources.
     *
     * @var string[]
     */
    protected $childResources = [];

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model;

    /**
     * The prefix for the URI.
     *
     * @var string
     */
    protected $uriPrefix = '';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Transforms the given response to a model.
     */
    protected function toModel(
        Response $response,
        ?string $key = null,
        ?string $model = null
    ): Model {
        $key = $key ?? $this->singularResourceKey();
        $model = $model ?? $this->model;

        return ModelFactory::make($model, $this->data($response, $key));
    }

    /**
     * Transforms the given response to a collection of models.
     */
    protected function toCollection(
        Response $response,
        ?string $key = null,
        ?string $model = null
    ): Collection {
        $key = $key ?? $this->pluralResourceKey();
        $model = $model ?? $this->model;

        return (new Collection(
            $this->data($response, $key)
        ))->mapInto($model);
    }

    /**
     * Determine whether this resource has any children or not.
     */
    public function hasChildren(): bool
    {
        return count($this->childResources) > 0;
    }

    /**
     * Determine whether the resource has a child with the given key.
     */
    public function hasChild(string $key): bool
    {
        return array_key_exists($key, $this->childResources);
    }

    /**
     * Return an instance of the child resource with the given key.
     *
     * @param int|string  $id
     *
     * @throws ClientException
     */
    public function getChild(string $key, $id): ChildResource
    {
        if (! $this->hasChild($key)) {
            throw ClientException::childDoesntExist(static::class, $key);
        }

        $resource = $this->childResources[$key];

        return new $resource($this->client, $this, $id);
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

    public function routeKey(): string
    {
        return $this->pluralResourceKey();
    }

    /**
     * Build the URI for a request to the Shopify resource.
     */
    protected function uri(string $uri = ''): string
    {
        if ($uri !== '') {
            $uri = Str::start($uri, '/');
        }

        return $this->uriPrefix . $this->routeKey() . $uri . '.json';
    }

    /**
     * Grab the data from the response.
     *
     * @return mixed
     */
    protected function data(Response $response, string $key)
    {
        return Arr::get($response->getContent(), $key);
    }

    /**
     * Prepares data to be sent to a write operation.
     *
     * @param  Arrayable|array  $data
     */
    protected function prepareJson($data, string $key): array
    {
        if ($data instanceof Arrayable) {
            $data = $data->toArray();
        }

        return [$key => $data];
    }
}
