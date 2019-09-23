<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Inventory;

use Strawberry\Shopify\Models\Inventory\Location;
use Strawberry\Shopify\Rest\Resources\Inventory\LocationResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class LocationResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Location::class;

    /** @var string */
    protected $resourceClass = LocationResource::class;

    /** @var string */
    protected $dataPath = 'inventory/location';
}
