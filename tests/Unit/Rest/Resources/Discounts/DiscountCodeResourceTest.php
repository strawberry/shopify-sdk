<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Discounts;

use Strawberry\Shopify\Models\Discounts\DiscountCode;
use Strawberry\Shopify\Rest\Resources\Discounts\DiscountCodeResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class DiscountCodeResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = DiscountCode::class;

    /** @var string */
    protected $resourceClass = DiscountCodeResource::class;

    /** @var string */
    protected $dataPath = 'discounts/discount_code';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->withParent(123456789)->get();

        $this->assertRequest('GET', 'price_rules/123456789/discount_codes.json');
        $this->assertCollection($response);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->withParent(123456789)->find(507328175);

        $this->assertRequest('GET', 'price_rules/123456789/discount_codes/507328175.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->withParent(123456789)->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'price_rules/123456789/discount_codes.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(200, [], $this->response('update'));

        $response = $this->resource->withParent(123456789)->update(
            507328175,
            $this->request('update')
        );

        $this->assertRequest('PUT', 'price_rules/123456789/discount_codes/507328175.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->withParent(123456789)->delete(507328175);

        $this->assertRequest('DELETE', 'price_rules/123456789/discount_codes/507328175.json');
        $this->assertNull($response);
    }

    public function testLookup(): void
    {
        $redirectUrl = 'https://mystore.myshopify.com/price_rules/123456789/discount_codes/507328175.json';

        $this->queue(301, ['Location' => $redirectUrl]);
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->lookup('SUMMERSALE10OFF');

        $this->assertRequest('GET', $redirectUrl);
        $this->assertModel($response);
    }
}
