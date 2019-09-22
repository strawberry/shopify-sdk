<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Customers;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use GuzzleHttp\Handler\MockHandler;
use Strawberry\Shopify\Http\Client;
use GuzzleHttp\Client as GuzzleClient;
use Strawberry\Shopify\Tests\TestCase;
use Strawberry\Shopify\Models\Customers\Customer;
use Strawberry\Shopify\Tests\Concerns\MocksRequests;
use Strawberry\Shopify\Rest\Resources\Customers\SavedSearchResource;

final class SavedSearchResourceTest extends TestCase
{
    use MocksRequests;

    /** @var MockHandler */
    private $mockHandler;

    /** @var SavedSearchResource */
    private $resource;

    public function setUpTestCase(): void
    {
        $this->mockHandler = new MockHandler();
        $client = new Client(new GuzzleClient([
            'handler' => HandlerStack::create($this->mockHandler)
        ]));

        $this->resource = new SavedSearchResource($client);
    }

    public function testRun(): void
    {
        $this->mockHandler->append(new Response(
            200, [], $this->response('customers/customers/run')
        ));

        $response = $this->resource->run(123456789);

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(1, $response);
        $this->assertContainsOnlyInstancesOf(Customer::class, $response);

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame(
            'customer_saved_searches/123456789/customers.json',
            urldecode((string) $request->getUri())
        );
    }
}
