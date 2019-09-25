<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Store;

use Strawberry\Shopify\Models\Store\Policy;
use Strawberry\Shopify\Rest\Resources\Store\PolicyResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class PolicyResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Policy::class;

    /** @var string */
    protected $resourceClass = PolicyResource::class;

    /** @var string */
    protected $dataPath = 'store/policy';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'policies.json');
        $this->assertCollection($response);
    }
}
