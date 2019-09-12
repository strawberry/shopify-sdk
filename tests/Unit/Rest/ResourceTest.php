<?php

namespace Strawberry\Shopify\Tests\Unit\Rest;

use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use Illuminate\Support\Collection;
use Strawberry\Shopify\Http\Client;
use Strawberry\Shopify\Models\Model;
use Strawberry\Shopify\Http\Response;
use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Tests\TestCase;
use GuzzleHttp\Client as GuzzleClient;

final class ResourceTest extends TestCase
{
    /** @test */
    public function it_transforms_response_to_model(): void
    {
        $model = $this->resource()->find();

        $this->assertInstanceOf(ModelStub::class, $model);
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

        return new ResourceStub($client);
    }

    /** @test */
    public function it_builds_uri_correctly(): void
    {
        $guzzle = $this->mock(GuzzleClient::class);
        $client = new Client($guzzle);
        $resource = new ResourceStub($client);

        $this->assertSame('model_stubs/test.json', $resource->buildUri('/test'));
        $this->assertSame('model_stubs/uri/with/multiple/directories.json', $resource->buildUri('/uri/with/multiple/directories'));
    }

    /** @test */
    public function it_prepares_json_correctly(): void
    {
        $guzzle = $this->mock(GuzzleClient::class);
        $client = new Client($guzzle);
        $resource = new ResourceStub($client);

        $this->assertSame(['foo' => ['bar' => 'baz']], $resource->getPreparedJson(['bar' => 'baz'], 'foo'));
    }
}

final class ResourceStub extends Resource
{
    protected $model = ModelStub::class;

    public function find(): Model
    {
        $response = new Response(json_encode([
            'model_stub' => [
                'first_name' => 'Foo',
                'last_name' => 'Bar',
            ]
        ]), 200);

        return $this->toModel($response);
    }

    public function get(): Collection
    {
        $response = new Response(json_encode([
            'model_stubs' => [
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

    public function getPreparedJson(array $data, string $key): array
    {
        return $this->prepareJson($data, $key);
    }
}

final class ModelStub extends Model
{
}
