<?php

namespace Strawberry\Shopify\Tests\Unit\Models\Stubs;

use Strawberry\Shopify\Models\Model;

final class ModelStub extends Model
{
    /** @var array */
    protected $casts = [
        'model' => ModelStub::class,
        'foo' => '\\This\\Is\\Not\\A\\Model',
    ];

    /** @var array */
    protected $castArrays = [
        'array' => ModelStub::class,
        'bar' => '\\This\\Is\\Not\\A\\Model'
    ];

    public function getTestMutatorAttribute(): string
    {
        return 'Hello, world!';
    }
}
