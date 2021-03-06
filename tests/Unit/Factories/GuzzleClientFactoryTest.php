<?php

namespace Strawberry\Shopify\Tests\Unit\Factories;

use Strawberry\Shopify\Exceptions\SdkException;
use Strawberry\Shopify\Tests\TestCase;
use Strawberry\Shopify\Factories\GuzzleClientFactory;

final class GuzzleClientFactoryTest extends TestCase
{
    /** @var array */
    private $config;

    public function setUpTestCase(): void
    {
        $this->config = [
            'version' => '2019-07',
            'store_uri' => 'test.myshopify.com',
            'api_key' => 'test-api-key',
            'api_password' => 'test-api-password',
            'access_token' => 'test-api-access-token',
        ];
    }

    public function testNoCredentials(): void
    {
        $this->expectException(SdkException::class);

        $client = (new GuzzleClientFactory())->make([]);
    }

    /** @dataProvider missingPrivateCredentials */
    public function testMissingPrivateCredentials(array $config): void
    {
        $this->expectException(SdkException::class);

        $client = (new GuzzleClientFactory())->make($config);
    }

    public function testPublicApp(): void
    {
        $client = (new GuzzleClientFactory())->forPublicApp($this->config);

        $uri = $client->getConfig('base_uri');
        $headers = $client->getConfig('headers');

        $this->assertEquals('https://test.myshopify.com/admin/api/2019-07/', $uri);
        $this->assertArrayHasKey('X-Shopify-Access-Token', $headers);
        $this->assertSame('test-api-access-token', $headers['X-Shopify-Access-Token']);
    }

    public function testPublicAppFromConfig(): void
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

    public function testPrivateApp(): void
    {
        $client = (new GuzzleClientFactory())->forPrivateApp($this->config);

        $uri = $client->getConfig('base_uri');
        $auth = $client->getConfig('auth');

        $this->assertEquals('https://test.myshopify.com/admin/api/2019-07/', $uri);
        $this->assertSame([
            'test-api-key',
            'test-api-password',
        ], $auth);
    }

    /** @test */
    public function testPrivateAppFromConfig(): void
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
