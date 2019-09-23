<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Sales;

use Strawberry\Shopify\Models\Sales\ProductListing;
use Strawberry\Shopify\Rest\Resources\Sales\ProductListingResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class ProductListingResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = ProductListing::class;

    /** @var string */
    protected $resourceClass = ProductListingResource::class;

    /** @var string */
    protected $dataPath = 'sales/product_listing';
}
