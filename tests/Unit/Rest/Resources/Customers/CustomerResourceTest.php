<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Customers;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use GuzzleHttp\Handler\MockHandler;
use Strawberry\Shopify\Http\Client;
use GuzzleHttp\Client as GuzzleClient;
use Strawberry\Shopify\Tests\TestCase;
use Strawberry\Shopify\Models\Orders\Order;
use Strawberry\Shopify\Models\Customers\Customer;
use Strawberry\Shopify\Models\Customers\Invitation;
use Strawberry\Shopify\Tests\Concerns\MocksRequests;
use Strawberry\Shopify\Rest\Resources\Customers\AddressResource;
use Strawberry\Shopify\Rest\Resources\Customers\CustomerResource;

final class CustomerResourceTest extends TestCase
{
    use MocksRequests;

    /** @var MockHandler */
    private $mockHandler;

    /** @var CustomerResource */
    private $resource;

    public function setUpTestCase(): void
    {
        $this->mockHandler = new MockHandler();
        $client = new Client(new GuzzleClient([
            'handler' => HandlerStack::create($this->mockHandler)
        ]));

        $this->resource = new CustomerResource($client);
    }

    public function testChildren(): void
    {
        $this->assertTrue($this->resource->hasChildren());
        $this->assertTrue($this->resource->hasChild('addresses'));
        $this->assertInstanceOf(AddressResource::class, $this->resource->getChild('addresses'));
    }

    public function testSearch(): void
    {
        $this->mockHandler->append(new Response(
            200, [], $this->response('customers/customers/search')
        ));

        $response = $this->resource->search('Bob country:United States');

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(1, $response);
        $this->assertContainsOnlyInstancesOf(Customer::class, $response);

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame(
            'customers/search.json?query=Bob country:United States',
            urldecode((string) $request->getUri())
        );
    }

    public function testSearchWithOptions(): void
    {
        $this->mockHandler->append(new Response(
            200, [], $this->response('customers/customers/search')
        ));

        $this->resource->search('Bob country:United States', [
            'order' => 'last_order_date DESC',
        ]);

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame(
            'customers/search.json?order=last_order_date DESC&query=Bob country:United States',
            urldecode((string) $request->getUri())
        );
    }

    public function testCreateActivationUrl(): void
    {
        $this->mockHandler->append(new Response(
            200, [], $this->response('customers/customers/create_activation_url')
        ));

        $response = $this->resource->createActivationUrl(207119551);

        $this->assertSame(
            'https://apple.myshopify.com/account/activate/207119551/8f50025ea369d30a68328a8e64c8c90b-1565369023',
            $response
        );

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame(
            'customers/207119551/account_activation_url.json',
            urldecode((string) $request->getUri())
        );
    }

    public function testSendInvite(): void
    {
        $this->mockHandler->append(new Response(
            201, [], $this->response('customers/customers/send_invite')
        ));

        $response = $this->resource->sendInvite(123456789);

        $this->assertInstanceOf(Invitation::class, $response);
        $this->assertSame('bob.norman@hostmail.com', $response->to);

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame(
            'customers/123456789/send_invite.json',
            urldecode((string) $request->getUri())
        );
    }

    public function testSendInviteWithCustomisation(): void
    {
        $this->mockHandler->append(new Response(
            201, [], $this->response('customers/customers/send_invite_with_customisation')
        ));

        $response = $this->resource->sendInvite(
            123456789,
            $this->request('customers/customers/send_invite_with_customisation')
        );

        $this->assertInstanceOf(Invitation::class, $response);
        $this->assertSame('new_test_email@shopify.com', $response->to);

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame(
            'customers/123456789/send_invite.json',
            urldecode((string) $request->getUri())
        );
    }

    public function testOrders(): void
    {
        $this->mockHandler->append(new Response(
            201, [], $this->response('customers/customers/orders')
        ));

        $response = $this->resource->orders(123456789);

        $this->assertInstanceOf(Collection::class, $response);
        $this->assertCount(1, $response);
        $this->assertContainsOnlyInstancesOf(Order::class, $response);

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame(
            'customers/123456789/orders.json',
            urldecode((string) $request->getUri())
        );
    }
}
