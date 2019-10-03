<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Inventory;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Inventory\InventoryLevel;
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

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'locations.json');
        $this->assertCollection($response, 5);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(487838322);

        $this->assertRequest('GET', 'locations/487838322.json');
        $this->assertModel($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'locations/count.json');
        $this->assertSame(5, $response);
    }

    public function testInventoryLevels(): void
    {
        $this->queue(200, [], $this->response('inventory_levels'));

        $response = $this->resource->inventoryLevels(487838322);

        $this->assertRequest('GET', 'locations/487838322/inventory_levels.json');
        $this->assertIsArray($response);
        $this->assertContainsOnlyInstancesOf(InventoryLevel::class, $response);
    }
}
