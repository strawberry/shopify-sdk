<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Store;

use Strawberry\Shopify\Models\Store\Currency;
use Strawberry\Shopify\Rest\Resources\Store\CurrencyResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class CurrencyResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Currency::class;

    /** @var string */
    protected $resourceClass = CurrencyResource::class;

    /** @var string */
    protected $dataPath = 'store/currency';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'currencies.json');
        $this->assertCollection($response, 3);
    }
}
