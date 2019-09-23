<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Billing;

use Strawberry\Shopify\Models\Billing\RecurringApplicationCharge;
use Strawberry\Shopify\Rest\Resources\Billing\RecurringApplicationChargeResource;
use Strawberry\Shopify\Rest\Resources\Billing\UsageChargeResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class RecurringApplicationChargeResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = RecurringApplicationCharge::class;

    /** @var string */
    protected $resourceClass = RecurringApplicationChargeResource::class;

    /** @var string */
    protected $dataPath = 'billing/recurring_application_charge';

    public function testChildren(): void
    {
        $this->assertTrue($this->resource->hasChildren());
        $this->assertTrue($this->resource->hasChild('usageCharges'));
        $this->assertInstanceOf(UsageChargeResource::class, $this->resource->getChild('usageCharges'));
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'recurring_application_charges.json');
        $this->assertModel($response);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(455696195);

        $this->assertRequest('GET', 'recurring_application_charges/455696195.json');
        $this->assertModel($response);
    }

    public function testFindWithOptions(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(455696195, [
            'fields' => 'id,name'
        ]);

        $this->assertRequest('GET', 'recurring_application_charges/455696195.json?fields=id,name');
        $this->assertModel($response);
    }

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'recurring_application_charges.json');
        $this->assertCollection($response, 2);
    }

    public function testGetWithOptions(): void
    {
        $this->queue(200, [], $this->response('get_with_options'));

        $response = $this->resource->get([
            'since_id' => 455696195
        ]);

        $this->assertRequest('GET', 'recurring_application_charges.json?since_id=455696195');
        $this->assertCollection($response);
    }

    public function testActivate(): void
    {
        $this->queue(200, [], $this->response('activate'));

        $response = $this->resource->activate(
            455696195,
            $this->request('activate')
        );

        $this->assertRequest('POST', 'recurring_application_charges/455696195/activate.json');
        $this->assertModel($response);
    }

    public function testCancel(): void
    {
        $this->queue(204);

        $response = $this->resource->cancel(123456789);

        $this->assertRequest('DELETE', 'recurring_application_charges/123456789.json');
        $this->assertNull($response);
    }

    public function testUpdateCappedAmount(): void
    {
        $this->queue(200, [], $this->response('customize'));

        $response = $this->resource->updateCappedAmount(455696195, 200);

        $this->assertRequest('PUT', 'recurring_application_charges/455696195/customize.json?recurring_application_charge[capped_amount]=200');
        $this->assertModel($response);
    }
}
