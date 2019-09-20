<?php

namespace Strawberry\Shopify\Tests\Unit\Rest;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Http\Client;
use Strawberry\Shopify\Models\Model;
use Strawberry\Shopify\Http\Response;
use Strawberry\Shopify\Rest\Resource;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Contracts\Support\Arrayable;
use Strawberry\Shopify\Tests\TestCase;
use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Exceptions\ClientException;

final class ResourceTest extends TestCase
{
    /** @test */
    public function it_transforms_response_to_model(): void
    {
        $model = $this->resource()->find();

        $this->assertInstanceOf(ResourceTestModelStub::class, $model);
        $this->assertEquals('Foo', $model->first_name);
        $this->assertEquals('Bar', $model->last_name);
    }

    /** @test */
    public function it_transforms_response_to_collection(): void
    {
        $collection = $this->resource()->get();

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertCount(2, $collection);
    }

    private function resource(): Resource
    {
        $guzzleClient = $this->mock(GuzzleClient::class);
        $client = new Client($guzzleClient);

        return new ResourceTestResourceStub($client);
    }

    /** @test */
    public function it_builds_uri_correctly(): void
    {
        $guzzle = $this->mock(GuzzleClient::class);
        $client = new Client($guzzle);
        $resource = new ResourceTestResourceStub($client);

        $this->assertSame('resource_test_model_stubs/test.json', $resource->buildUri('test'));
        $this->assertSame('resource_test_model_stubs/test.json', $resource->buildUri('/test'));
        $this->assertSame('resource_test_model_stubs/uri/with/multiple/directories.json', $resource->buildUri('/uri/with/multiple/directories'));
    }

    /** @test */
    public function it_prepares_json_correctly(): void
    {
        $guzzle = $this->mock(GuzzleClient::class);
        $client = new Client($guzzle);
        $resource = new ResourceTestResourceStub($client);

        $arrayable = new class implements Arrayable {
            public function toArray(): array {
                return ['bar' => 'baz'];
            }
        };

        $this->assertSame(['foo' => ['bar' => 'baz']], $resource->getPreparedJson(['bar' => 'baz'], 'foo'));
        $this->assertSame(['foo' => ['bar' => 'baz']], $resource->getPreparedJson($arrayable, 'foo'));
    }

    /** @test */
    public function it_determines_whether_it_has_children(): void
    {
        $guzzle = $this->mock(GuzzleClient::class);
        $client = new Client($guzzle);

        $resourceWithoutChildren = new ResourceTestResourceStub($client);
        $resourceWithChildren = new ResourceTestResourceWithChildrenStub($client);

        $this->assertFalse($resourceWithoutChildren->hasChildren());
        $this->assertTrue($resourceWithChildren->hasChildren());
    }

    /** @test */
    public function it_determines_whether_it_has_a_given_child(): void
    {
        $guzzle = $this->mock(GuzzleClient::class);
        $client = new Client($guzzle);
        $resource = new ResourceTestResourceWithChildrenStub($client);

        $this->assertTrue($resource->hasChild('foo'));
        $this->assertFalse($resource->hasChild('bar'));
    }

    /** @test */
    public function it_throws_an_exception_when_getting_instance_of_nonexistent_child(): void
    {
        $this->expectException(ClientException::class);

        $guzzle = $this->mock(GuzzleClient::class);
        $client = new Client($guzzle);
        $resource = new ResourceTestResourceWithChildrenStub($client);

        $resource->getChild('bar');
    }

    /** @test */
    public function it_returns_instance_of_given_child(): void
    {
        $guzzle = $this->mock(GuzzleClient::class);
        $client = new Client($guzzle);
        $resource = new ResourceTestResourceWithChildrenStub($client);

        $this->assertInstanceOf(ResourceTestChildResourceStub::class, $resource->getChild('foo'));
    }
}

final class ResourceTestResourceStub extends Resource
{
    protected $model = ResourceTestModelStub::class;

    public function find(): Model
    {
        $response = new Response(json_encode([
            'resource_test_model_stub' => [
                'first_name' => 'Foo',
                'last_name' => 'Bar',
            ]
        ]), 200);

        return $this->toModel($response);
    }

    public function get(): Collection
    {
        $response = new Response(json_encode([
            'resource_test_model_stubs' => [
                ['first_name' => 'Foo', 'last_name' => 'Bar'],
                ['first_name' => 'Baz', 'last_name' => 'Qux'],
            ]
        ]), 200);

        return $this->toCollection($response);
    }

    public function buildUri(string $uri): string
    {
        return $this->uri($uri);
    }

    public function getPreparedJson($data, string $key): array
    {
        return $this->prepareJson($data, $key);
    }
}

final class ResourceTestChildResourceStub extends ChildResource
{
    protected $model = ResourceTestModelStub::class;
    protected $parent = ResourceTestResourceStub::class;
}

final class ResourceTestResourceWithChildrenStub extends Resource
{
    protected $childResources = [
        'foo' => ResourceTestChildResourceStub::class,
    ];
}

final class ResourceTestModelStub extends Model
{
}
