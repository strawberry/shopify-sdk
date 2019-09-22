<?php

namespace Strawberry\Shopify\Tests\Unit\Http;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use Strawberry\Shopify\Http\Client;
use GuzzleHttp\Client as GuzzleClient;
use Strawberry\Shopify\Tests\TestCase;
use GuzzleHttp\Exception\RequestException;
use Strawberry\Shopify\Exceptions\HttpException;

final class ClientTest extends TestCase
{
    /** @var MockHandler */
    private $mockHandler;

    /** @var Client */
    private $client;

    public function setUpTestCase(): void
    {
        $this->mockHandler = new MockHandler();

        $this->client = new Client(new GuzzleClient([
            'handler' => HandlerStack::create($this->mockHandler),
        ]));
    }

    public function testRequest(): void
    {
        $this->mockHandler->append(
            new Response(200, ['Foo' => 'Bar'], '{"hello": "world"}')
        );

        $response = $this->client->request('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['Foo' => ['Bar']], $response->getHeaders());
        $this->assertEquals(['hello' => 'world'], $response->getContent());
    }

    public function testRequestThatThrowsRequestException(): void
    {
        $this->expectException(HttpException::class);

        $this->mockHandler->append(
            new RequestException('', new Request('GET', '/'))
        );

        $this->client->request('GET', '/');
    }

    public function testGet(): void
    {
        $this->mockHandler->append(new Response());

        $response = $this->client->get(
            '/test',
            ['query' => 'string'],
            ['header' => 'line']
        );

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(null, $response->getContent());
        $this->assertSame([], $response->getHeaders());

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('/test?query=string', (string) $request->getUri());
        $this->assertSame(['line'], $request->getHeader('header'));
    }

    public function testPost(): void
    {
        $this->mockHandler->append(new Response());

        $response = $this->client->post(
            '/test',
            ['json' => 'content'],
            ['query' => 'string'],
            ['header' => 'line']
        );

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(null, $response->getContent());
        $this->assertSame([], $response->getHeaders());

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('{"json":"content"}', (string) $request->getBody()->getContents());
        $this->assertSame('/test?query=string', (string) $request->getUri());
        $this->assertSame(['line'], $request->getHeader('header'));
    }

    public function testPut(): void
    {
        $this->mockHandler->append(new Response());

        $response = $this->client->put(
            '/test',
            ['json' => 'content'],
            ['query' => 'string'],
            ['header' => 'line']
        );

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(null, $response->getContent());
        $this->assertSame([], $response->getHeaders());

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('{"json":"content"}', (string) $request->getBody()->getContents());
        $this->assertSame('/test?query=string', (string) $request->getUri());
        $this->assertSame(['line'], $request->getHeader('header'));
    }

    public function testPatch(): void
    {
        $this->mockHandler->append(new Response());

        $response = $this->client->patch(
            '/test',
            ['json' => 'content'],
            ['query' => 'string'],
            ['header' => 'line']
        );

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(null, $response->getContent());
        $this->assertSame([], $response->getHeaders());

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('PATCH', $request->getMethod());
        $this->assertSame('{"json":"content"}', (string) $request->getBody()->getContents());
        $this->assertSame('/test?query=string', (string) $request->getUri());
        $this->assertSame(['line'], $request->getHeader('header'));
    }

    public function testDelete(): void
    {
        $this->mockHandler->append(new Response());

        $response = $this->client->delete(
            '/test',
            ['header' => 'line']
        );

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(null, $response->getContent());
        $this->assertSame([], $response->getHeaders());

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('DELETE', $request->getMethod());
        $this->assertSame(['line'], $request->getHeader('header'));
    }
}
