<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Store;

use Strawberry\Shopify\Models\Store\Province;
use Strawberry\Shopify\Rest\Resources\Store\CountryResource;
use Strawberry\Shopify\Rest\Resources\Store\ProvinceResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ChildResourceTestCase;

final class ProvinceResourceTest extends ChildResourceTestCase
{
    /** @var string */
    protected $modelClass = Province::class;

    /** @var array */
    protected $parentResources = [
        [CountryResource::class, 879921427],
    ];

    /** @var string */
    protected $resourceClass = ProvinceResource::class;

    /** @var string */
    protected $dataPath = 'store/province';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'countries/879921427/provinces.json');
        $this->assertCollection($response, 13);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(224293623);

        $this->assertRequest('GET', 'countries/879921427/provinces/224293623.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(200, [], $this->response('update'));

        $response = $this->resource->update(
            224293623,
            $this->request('update')
        );

        $this->assertPostKey('province');
        $this->assertRequest('PUT', 'countries/879921427/provinces/224293623.json');
        $this->assertModel($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'countries/879921427/provinces/count.json');
        $this->assertSame(13, $response);
    }
}
