<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Inventory;

use Strawberry\Shopify\Models\Inventory\InventoryLevel;
use Strawberry\Shopify\Rest\Resources\Inventory\InventoryLevelResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class InventoryLevelResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = InventoryLevel::class;

    /** @var string */
    protected $resourceClass = InventoryLevelResource::class;

    /** @var string */
    protected $dataPath = 'inventory/inventory_level';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get([
            'inventory_item_ids' => '808950810,39072856',
            'location_ids' => '905684977,487838322'
        ]);

        $this->assertRequest('GET', 'inventory_levels.json?inventory_item_ids=808950810,39072856&location_ids=905684977,487838322');
        $this->assertCollection($response, 4);
    }

    public function testAdjust(): void
    {
        $this->queue(200, [], $this->response('adjust'));

        $response = $this->resource->adjust(808950810, 905684977, 5);

        $this->assertRequest('POST', 'inventory_levels/adjust.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(808950810, 905684977);

        $this->assertRequest('DELETE', 'inventory_levels.json?inventory_item_id=808950810&location_id=905684977');
        $this->assertNull($response);
    }

    public function testConnect(): void
    {
        $this->queue(200, [], $this->response('connect'));

        $response = $this->resource->connect(192722535, 457924702);

        $this->assertRequest('POST', 'inventory_levels/connect.json');
        $this->assertModel($response);
    }

    public function testSet(): void
    {
        $this->queue(200, [], $this->response('set'));

        $response = $this->resource->set(905684977, 808950810, 42);

        $this->assertRequest('POST', 'inventory_levels/set.json');
        $this->assertModel($response);
    }
}
