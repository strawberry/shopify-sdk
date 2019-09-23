<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Discounts;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Discounts\Batch;
use Strawberry\Shopify\Models\Discounts\DiscountCode;
use Strawberry\Shopify\Rest\Resources\Discounts\BatchResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class BatchResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Batch::class;

    /** @var string */
    protected $resourceClass = BatchResource::class;

    /** @var string */
    protected $dataPath = 'discounts/batch';

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->withParent(123456789)->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'price_rules/123456789/batch.json');
        $this->assertModel($response);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->withParent(123456789)->find(173232803);

        $this->assertRequest('GET', 'price_rules/123456789/batch/173232803.json');
        $this->assertModel($response);
    }

    public function testDiscountCodes(): void
    {
        $this->queue(200, [], $this->response('discount_codes'));

        $response = $this->resource->withParent(123456789)->discountCodes(987654321);

        $this->assertRequest('GET', 'price_rules/123456789/batch/987654321/discount_codes.json');
        $this->assertInstanceOf(Collection::class, $response);
        $this->assertContainsOnlyInstancesOf(DiscountCode::class, $response);
    }
}
