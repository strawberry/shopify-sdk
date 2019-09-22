<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Customers;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use Strawberry\Shopify\Http\Client;
use GuzzleHttp\Client as GuzzleClient;
use Strawberry\Shopify\Tests\Concerns\MocksRequests;
use Strawberry\Shopify\Tests\TestCase;
use Strawberry\Shopify\Models\Customers\Address;
use Strawberry\Shopify\Rest\Resources\Customers\AddressResource;

final class AddressResourceTest extends TestCase
{
    use MocksRequests;

    /** @var MockHandler */
    private $mockHandler;

    /** @var AddressResource */
    private $resource;

    public function setUpTestCase(): void
    {
        $this->mockHandler = new MockHandler();
        $client = new Client(new GuzzleClient([
            'handler' => HandlerStack::create($this->mockHandler)
        ]));

        $this->resource = new AddressResource($client);
    }

    public function testBulk(): void
    {
        $this->mockHandler->append(new Response(200));

        $this->resource->withParent(123456789)->bulk([1053317304], 'destroy');

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame(
            'customers/123456789/addresses/set.json?address_ids%5B0%5D=1053317304&operation=destroy',
            (string) $request->getUri()
        );
    }

    public function testDeleteMultiple(): void
    {
        $this->mockHandler->append(new Response(200));

        $this->resource->withParent(123456789)->deleteMultiple([1053317304]);

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame(
            'customers/123456789/addresses/set.json?address_ids%5B0%5D=1053317304&operation=destroy',
            (string) $request->getUri()
        );
    }

    public function testDefault(): void
    {
        $this->mockHandler->append(
            new Response(200, [], $this->response('customers/addresses/default'))
        );

        $response = $this->resource->withParent(123456789)->default(1053317301);

        $this->assertInstanceOf(Address::class, $response);
        $this->assertSame(1053317301, $response->id);
        $this->assertTrue($response->default);

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame(
            'customers/123456789/addresses/1053317301/default.json',
            (string) $request->getUri()
        );
    }
}
