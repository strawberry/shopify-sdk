<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Misc;

use Strawberry\Shopify\Models\Misc\Metafield;
use Strawberry\Shopify\Rest\Resources\Misc\MetafieldResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class MetafieldResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Metafield::class;

    /** @var string */
    protected $resourceClass = MetafieldResource::class;

    /** @var string */
    protected $dataPath = 'misc/metafield';
}
