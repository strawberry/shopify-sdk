<?php

namespace Strawberry\Shopify\Tests\Unit\Http;

use Strawberry\Shopify\Http\Response;
use Strawberry\Shopify\Tests\TestCase;

final class ResponseTest extends TestCase
{
    /** @test */
    public function it_returns_json_decoded_content(): void
    {
        $response = new Response('{"foo": "bar"}', 200);

        $this->assertEquals([
            'foo' => 'bar'
        ], $response->getContent());
    }

    /**
     * @dataProvider successfulResponseCodes
     * @test
     */
    public function it_is_successful_when_response_code_is_2xx(int $code): void
    {
        $response = new Response('', $code);

        $this->assertTrue($response->isSuccess());
    }

    /**
     * @dataProvider redirectResponseCodes
     * @test
     */
    public function it_is_successful_when_response_code_is_3xx(int $code): void
    {
        $response = new Response('', $code);

        $this->assertTrue($response->isSuccess());
    }

    /**
     * @dataProvider clientErrorResponseCodes
     * @test
     */
    public function it_is_error_when_response_code_is_4xx(int $code): void
    {
        $response = new Response('', $code);

        $this->assertTrue($response->isError());
    }

    /**
     * @dataProvider serverErrorResponseCodes
     * @test
     */
    public function it_is_error_when_response_code_is_5xx(int $code): void
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
