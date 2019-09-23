<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use Strawberry\Shopify\Http\Client;
use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Tests\Concerns\MocksRequests;
use Strawberry\Shopify\Tests\TestCase;

abstract class ResourceTestCase extends TestCase
{
    use MocksRequests;

    /** @var MockHandler */
    protected $mockHandler;

    /** @var Client */
    protected $client;

    /** @var Resource */
    protected $resource;

    /** @var string */
    protected $modelClass;

    /** @var string */
    protected $resourceClass;

    public function setUpTestCase(): void
    {
        $this->mockHandler = new MockHandler();
        $this->client = new Client(new GuzzleHttpClient([
            'handler' => HandlerStack::create($this->mockHandler)
        ]));

        $resourceClass = $this->resourceClass;
        $this->resource = new $resourceClass($this->client);
    }

    protected function queue(
        int $statusCode,
        array $headers = [],
        ?string $data = null
    ): void {
        $this->mockHandler->append(new Response(
            $statusCode,
            $headers,
            $data
        ));
    }

    protected function assertModel($response): void
    {
        $this->assertInstanceOf($this->modelClass, $response);
    }

    protected function assertCollection($response, int $count = 1): void
    {
        $this->assertInstanceOf(Collection::class, $response);
        $this->assertContainsOnlyInstancesOf($this->modelClass, $response);
        $this->assertCount($count, $response);
    }

    protected function assertResource($resource): void
    {
        $this->assertInstanceOf($this->resourceClass, $resource);
    }

    protected function assertRequest(string $method, string $uri): void
    {
        $request = $this->mockHandler->getLastRequest();

        $this->assertSame($method, $request->getMethod());
        $this->assertSame($uri, urldecode((string) $request->getUri()));
    }
}
