<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Access;

use GuzzleHttp\Psr7\Response;
use Strawberry\Shopify\Models\Access\StorefrontAccessToken;
use Strawberry\Shopify\Rest\Resources\Access\StorefrontAccessTokenResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class StorefrontAccessTokenResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = StorefrontAccessToken::class;

    /** @var string */
    protected $resourceClass = StorefrontAccessTokenResource::class;

    /** @var string */
    protected $dataPath = 'access/storefrontaccesstoken';

    public function testCreate(): void
    {
        $this->queue(200, [], $this->response('create'));

        $response = $this->resource->create($this->request('create'));

        $this->assertRequest('POST', 'storefront_access_tokens.json');
        $this->assertModel($response);
    }

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'storefront_access_tokens.json');
        $this->assertCollection($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $this->resource->delete(123456789);

        $this->assertRequest('DELETE', 'storefront_access_tokens/123456789.json');
    }
}
