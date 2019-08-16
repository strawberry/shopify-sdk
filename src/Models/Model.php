<?php

namespace Strawberry\Shopify\Models;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

abstract class Model
{
    /**
     * @param  Arrayable|array
     */
    public function __construct($attributes)
    {
        $this->fill($attributes);
    }

    /**
     * A bit of a lazy getter which just returns the attribute with the given
     * key, or null if it's not found.
     *
     * @return mixed
     */
    public function __get(string $key)
    {
        return $this->getAttribute($key);
    }

    /**
     * Build a model instance from an API response.
     */
    public static function fromResponse(Response $response, string $key): self
    {
        $data = Arr::get($response->getContent(), $key);

        return new static($data);
    }
}
