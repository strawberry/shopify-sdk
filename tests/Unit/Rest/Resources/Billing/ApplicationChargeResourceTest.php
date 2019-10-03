<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Billing;

use Strawberry\Shopify\Models\Billing\ApplicationCharge;
use Strawberry\Shopify\Rest\Resources\Billing\ApplicationChargeResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class ApplicationChargeResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = ApplicationCharge::class;

    /** @var string */
    protected $resourceClass = ApplicationChargeResource::class;

    /** @var string */
    protected $dataPath = 'billing/application_charge';

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('application_charge');
        $this->assertRequest('POST', 'application_charges.json');
        $this->assertModel($response);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(675931192);

        $this->assertRequest('GET', 'application_charges/675931192.json');
        $this->assertModel($response);
    }

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'application_charges.json');
        $this->assertCollection($response, 3);
    }

    public function testActivate(): void
    {
        $this->queue(200, [], $this->response('activate'));

        $response = $this->resource->activate(
            675931192,
            $this->request('activate')
        );

        $this->assertPostKey('application_charge');
        $this->assertModel($response);
        $this->assertRequest('POST', 'application_charges/675931192/activate.json');
    }
}
