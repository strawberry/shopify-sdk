<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Store;

use Strawberry\Shopify\Models\Store\Country;
use Strawberry\Shopify\Rest\Resources\Store\CountryResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class CountryResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Country::class;

    /** @var string */
    protected $resourceClass = CountryResource::class;

    /** @var string */
    protected $dataPath = 'store/country';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'countries.json');
        $this->assertCollection($response, 2);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(48394658);

        $this->assertRequest('GET', 'countries/48394658.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'countries.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(201, [], $this->response('update'));

        $response = $this->resource->update(
            48394658,
            $this->request('update')
        );

        $this->assertRequest('PUT', 'countries/48394658.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(48394658);

        $this->assertRequest('DELETE', 'countries/48394658.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'countries/count.json');
        $this->assertSame(3, $response);
    }
}
