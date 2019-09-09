<?php

namespace Strawberry\Shopify\Tests\Unit\Factories;

use Strawberry\Shopify\Exceptions\ClientException;
use Strawberry\Shopify\Tests\TestCase;
use Strawberry\Shopify\Factories\GuzzleClientFactory;

final class GuzzleClientFactoryTest extends TestCase
{
    /** @test */
    public function it_throws_an_exception_when_no_credentials_set(): void
    {
        $this->expectException(ClientException::class);

        $client = (new GuzzleClientFactory())->make([]);
    }

    /**
     * @dataProvider missingPrivateCredentials
     * @test
    */
    public function it_throws_an_exception_for_missing_private_credentials(array $config): void
    {
        $this->expectException(ClientException::class);

        $client = (new GuzzleClientFactory())->make($config);
    }

    /** @test */
    public function it_creates_a_client_for_a_public_app_from_configuration(): void
    {
        $config = [
            'version' => '2019-07',
            'store_uri' => 'test.myshopify.com',
            'access_token' => 'test-api-access-token',
        ];

        $client = (new GuzzleClientFactory())->make($config);

        $uri = $client->getConfig('base_uri');
        $headers = $client->getConfig('headers');

        $this->assertEquals('https://test.myshopify.com/admin/api/2019-07/', $uri);
        $this->assertSame('test-api-access-token', $headers['X-Shopify-Access-Token']);
    }

    /** @test */
    public function it_creates_a_client_for_a_public_app(): void
    {
        $client = (new GuzzleClientFactory())->forPublicApp($this->config());

        $uri = $client->getConfig('base_uri');
        $headers = $client->getConfig('headers');

        $this->assertEquals('https://test.myshopify.com/admin/api/2019-07/', $uri);
        $this->assertArrayHasKey('X-Shopify-Access-Token', $headers);
        $this->assertSame('test-api-access-token', $headers['X-Shopify-Access-Token']);
    }

    /** @test */
    public function it_creates_a_client_for_a_private_app_from_configuration(): void
    {
        $config = [
            'version' => '2019-07',
            'store_uri' => 'test.myshopify.com',
            'api_key' => 'test-api-key',
            'api_password' => 'test-api-password',
        ];

        $client = (new GuzzleClientFactory())->make($config);

        $uri = $client->getConfig('base_uri');
        $auth = $client->getConfig('auth');

        $this->assertEquals('https://test.myshopify.com/admin/api/2019-07/', $uri);
        $this->assertSame([
            'test-api-key',
            'test-api-password',
        ], $auth);
    }

    /** @test */
    public function it_creates_a_client_for_a_private_app(): void
    {
        $client = (new GuzzleClientFactory())->forPrivateApp($this->config());

        $uri = $client->getConfig('base_uri');
        $auth = $client->getConfig('auth');

        $this->assertEquals('https://test.myshopify.com/admin/api/2019-07/', $uri);
        $this->assertSame([
            'test-api-key',
            'test-api-password',
        ], $auth);
    }

    private function config(): array
    {
        return [
            'version' => '2019-07',
            'store_uri' => 'test.myshopify.com',
            'api_key' => 'test-api-key',
            'api_password' => 'test-api-password',
            'access_token' => 'test-api-access-token',
        ];
    }

    public function missingPrivateCredentials(): array
    {
        return [
            'missing api key' => [
                [
                    'version' => '2019-07',
                    'store_uri' => 'test.myshopify.com',
                    'api_password' => 'test-api-password',
                ]
            ],

            'missing api password' => [
                [
                    'version' => '2019-07',
                    'store_uri' => 'test.myshopify.com',
                    'api_key' => 'test-api-key',
                ]
            ],
        ];
    }
}
