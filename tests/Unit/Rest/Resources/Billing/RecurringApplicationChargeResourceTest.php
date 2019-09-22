<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use Strawberry\Shopify\Http\Client;
use GuzzleHttp\Client as GuzzleClient;
use Strawberry\Shopify\Models\Billing\RecurringApplicationCharge;
use Strawberry\Shopify\Tests\TestCase;
use Strawberry\Shopify\Rest\Resources\Billing\RecurringApplicationChargeResource;

final class RecurringApplicationChargeResourceTest extends TestCase
{
    /** @var MockHandler */
    private $mockHandler;

    /** @var RecurringApplicationChargeResource */
    private $recurringApplicationCharges;

    public function setUpTestCase(): void
    {
        $this->mockHandler = new MockHandler();
        $client = new Client(new GuzzleClient([
            'handler' => HandlerStack::create($this->mockHandler)
        ]));

        $this->recurringApplicationCharges = new RecurringApplicationChargeResource($client);
    }

    public function testActivate(): void
    {
        $this->mockHandler->append(
            new Response(200, [], $this->data('data/responses/billing/recurring_application_charge/activate.json'))
        );

        $response = $this->recurringApplicationCharges->activate(455696195, [
            'id' => 455696195,
            'name' => 'Super Mega Plan',
            'api_client_id' => 755357713,
            'price' => '15.00',
            'status' => 'accepted',
            'return_url' => 'http://yourapp.com',
            'billing_on' => '2019-07-22',
            'created_at' => '2019-07-22T11:27:39-04:00',
            'updated_at' => '2019-07-21T20:00:00-04:00',
            'test' => null,
            'activated_on' => null,
            'cancelled_on' => null,
            'trial_days' => 0,
            'trial_ends_on' => null,
            'decorated_return_url' => 'http://yourapp.com?charge_id=455696195'
        ]);

        $this->assertInstanceOf(RecurringApplicationCharge::class, $response);
        $this->assertSame(455696195, $response->id);

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('recurring_application_charges/455696195/activate.json', (string) $request->getUri());
    }

    public function testCancel(): void
    {
        $this->mockHandler->append(new Response(204));

        $response = $this->recurringApplicationCharges->delete(123456789);
        $this->assertNull($response);

        $request = $this->mockHandler->getLastRequest();
        $this->assertSame('DELETE', $request->getMethod());
        $this->assertSame('recurring_application_charges/123456789.json', (string) $request->getUri());
    }
}
