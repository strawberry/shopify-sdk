<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Products;

use Strawberry\Shopify\Models\Products\CustomCollection;
use Strawberry\Shopify\Rest\Resources\Products\CustomCollectionResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class CustomCollectionResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = CustomCollection::class;

    /** @var string */
    protected $resourceClass = CustomCollectionResource::class;

    /** @var string */
    protected $dataPath = 'products/custom_collection';
}
