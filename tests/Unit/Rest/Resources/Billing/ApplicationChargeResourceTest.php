<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use Strawberry\Shopify\Http\Client;
use GuzzleHttp\Client as GuzzleClient;
use Strawberry\Shopify\Models\Billing\ApplicationCharge;
use Strawberry\Shopify\Tests\TestCase;
use Strawberry\Shopify\Rest\Resources\Billing\ApplicationChargeResource;

final class ApplicationChargeResourceTest extends TestCase
{
    /** @var MockHandler */
    private $mockHandler;

    /** @var ApplicationChargeResource */
    private $applicationCharges;

    public function setUpTestCase(): void
    {
        $this->mockHandler = new MockHandler();
        $client = new Client(new GuzzleClient([
            'handler' => HandlerStack::create($this->mockHandler)
        ]));

        $this->applicationCharges = new ApplicationChargeResource($client);
    }

    public function testActivate(): void
    {
        $this->mockHandler->append(
            new Response(200, [], $this->data('data/responses/billing/application_charge/activate.json'))
        );

        $response = $this->applicationCharges->activate(675931192, [
            'id' => 675931192,
            'name' => 'iPod Cleaning',
            'api_client_id' => 755357713,
            'price' => '5.00',
            'status' => 'active',
            'return_url' => 'http://google.com/',
            'test' => null,
            'created_at' => '2019-07-22T11:27:39-04:00',
            'updated_at' => '2019-07-22T11:41:28-04:00',
            'charge_type' => null,
            'decorated_return_url' => 'http://google.com/?charge_id=675931192'
        ]);

        $this->assertInstanceOf(ApplicationCharge::class, $response);
        $this->assertSame(675931192, $response->id);

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('application_charges/675931192/activate.json', (string) $request->getUri());
    }
}
