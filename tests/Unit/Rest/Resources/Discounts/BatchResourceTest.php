<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Discounts;

use Strawberry\Shopify\Models\Discounts\Batch;
use Strawberry\Shopify\Rest\Resources\Discounts\BatchResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class BatchResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Batch::class;

    /** @var string */
    protected $resourceClass = BatchResource::class;

    /** @var string */
    protected $dataPath = 'discounts/batch';
}
