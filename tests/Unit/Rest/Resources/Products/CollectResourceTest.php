<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Products;

use Strawberry\Shopify\Models\Products\Collect;
use Strawberry\Shopify\Rest\Resources\Products\CollectResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class CollectResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Collect::class;

    /** @var string */
    protected $resourceClass = CollectResource::class;

    /** @var string */
    protected $dataPath = 'products/collect';
}
