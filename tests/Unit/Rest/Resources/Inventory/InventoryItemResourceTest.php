<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Inventory;

use Strawberry\Shopify\Models\Inventory\InventoryItem;
use Strawberry\Shopify\Rest\Resources\Inventory\InventoryItemResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class InventoryItemResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = InventoryItem::class;

    /** @var string */
    protected $resourceClass = InventoryItemResource::class;

    /** @var string */
    protected $dataPath = 'inventory/inventory_item';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get([
            'ids' => '808950810,39072856,457924702'
        ]);

        $this->assertRequest('GET', 'inventory_items.json?ids=808950810,39072856,457924702');
        $this->assertCollection($response, 3);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(808950810);

        $this->assertRequest('GET', 'inventory_items/808950810.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(200, [], $this->response('update'));

        $response = $this->resource->update(
            808950810,
            $this->request('update')
        );

        $this->assertPostKey('inventory_item');
        $this->assertRequest('PUT', 'inventory_items/808950810.json');
        $this->assertModel($response);
    }
}
