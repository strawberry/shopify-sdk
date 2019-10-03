<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Factories;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Strawberry\Shopify\Exceptions\ClientException;

final class CollectionFactory
{
    /**
     * The type of collection to return. This can either be 'array' or the
     * name of a class that accepts an array of items as a constructor,
     * such as Illuminate\Support\Collection, as an example.
     */
    private static $type = 'array';

    /**
     * Returns the list of item in the configured array/collection type.
     *s
     * @return  mixed
     */
    public static function make(array $items)
    {
        $type = static::$type;

        if ($type === 'array') {
            return $items;
        }

        return new $type($items);
    }

    public static function configure(string $type): void
    {
        static::$type = $type;
    }
}
