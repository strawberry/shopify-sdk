<?php

namespace Strawberry\Shopify\Tests\Unit\Http;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Strawberry\Shopify\Exceptions\HttpException;
use Strawberry\Shopify\Http\Client;
use Strawberry\Shopify\Tests\TestCase;

final class ClientTest extends TestCase
{
    /** @test */
    public function it_throws_http_exception_when_bad_response_received(): void
    {
        $this->expectException(HttpException::class);

        $client = $this->client(new MockHandler([
            new RequestException('', new Request('GET', '/')),
        ]));

        $client->request('GET', '/');
    }

    /** @test */
    public function it_returns_response_successfully(): void
    {
        $client = $this->client(new MockHandler([
            new Response(200, ['Foo' => 'Bar'], '{"hello": "world"}'),
        ]));

        $response = $client->request('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['Foo' => ['Bar']], $response->getHeaders());
        $this->assertEquals(['hello' => 'world'], $response->getContent());
    }

    /** @test */
    public function it_performs_get_requests(): void
    {
        $guzzleClient = $this->mock(GuzzleClient::class);
        $client = new Client($guzzleClient);

        $uri = '/test';
        $query = ['hello' => 'world'];
        $headers = ['foo' => 'bar'];

        $this->assertRequest($guzzleClient, 'GET', $uri, $headers, $query);

        $client->get($uri, $query, $headers);
    }

    /** @test */
    public function it_performs_post_requests(): void
    {
        $guzzleClient = $this->mock(GuzzleClient::class);
        $client = new Client($guzzleClient);

        $uri = '/test';
        $json = ['json' => 'content'];
        $query = ['hello' => 'world'];
        $headers = ['foo' => 'bar'];

        $this->assertRequest($guzzleClient, 'POST', $uri, $headers, $query, $json);

        $client->post($uri, $json, $query, $headers);
    }

    /** @test */
    public function it_performs_put_requests(): void
    {
        $guzzleClient = $this->mock(GuzzleClient::class);
        $client = new Client($guzzleClient);

        $uri = '/test';
        $json = ['json' => 'content'];
        $query = ['hello' => 'world'];
        $headers = ['foo' => 'bar'];

        $this->assertRequest($guzzleClient, 'PUT', $uri, $headers, $query, $json);

        $client->put($uri, $json, $query, $headers);
    }

    /** @test */
    public function it_performs_patch_requests(): void
    {
        $guzzleClient = $this->mock(GuzzleClient::class);
        $client = new Client($guzzleClient);

        $uri = '/test';
        $json = ['json' => 'content'];
        $query = ['hello' => 'world'];
        $headers = ['foo' => 'bar'];

        $this->assertRequest($guzzleClient, 'PATCH', $uri, $headers, $query, $json);

        $client->patch($uri, $json, $query, $headers);
    }

    /** @test */
    public function it_performs_delete_requests(): void
    {
        $guzzleClient = $this->mock(GuzzleClient::class);
        $client = new Client($guzzleClient);

        $uri = '/test';
        $headers = ['foo' => 'bar'];

        $this->assertRequest($guzzleClient, 'DELETE', $uri, $headers);

        $client->delete($uri, $headers);
    }

    private function assertRequest(
        GuzzleClient $client,
        string $method,
        string $uri,
        array $headers = [],
        array $query = [],
        array $json = []
    ): void {
        $expectedRequest = new Request($method, $uri, $headers);
        $expectedOptions = [
            'query' => $query,
            'json' => $json,
        ];

        $client->shouldReceive('send')->withArgs(function (
            $request, $options
        ) use ($expectedRequest, $expectedOptions) {
            $this->assertEquals($expectedRequest, $request);
            $this->assertEquals($expectedOptions, $options);

            return true;
        })->andReturn(new Response);
    }

    private function client(MockHandler $handler): Client
    {
        $guzzleClient = new GuzzleClient([
            'handler' => $handler
        ]);

        return new Client($guzzleClient);
    }
}
