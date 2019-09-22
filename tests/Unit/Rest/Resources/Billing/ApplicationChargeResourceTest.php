<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use Strawberry\Shopify\Http\Client;
use GuzzleHttp\Client as GuzzleClient;
use Strawberry\Shopify\Tests\Concerns\MocksRequests;
use Strawberry\Shopify\Tests\TestCase;
use Strawberry\Shopify\Models\Billing\ApplicationCharge;
use Strawberry\Shopify\Rest\Resources\Billing\ApplicationChargeResource;

final class ApplicationChargeResourceTest extends TestCase
{
    use MocksRequests;

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
            new Response(200, [], $this->response('billing/application_charge/activate'))
        );

        $response = $this->applicationCharges->activate(
            675931192,
            $this->request('billing/application_charge/activate')
        );

        $this->assertInstanceOf(ApplicationCharge::class, $response);
        $this->assertSame(675931192, $response->id);

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('application_charges/675931192/activate.json', (string) $request->getUri());
    }
}
