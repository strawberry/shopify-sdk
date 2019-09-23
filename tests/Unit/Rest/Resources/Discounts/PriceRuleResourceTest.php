<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Discounts;

use Strawberry\Shopify\Models\Discounts\PriceRule;
use Strawberry\Shopify\Rest\Resources\Discounts\BatchResource;
use Strawberry\Shopify\Rest\Resources\Discounts\DiscountCodeResource;
use Strawberry\Shopify\Rest\Resources\Discounts\PriceRuleResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class PriceRuleResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = PriceRule::class;

    /** @var string */
    protected $resourceClass = PriceRuleResource::class;

    /** @var string */
    protected $dataPath = 'discounts/price_rule';

    public function testChildren(): void
    {
        $this->assertTrue($this->resource->hasChildren());
        $this->assertChild('batches', BatchResource::class);
        $this->assertChild('discountCodes', DiscountCodeResource::class);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'price_rules.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(200, [], $this->response('update'));

        $response = $this->resource->update(
            507328175,
            $this->request('update')
        );

        $this->assertRequest('PUT', 'price_rules/507328175.json');
        $this->assertModel($response);
    }

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'price_rules.json');
        $this->assertCollection($response);
    }

    public function testGetWithOptions(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get([
            'limit' => 250
        ]);

        $this->assertRequest('GET', 'price_rules.json?limit=250');
        $this->assertCollection($response);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(507328175);

        $this->assertRequest('GET', 'price_rules/507328175.json');
        $this->assertModel($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'price_rules/count.json');
        $this->assertSame(1, $response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(507328175);

        $this->assertRequest('DELETE', 'price_rules/507328175.json');
        $this->assertNull($response);
    }
}
