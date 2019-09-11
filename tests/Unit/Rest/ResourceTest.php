<?php

namespace Strawberry\Shopify\Tests\Unit\Rest;

use GuzzleHttp\Client as GuzzleHttpClient;
use Illuminate\Support\Collection;
use Strawberry\Shopify\Http\Client;
use Strawberry\Shopify\Http\Response;
use Strawberry\Shopify\Models\Model;
use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Tests\TestCase;

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
        $guzzleClient = $this->mock(GuzzleHttpClient::class);
        $client = new Client($guzzleClient);

        return new ResourceStub($client);
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
}

final class ModelStub extends Model
{
}
