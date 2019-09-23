<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Products;

use Strawberry\Shopify\Models\Products\Product;
use Strawberry\Shopify\Rest\Resources\Products\ProductResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class ProductResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Product::class;

    /** @var string */
    protected $resourceClass = ProductResource::class;

    /** @var string */
    protected $dataPath = 'products/product';
}
