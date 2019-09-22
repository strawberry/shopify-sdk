<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use Strawberry\Shopify\Http\Client;
use GuzzleHttp\Client as GuzzleClient;
use Strawberry\Shopify\Models\Billing\RecurringApplicationCharge;
use Strawberry\Shopify\Rest\Resources\Billing\RecurringApplicationChargeResource;
use Strawberry\Shopify\Tests\Concerns\MocksRequests;
use Strawberry\Shopify\Tests\TestCase;

final class RecurringApplicationChargeResourceTest extends TestCase
{
    use MocksRequests;

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
            new Response(200, [], $this->response('billing/recurring_application_charge/activate'))
        );

        $response = $this->recurringApplicationCharges->activate(
            455696195,
            $this->request('billing/recurring_application_charge/activate')
        );

        $this->assertInstanceOf(RecurringApplicationCharge::class, $response);
        $this->assertSame(455696195, $response->id);

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('recurring_application_charges/455696195/activate.json', (string) $request->getUri());
    }

    public function testCancel(): void
    {
        $this->mockHandler->append(new Response(204));

        $response = $this->recurringApplicationCharges->cancel(123456789);
        $this->assertNull($response);

        $request = $this->mockHandler->getLastRequest();
        $this->assertSame('DELETE', $request->getMethod());
        $this->assertSame('recurring_application_charges/123456789.json', (string) $request->getUri());
    }

    public function testUpdateCappedAmount(): void
    {
        $this->mockHandler->append(
            new Response(200, [], $this->response('billing/recurring_application_charge/customize'))
        );

        $response = $this->recurringApplicationCharges->updateCappedAmount(455696195, 200);

        $this->assertInstanceOf(RecurringApplicationCharge::class, $response);
        $this->assertSame(455696195, $response->id);

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame(
            'recurring_application_charges/455696195/customize.json?recurring_application_charge%5Bcapped_amount%5D=200',
            (string) $request->getUri()
        );
    }
}
