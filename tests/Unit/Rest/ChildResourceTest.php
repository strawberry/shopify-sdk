<?php

namespace Strawberry\Shopify\Tests\Unit\Rest;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use Strawberry\Shopify\Http\Client;
use GuzzleHttp\Client as GuzzleClient;
use Strawberry\Shopify\Tests\TestCase;
use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Tests\Stubs\Resources\ChildResourceStub;
use Strawberry\Shopify\Tests\Stubs\Resources\ResourceStub;

final class ChildResourceTest extends TestCase
{
    /** @var MockHandler */
    private $mockHandler;

    /** @var ChildResource */
    private $resource;

    public function setUpTestCase(): void
    {
        $this->mockHandler = new MockHandler();
        $client = new Client(new GuzzleClient([
            'handler' => HandlerStack::create($this->mockHandler)
        ]));

        $parent = new  ResourceStub($client);
        $this->resource = new ChildResourceStub($client, $parent, 123456789);
    }

    public function testUri(): void
    {
        $this->mockHandler->append(new Response(
            201, [], '{"model_stub":{"foo":"bar"}}'
        ));

        $this->resource->create(['foo' => 'bar']);

        $request = $this->mockHandler->getLastRequest();
        $this->assertSame('model_stubs/123456789/model_stubs.json', (string) $request->getUri());
    }
}
