<?php

namespace Strawberry\Shopify\Tests\Unit\Http;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Handler\MockHandler;
use Strawberry\Shopify\Http\Client;
use GuzzleHttp\Client as GuzzleClient;
use Strawberry\Shopify\Tests\TestCase;
use GuzzleHttp\Exception\RequestException;
use Strawberry\Shopify\Exceptions\HttpException;

final class ClientTest extends TestCase
{
    /** @test */
    public function it_throws_http_exception_when_bad_response_received(): void
    {
        $this->expectException(HttpException::class);

        $mock = new MockHandler([
            new RequestException('', new Request('GET', '/')),
        ]);

        $client = new Client(
            new GuzzleClient(['handler' => $mock])
        );

        $client->request('GET', '/');
    }
}
