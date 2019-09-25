<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Billing;

use Strawberry\Shopify\Models\Billing\UsageCharge;
use Strawberry\Shopify\Rest\Resources\Billing\UsageChargeResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class UsageChargeResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = UsageCharge::class;

    /** @var string */
    protected $resourceClass = UsageChargeResource::class;

    /** @var string */
    protected $dataPath = 'billing/usage_charge';

    public function testCreate(): void
    {
        $this->queue(200, [], $this->response('create'));

        $response = $this->resource->withParent(123456789)->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'recurring_application_charges/123456789/usage_charges.json');
        $this->assertModel($response);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->withParent(123456789)->find(1034618216);

        $this->assertRequest('GET', 'recurring_application_charges/123456789/usage_charges/1034618216.json');
        $this->assertModel($response);
    }

    public function testFindWithOptions(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->withParent(123456789)->find(1034618216, [
            'fields' => 'id,description'
        ]);

        $this->assertRequest('GET', 'recurring_application_charges/123456789/usage_charges/1034618216.json?fields=id,description');
        $this->assertModel($response);
    }

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->withParent(123456789)->get();

        $this->assertRequest('GET', 'recurring_application_charges/123456789/usage_charges.json');
        $this->assertCollection($response);
    }

    public function testGetWithOptions(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->withParent(123456789)->get([
            'fields' => 'id,description'
        ]);

        $this->assertRequest('GET', 'recurring_application_charges/123456789/usage_charges.json?fields=id,description');
        $this->assertCollection($response);
    }
}
