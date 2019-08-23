<?php

namespace Strawberry\Shopify\Models;

use Illuminate\Contracts\Support\Arrayable;
use Strawberry\Shopify\Models\Concerns\HasAttributes;

abstract class Model implements Arrayable
{
    use HasAttributes;

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
     * Return an array representation of the model.
     */
    public function toArray(): array
    {
        return $this->attributes;
    }
}
