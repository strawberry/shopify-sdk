<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Strawberry\Shopify\Exceptions\SdkException;
use Strawberry\Shopify\Factories\CollectionFactory;
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
     *
     * @return mixed
     */
    protected function toCollection(
        Response $response,
        ?string $key = null,
        ?string $model = null
    ) {
        $key = $key ?? $this->pluralResourceKey();
        $model = $model ?? $this->model;

        $items = array_map(function ($item) use ($model) {
            return ModelFactory::make($model, $item);
        }, $this->data($response, $key));

        return CollectionFactory::make($items);
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
     * @throws SdkException
     */
    public function getChild(string $key, $id): ChildResource
    {
        if (! $this->hasChild($key)) {
            throw SdkException::childDoesntExist(static::class, $key);
        }

        $resource = $this->childResources[$key];

        return new $resource($this->client, $this, $id);
    }

    /**
     * The key primarily used when a single resource is returned from the API.
     */
    public function singularResourceKey(): string
    {
        return $this->guessResourceKey();
    }

    /**
     * The key primarily used when a collection of resources are returned from
     * the API.
     */
    public function pluralResourceKey(): string
    {
        return Str::plural($this->singularResourceKey());
    }

    /**
     * This tries to guess the resource key for the resource, based on the
     * name of the model.
     */
    protected function guessResourceKey(): string
    {
        return Str::snake(class_basename($this->model));
    }

    /**
     * The key used in the URI when accessing the section of the API related
     * to this resource.
     */
    public function routeKey(): string
    {
        return $this->pluralResourceKey();
    }

    /**
     * The key used when making a write operation to the API.
     */
    public function postKey(): string
    {
        return $this->singularResourceKey();
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
