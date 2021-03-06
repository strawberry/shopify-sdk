<?php

namespace Strawberry\Shopify\Tests\Unit\Rest;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Strawberry\Shopify\Exceptions\SdkException;
use Strawberry\Shopify\Factories\CollectionFactory;
use Strawberry\Shopify\Factories\ModelFactory;
use Strawberry\Shopify\Http\Client;
use Strawberry\Shopify\Models\Store\Shop;
use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Tests\Stubs\Models\ModelStub;
use Strawberry\Shopify\Tests\Stubs\Resources\ChildResourceStub;
use Strawberry\Shopify\Tests\Stubs\Resources\ResourceStub;
use Strawberry\Shopify\Tests\Stubs\Resources\ResourceWithChildrenStub;
use Strawberry\Shopify\Tests\TestCase;


final class ResourceTest extends TestCase
{
    /** @var MockHandler */
    private $mockHandler;

    /** @var Resource */
    private $resource;

    /** @var Resource */
    private $resourceWithChildren;

    public function setUpTestCase(): void
    {
        $this->mockHandler = new MockHandler();
        $client = new Client(new GuzzleClient([
            'handler' => HandlerStack::create($this->mockHandler)
        ]));

        $this->resource = new ResourceStub($client);
        $this->resourceWithChildren = new ResourceWithChildrenStub($client);
    }

    public function testCountResource(): void
    {
        $this->mockHandler->append(new Response(
            200, [], '{"count":12345}'
        ));

        $response = $this->resource->count(['test' => 'query']);
        $this->assertSame(12345, $response);

        $request = $this->mockHandler->getLastRequest();
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('model_stubs/count.json?test=query', (string) $request->getUri());
    }

    public function testCreateResource(): void
    {
        $this->mockHandler->append(new Response(
            201, [], '{"model_stub":{"foo":"bar"}}'
        ));

        $response = $this->resource->create(['foo' => 'bar']);
        $this->assertInstanceOf(ModelStub::class, $response);
        $this->assertSame('bar', $response->foo);

        $request = $this->mockHandler->getLastRequest();
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('model_stubs.json', (string) $request->getUri());
        $this->assertSame('{"model_stub":{"foo":"bar"}}', $request->getBody()->getContents());
    }

    public function testDeleteResource(): void
    {
        $this->mockHandler->append(new Response(204));

        $response = $this->resource->delete(123456789);
        $this->assertNull($response);

        $request = $this->mockHandler->getLastRequest();
        $this->assertSame('DELETE', $request->getMethod());
        $this->assertSame('model_stubs/123456789.json', (string) $request->getUri());
    }

    public function testFindResource(): void
    {
        $this->mockHandler->append(new Response(
            200, [], '{"model_stub":{"foo":"bar"}}'
        ));

        $response = $this->resource->find(123456789, ['query' => 'string']);
        $this->assertInstanceOf(ModelStub::class, $response);
        $this->assertSame('bar', $response->foo);

        $request = $this->mockHandler->getLastRequest();
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('model_stubs/123456789.json?query=string', (string) $request->getUri());
        $this->assertSame('', $request->getBody()->getContents());
    }

    public function testListResource(): void
    {
        $this->mockHandler->append(new Response(
            200, [], '{"model_stubs":[{"foo":"bar"}, {"foo":"baz"}]}'
        ));

        $response = $this->resource->get(['query' => 'string']);
        $this->assertIsArray($response);
        $this->assertCount(2, $response);
        $this->assertContainsOnlyInstancesOf(ModelStub::class, $response);

        $request = $this->mockHandler->getLastRequest();
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('model_stubs.json?query=string', (string) $request->getUri());
        $this->assertSame('', $request->getBody()->getContents());
    }

    public function testUpdateResource(): void
    {
        $this->mockHandler->append(new Response(
            200, [], '{"model_stub":{"foo": "bar"}}'
        ));

        $response = $this->resource->update(123456789, ['foo' => 'bar']);
        $this->assertInstanceOf(ModelStub::class, $response);
        $this->assertSame('bar', $response->foo);

        $request = $this->mockHandler->getLastRequest();
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('model_stubs/123456789.json', (string) $request->getUri());
        $this->assertSame('{"model_stub":{"foo":"bar"}}', $request->getBody()->getContents());
    }

    public function testGetChildren(): void
    {
        $this->assertFalse($this->resource->hasChildren());

        $this->assertTrue($this->resourceWithChildren->hasChildren());
    }

    public function testPrepareJsonWithArrayable(): void
    {
        $this->mockHandler->append(new Response(
            201, [], '{"model_stub":{"foo":"bar"}}'
        ));

        $arrayable = new class implements Arrayable {
            public function toArray(): array
            {
                return ['foo' => 'bar'];
            }
        };

        $this->resource->create($arrayable);

        $request = $this->mockHandler->getLastRequest();
        $this->assertSame('{"model_stub":{"foo":"bar"}}', $request->getBody()->getContents());
    }

    public function testHasChild(): void
    {
        $this->assertFalse($this->resource->hasChild('foo'));

        $this->assertTrue($this->resourceWithChildren->hasChild('child'));
        $this->assertFalse($this->resourceWithChildren->hasChild('foo'));
    }

    public function testGetChildThrowsException(): void
    {
        $this->expectException(SdkException::class);

        $this->resource->getChild('foo', 123456789);
    }

    public function testGetChild(): void
    {
        $child = $this->resourceWithChildren->getChild('child', 123456789);

        $this->assertInstanceOf(ChildResourceStub::class, $child);
    }

    public function testReturnsMappedModels(): void
    {
        $this->mockHandler->append(new Response(
            200, [], '{"model_stub":{"foo":"bar"}}'
        ));

        ModelFactory::configure([ModelStub::class => Shop::class]);

        $response = $this->resource->find(1);

        $this->assertInstanceOf(Shop::class, $response);

        ModelFactory::configure([]);
    }

    public function testReturnsMappedCollections(): void
    {
        $this->mockHandler->append(new Response(
            200, [], '{"model_stubs":[{"foo":"bar"},{"baz":"qux"}]}'
        ));

        ModelFactory::configure([ModelStub::class => Shop::class]);

        $response = $this->resource->get();

        $this->assertContainsOnlyInstancesOf(Shop::class, $response);

        ModelFactory::configure([]);
    }

    public function testToCollectionReturnsArrayByDefault(): void
    {
        $this->mockHandler->append(new Response(
            200, [], '{"model_stubs":[]}'
        ));

        $response = $this->resource->get();

        $this->assertIsArray($response);
    }

    public function testToCollectionReturnsConfiguredType(): void
    {
        $this->mockHandler->append(new Response(
            200, [], '{"model_stubs":[]}'
        ));

        CollectionFactory::configure(Collection::class);

        $response = $this->resource->get();

        $this->assertInstanceOf(Collection::class, $response);

        CollectionFactory::configure('array');
    }
}
