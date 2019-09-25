<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Customers;

use Strawberry\Shopify\Models\Customers\Address;
use Strawberry\Shopify\Rest\Resources\Customers\AddressResource;
use Strawberry\Shopify\Rest\Resources\Customers\CustomerResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ChildResourceTestCase;

final class AddressResourceTest extends ChildResourceTestCase
{
    /** @var string */
    protected $modelClass = Address::class;

    /** @var array */
    protected $parentResources = [
        [CustomerResource::class, 1053317301],
    ];

    /** @var string */
    protected $resourceClass = AddressResource::class;

    /** @var string */
    protected $dataPath = 'customers/address';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'customers/1053317301/addresses.json');
        $this->assertCollection($response);
    }

    public function testGetWithOptions(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get([
            'limit' => 1,
            'page' => 1,
        ]);

        $this->assertRequest('GET', 'customers/1053317301/addresses.json?limit=1&page=1');
        $this->assertCollection($response);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(207119551);

        $this->assertRequest('GET', 'customers/1053317301/addresses/207119551.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'customers/1053317301/addresses.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(200, [], $this->response('update'));

        $response = $this->resource->update(
            207119551,
            $this->request('update')
        );

        $this->assertRequest('PUT', 'customers/1053317301/addresses/207119551.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(207119551);

        $this->assertRequest('DELETE', 'customers/1053317301/addresses/207119551.json');
        $this->assertNull($response);
    }

    public function testBulk(): void
    {
        $this->queue(200);

        $this->resource->bulk([1053317304], 'destroy');

        $this->assertRequest('PUT', 'customers/1053317301/addresses/set.json?address_ids[0]=1053317304&operation=destroy');
    }

    public function testDeleteMultiple(): void
    {
        $this->queue(200);

        $this->resource->deleteMultiple([1053317304]);

        $this->assertRequest('PUT', 'customers/1053317301/addresses/set.json?address_ids[0]=1053317304&operation=destroy');
    }

    public function testDefault(): void
    {
        $this->queue(200, [], $this->response('default'));

        $response = $this->resource->default(1053317301);

        $this->assertRequest('PUT', 'customers/1053317301/addresses/1053317301/default.json');
        $this->assertModel($response);
    }
}
