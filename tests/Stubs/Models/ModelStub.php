<?php

namespace Strawberry\Shopify\Tests\Stubs\Models;

use Strawberry\Shopify\Models\Model;

final class ModelStub extends Model
{
    /** @var array */
    protected $casts = [
        'model' => ModelStub::class,
        'foo' => '\\This\\Is\\Not\\A\\Model',
        'int' => 'int',
        'integer' => 'integer',
        'real' => 'real',
        'float' => 'float',
        'double' => 'double',
        'string' => 'string',
        'bool' => 'bool',
        'boolean' => 'boolean',
        'object' => 'object',
        'array' => 'array',
        'json' => 'json',
        'collection' => 'collection',
        'default' => 'default',
    ];

    /** @var array */
    protected $castArrays = [
        'array_model' => ModelStub::class,
        'array_foo' => '\\This\\Is\\Not\\A\\Model'
    ];

    public function getTestMutatorAttribute(): string
    {
        return 'Hello, world!';
    }
}
