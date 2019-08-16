<?php

namespace Strawberry\Shopify\Tests\Unit;

use Strawberry\Shopify\Shopify;
use Strawberry\Shopify\Tests\TestCase;
use Strawberry\Shopify\Rest\Client as RestClient;
use Strawberry\Shopify\Exceptions\ClientException;

final class ShopifyTest extends TestCase
{
    /** @test */
    public function it_is_a_public_app_with_correct_credentials(): void
    {
        $shopify = new Shopify([
            'api_key' => 'test-api-key',
            'api_password' => 'test-api-password',
        ]);

        $this->assertTrue($shopify->isPrivateApp());
        $this->assertFalse($shopify->isPublicApp());
    }

    /** @test */
    public function it_is_a_private_app_with_correct_credentials(): void
    {
        $shopify = new Shopify([
            'access_token' => 'test-access-token',
        ]);

        $this->assertTrue($shopify->isPublicApp());
        $this->assertFalse($shopify->isPrivateApp());
    }

    /** @test */
    public function an_exception_is_thrown_when_getting_rest_client_without_credentials(): void
    {
        $this->expectException(ClientException::class);

        $shopify = new Shopify([]);
        $shopify->getClient();
    }

    /** @test */
    public function sets_up_client_with_correct_credentials(): void
    {
        $shopify = new Shopify([
            'version' => '2019-07',
            'store_uri' => 'mystore.myshopify.com',
            'access_token' => 'test-access-token',
        ]);

        $this->assertInstanceOf(RestClient::class, $shopify->getClient());
    }

    /** @test */
    public function it_forwards_calls_onto_the_client(): void
    {
        $shopify = $this->mock(Shopify::class)->makePartial();
        $client = $this->mock(RestClient::class);

        $shopify->shouldReceive('getClient')->andReturn($client);
        $client->shouldReceive('forwardedCall')->once();

        $shopify->forwardedCall();
    }
}
