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
}
