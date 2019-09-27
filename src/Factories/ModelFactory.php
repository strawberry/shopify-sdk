<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Factories;

use Illuminate\Contracts\Support\Arrayable;
use Strawberry\Shopify\Models\Model;

final class ModelFactory
{
    /**
     * Model map configuration.
     *
     * @var string[]
     */
    private static $map = [];

    /**
     * Return a model instance with the supplied data. If a mapping
     * exists for the given model class, then an instance of the
     * mapped model will be returned instead.
     *
     * @param  Arrayable|array  $data
     */
    public static function make(string $model, $data): Model
    {
        $model = static::getMapping($model);

        return new $model($data);
    }

    public static function getMapping(string $model): string
    {
        return static::$map[$model] ?? $model;
    }

    public static function configure(array $config): void
    {
        static::$map = $config;
    }
}
