<?php

namespace Strawberry\Shopify\Tests\Unit\Http;

use Strawberry\Shopify\Http\Response;
use Strawberry\Shopify\Tests\TestCase;

final class ResponseTest extends TestCase
{
    public function testGetContent(): void
    {
        $response = new Response('{"foo": "bar"}', 200);

        $this->assertEquals(['foo' => 'bar'], $response->getContent());
    }

    /** @dataProvider successfulResponseCodes */
    public function testSuccessfulResponses(int $code): void
    {
        $response = new Response('', $code);

        $this->assertTrue($response->isSuccess());
    }

    /** @dataProvider redirectResponseCodes */
    public function testRedirectResponses(int $code): void
    {
        $response = new Response('', $code);

        $this->assertTrue($response->isSuccess());
    }

    /** @dataProvider clientErrorResponseCodes */
    public function testClientErrors(int $code): void
    {
        $response = new Response('', $code);

        $this->assertTrue($response->isError());
    }

    /** @dataProvider serverErrorResponseCodes */
    public function testServerErrors(int $code): void
    {
        $response = new Response('', $code);

        $this->assertTrue($response->isError());
    }

    public function successfulResponseCodes(): array
    {
        return [
            [200], [201], [202],
        ];
    }

    public function redirectResponseCodes(): array
    {
        return [
            [303],
        ];
    }

    public function clientErrorResponseCodes(): array
    {
        return [
            [400], [401], [402], [403], [404],
            [406], [422], [423], [429],
        ];
    }

    public function serverErrorResponseCodes(): array
    {
        return [
            [500], [501], [503], [504],
        ];
    }
}
