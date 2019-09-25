<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Customers;

use Strawberry\Shopify\Models\Customers\Address;
use Strawberry\Shopify\Rest\Resources\Customers\AddressResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class AddressResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Address::class;

    /** @var string */
    protected $resourceClass = AddressResource::class;

    /** @var string */
    protected $dataPath = 'customers/address';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->withParent(123456789)->get();

        $this->assertRequest('GET', 'customers/123456789/addresses.json');
        $this->assertCollection($response);
    }

    public function testGetWithOptions(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->withParent(123456789)->get([
            'limit' => 1,
            'page' => 1,
        ]);

        $this->assertRequest('GET', 'customers/123456789/addresses.json?limit=1&page=1');
        $this->assertCollection($response);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->withParent(123456789)->find(207119551);

        $this->assertRequest('GET', 'customers/123456789/addresses/207119551.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->withParent(123456789)->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'customers/123456789/addresses.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(200, [], $this->response('update'));

        $response = $this->resource->withParent(123456789)->update(
            207119551,
            $this->request('update')
        );

        $this->assertRequest('PUT', 'customers/123456789/addresses/207119551.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->withParent(123456789)->delete(207119551);

        $this->assertRequest('DELETE', 'customers/123456789/addresses/207119551.json');
        $this->assertNull($response);
    }

    public function testBulk(): void
    {
        $this->queue(200);

        $this->resource->withParent(123456789)->bulk([1053317304], 'destroy');

        $this->assertRequest('PUT', 'customers/123456789/addresses/set.json?address_ids[0]=1053317304&operation=destroy');
    }

    public function testDeleteMultiple(): void
    {
        $this->queue(200);

        $this->resource->withParent(123456789)->deleteMultiple([1053317304]);

        $this->assertRequest('PUT', 'customers/123456789/addresses/set.json?address_ids[0]=1053317304&operation=destroy');
    }

    public function testDefault(): void
    {
        $this->queue(200, [], $this->response('default'));

        $response = $this->resource->withParent(123456789)->default(1053317301);

        $this->assertRequest('PUT', 'customers/123456789/addresses/1053317301/default.json');
        $this->assertModel($response);
    }
}
