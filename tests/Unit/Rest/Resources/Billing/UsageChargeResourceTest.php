<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Billing;

use Strawberry\Shopify\Models\Billing\UsageCharge;
use Strawberry\Shopify\Rest\Resources\Billing\RecurringApplicationChargeResource;
use Strawberry\Shopify\Rest\Resources\Billing\UsageChargeResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ChildResourceTestCase;

final class UsageChargeResourceTest extends ChildResourceTestCase
{
    /** @var string */
    protected $modelClass = UsageCharge::class;

    /** @var array */
    protected $parentResources = [
        [RecurringApplicationChargeResource::class, 1034618216],
    ];

    /** @var string */
    protected $resourceClass = UsageChargeResource::class;

    /** @var string */
    protected $dataPath = 'billing/usage_charge';


    public function testCreate(): void
    {
        $this->queue(200, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'recurring_application_charges/1034618216/usage_charges.json');
        $this->assertModel($response);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(1034618216);

        $this->assertRequest('GET', 'recurring_application_charges/1034618216/usage_charges/1034618216.json');
        $this->assertModel($response);
    }

    public function testFindWithOptions(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(1034618216, [
            'fields' => 'id,description'
        ]);

        $this->assertRequest('GET', 'recurring_application_charges/1034618216/usage_charges/1034618216.json?fields=id,description');
        $this->assertModel($response);
    }

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'recurring_application_charges/1034618216/usage_charges.json');
        $this->assertCollection($response);
    }

    public function testGetWithOptions(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get([
            'fields' => 'id,description'
        ]);

        $this->assertRequest('GET', 'recurring_application_charges/1034618216/usage_charges.json?fields=id,description');
        $this->assertCollection($response);
    }
}
