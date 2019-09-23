<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Products;

use Strawberry\Shopify\Models\Products\SmartCollection;
use Strawberry\Shopify\Rest\Resources\Products\SmartCollectionResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class SmartCollectionResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = SmartCollection::class;

    /** @var string */
    protected $resourceClass = SmartCollectionResource::class;

    /** @var string */
    protected $dataPath = 'products/smart_collection';
}
