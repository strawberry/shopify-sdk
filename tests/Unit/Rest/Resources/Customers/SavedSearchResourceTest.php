<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Customers;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Customers\Customer;
use Strawberry\Shopify\Models\Customers\SavedSearch;
use Strawberry\Shopify\Rest\Resources\Customers\SavedSearchResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class SavedSearchResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = SavedSearch::class;

    /** @var string */
    protected $resourceClass = SavedSearchResource::class;

    /** @var string */
    protected $dataPath = 'customers/saved_search';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'customer_saved_searches.json');
        $this->assertCollection($response, 3);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'customer_saved_searches/count.json');
        $this->assertSame(3, $response);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(789629109);

        $this->assertRequest('GET', 'customer_saved_searches/789629109.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('customer_saved_search');
        $this->assertRequest('POST', 'customer_saved_searches.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(200, [], $this->response('update'));

        $response = $this->resource->update(
            789629109,
            $this->request('update')
        );

        $this->assertPostKey('customer_saved_search');
        $this->assertRequest('PUT', 'customer_saved_searches/789629109.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(789629109);

        $this->assertRequest('DELETE', 'customer_saved_searches/789629109.json');
        $this->assertNull($response);
    }

    public function testRun(): void
    {
        $this->queue(200, [], $this->response('run'));

        $response = $this->resource->run(123456789);

        $this->assertRequest('GET', 'customer_saved_searches/123456789/customers.json');
        $this->assertInstanceOf(Collection::class, $response);
        $this->assertContainsOnlyInstancesOf(Customer::class, $response);
    }
}
