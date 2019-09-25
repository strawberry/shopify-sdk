<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Billing;

use Strawberry\Shopify\Models\Billing\ApplicationCredit;
use Strawberry\Shopify\Rest\Resources\Billing\ApplicationCreditResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class ApplicationCreditResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = ApplicationCredit::class;

    /** @var string */
    protected $resourceClass = ApplicationCreditResource::class;

    /** @var string */
    protected $dataPath = 'billing/application_credit';

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'application_credits.json');
        $this->assertModel($response);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(445365009);

        $this->assertRequest('GET', 'application_credits/445365009.json');
        $this->assertModel($response);
    }

    public function testFindWithOptions(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(445365009, [
            'fields' => 'id,amount'
        ]);

        $this->assertRequest('GET', 'application_credits/445365009.json?fields=id,amount');
        $this->assertModel($response);
    }

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'application_credits.json');
        $this->assertCollection($response);
    }

    public function testGetWithOptions(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get([
            'fields' => 'id,amount'
        ]);

        $this->assertRequest('GET', 'application_credits.json?fields=id,amount');
        $this->assertCollection($response);
    }
}
