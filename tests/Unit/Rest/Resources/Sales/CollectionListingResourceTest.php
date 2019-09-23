<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Sales;

use Strawberry\Shopify\Models\Sales\CollectionListing;
use Strawberry\Shopify\Rest\Resources\Sales\CollectionListingResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class CollectionListingResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = CollectionListing::class;

    /** @var string */
    protected $resourceClass = CollectionListingResource::class;

    /** @var string */
    protected $dataPath = 'sales/collection_listing';
}
