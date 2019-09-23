<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\ShopifyPayments;

use Strawberry\Shopify\Models\ShopifyPayments\Dispute;
use Strawberry\Shopify\Rest\Resources\ShopifyPayments\DisputeResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class DisputeResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Dispute::class;

    /** @var string */
    protected $resourceClass = DisputeResource::class;

    /** @var string */
    protected $dataPath = 'shopify_payments/dispute';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'shopify_payments/disputes.json');
        $this->assertCollection($response, 6);
    }

    public function testGetWithOptions(): void
    {
        $this->queue(200, [], $this->response('get_with_options'));

        $response = $this->resource->get([
            'status' => 'won'
        ]);

        $this->assertRequest('GET', 'shopify_payments/disputes.json?status=won');
        $this->assertCollection($response, 1);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(598735659);

        $this->assertRequest('GET', 'shopify_payments/disputes/598735659.json');
        $this->assertModel($response);
    }
}
