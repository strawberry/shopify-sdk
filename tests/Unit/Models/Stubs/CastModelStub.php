<?php

namespace Strawberry\Shopify\Tests\Unit\Models\Stubs;

use Strawberry\Shopify\Models\Model;

final class CastModelStub extends Model
{
    protected $casts = [
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
}
