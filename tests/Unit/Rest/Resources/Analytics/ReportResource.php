<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Analytics;

use Strawberry\Shopify\Models\Analytics\Report;
use Strawberry\Shopify\Rest\Resources\Analytics\ReportResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class ReportResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Report::class;

    /** @var string */
    protected $resourceClass = ReportResource::class;

    /** @var string */
    protected $dataPath = 'analytics/report';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'reports.json');
        $this->assertCollection($response, 2);
    }

    public function testGetWithOptions(): void
    {
        $this->queue(200, [], $this->response('get_with_options'));

        $response = $this->resource->get([
            'ids' => '517154478'
        ]);

        $this->assertRequest('GET', 'reports.json?ids=517154478');
        $this->assertCollection($response, 1);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(517154478);

        $this->assertRequest('GET', 'reports/517154478.json');
        $this->assertModel($response);
    }

    public function testFindWithOptions(): void
    {
        $this->queue(200, [], $this->response('find_with_options'));

        $response = $this->resource->find(517154478, [
            'fields' => 'id,shopify_ql'
        ]);

        $this->assertRequest('GET', 'reports/517154478.json?fields=id,shopify_ql');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'reports.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(201, [], $this->response('update'));

        $response = $this->resource->update(
            517154478,
            $this->request('update')
        );

        $this->assertRequest('PUT', 'reports/517154478.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(517154478);

        $this->assertRequest('DELETE', 'reports/517154478.json');
        $this->assertNull($response);
    }
}
