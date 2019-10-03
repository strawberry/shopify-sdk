<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Sales;

use Strawberry\Shopify\Models\Sales\ResourceFeedback;
use Strawberry\Shopify\Rest\Resources\Sales\ResourceFeedbackResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class ResourceFeedbackResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = ResourceFeedback::class;

    /** @var string */
    protected $resourceClass = ResourceFeedbackResource::class;

    /** @var string */
    protected $dataPath = 'sales/resource_feedback';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'resource_feedback.json');
        $this->assertCollection($response, 1);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('resource_feedback');
        $this->assertRequest('POST', 'resource_feedback.json');
        $this->assertModel($response);
    }
}
