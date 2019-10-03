<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Customers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Customers\Customer;
use Strawberry\Shopify\Models\Customers\Invitation;
use Strawberry\Shopify\Models\Orders\Order;
use Strawberry\Shopify\Rest\Resources\Customers\AddressResource;
use Strawberry\Shopify\Rest\Resources\Customers\CustomerResource;
use Strawberry\Shopify\Rest\Resources\Misc\MetafieldResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class CustomerResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Customer::class;

    /** @var string */
    protected $resourceClass = CustomerResource::class;

    /** @var string */
    protected $dataPath = 'customers/customer';

    public function testChildren(): void
    {
        $this->assertTrue($this->resource->hasChildren());
        $this->assertChild('addresses', AddressResource::class);
        $this->assertChild('metafields', MetafieldResource::class);
    }

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'customers.json');
        $this->assertCollection($response);
    }

    public function testSearch(): void
    {
        $this->queue(200, [], $this->response('search'));

        $response = $this->resource->search('Bob country:United States');

        $this->assertRequest('GET', 'customers/search.json?query=Bob country:United States');
        $this->assertCollection($response);
    }

    public function testSearchWithOptions(): void
    {
        $this->queue(200, [], $this->response('search'));

        $response = $this->resource->search('Bob country:United States', [
            'order' => 'last_order_date DESC',
        ]);

        $this->assertRequest('GET', 'customers/search.json?order=last_order_date DESC&query=Bob country:United States');
        $this->assertCollection($response);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(207119551);

        $this->assertRequest('GET', 'customers/207119551.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('customer');
        $this->assertRequest('POST', 'customers.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(200, [], $this->response('update'));

        $response = $this->resource->update(207119551, $this->request('update'));

        $this->assertPostKey('customer');
        $this->assertRequest('PUT', 'customers/207119551.json');
        $this->assertModel($response);
    }

    public function testCreateActivationUrl(): void
    {
        $this->queue(200, [], $this->response('create_activation_url'));

        $response = $this->resource->createActivationUrl(207119551);

        $this->assertRequest('POST', 'customers/207119551/account_activation_url.json');
        $this->assertSame(
            'https://apple.myshopify.com/account/activate/207119551/8f50025ea369d30a68328a8e64c8c90b-1565369023',
            $response
        );
    }

    public function testSendInvite(): void
    {
        $this->queue(201, [], $this->response('send_invite'));

        $response = $this->resource->sendInvite(123456789);

        $this->assertPostKey('customer_invite');
        $this->assertRequest('POST', 'customers/123456789/send_invite.json');
        $this->assertInstanceOf(Invitation::class, $response);
        $this->assertSame('bob.norman@hostmail.com', $response->to);
    }

    public function testSendInviteWithCustomisation(): void
    {
        $this->queue(201, [], $this->response('send_invite_with_customisation'));

        $response = $this->resource->sendInvite(
            123456789,
            $this->request('send_invite_with_customisation')
        );

        $this->assertPostKey('customer_invite');
        $this->assertRequest('POST', 'customers/123456789/send_invite.json');
        $this->assertInstanceOf(Invitation::class, $response);
        $this->assertSame('new_test_email@shopify.com', $response->to);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(123456789);

        $this->assertRequest('DELETE', 'customers/123456789.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'customers/count.json');
        $this->assertSame(12345, $response);
    }

    public function testOrders(): void
    {
        $this->queue(201, [], $this->response('orders'));

        $response = $this->resource->orders(123456789);

        $this->assertRequest('GET', 'customers/123456789/orders.json');
        $this->assertIsArray($response);
        $this->assertContainsOnlyInstancesOf(Order::class, $response);
    }
}
