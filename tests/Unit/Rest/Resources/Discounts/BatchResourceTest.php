<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Discounts;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Discounts\Batch;
use Strawberry\Shopify\Models\Discounts\DiscountCode;
use Strawberry\Shopify\Rest\Resources\Discounts\BatchResource;
use Strawberry\Shopify\Rest\Resources\Discounts\PriceRuleResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ChildResourceTestCase;

final class BatchResourceTest extends ChildResourceTestCase
{
    /** @var string */
    protected $modelClass = Batch::class;

    /** @var array */
    protected $parentResources = [
        [PriceRuleResource::class, 507328175],
    ];

    /** @var string */
    protected $resourceClass = BatchResource::class;

    /** @var string */
    protected $dataPath = 'discounts/batch';

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('discount_codes');
        $this->assertRequest('POST', 'price_rules/507328175/batch.json');
        $this->assertModel($response);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(173232803);

        $this->assertRequest('GET', 'price_rules/507328175/batch/173232803.json');
        $this->assertModel($response);
    }

    public function testDiscountCodes(): void
    {
        $this->queue(200, [], $this->response('discount_codes'));

        $response = $this->resource->discountCodes(987654321);

        $this->assertRequest('GET', 'price_rules/507328175/batch/987654321/discount_codes.json');
        $this->assertIsArray($response);
        $this->assertContainsOnlyInstancesOf(DiscountCode::class, $response);
    }
}
