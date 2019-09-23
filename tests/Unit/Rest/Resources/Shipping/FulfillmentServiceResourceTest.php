<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Shipping;

use Strawberry\Shopify\Models\Shipping\FulfillmentService;
use Strawberry\Shopify\Rest\Resources\Shipping\FulfillmentServiceResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class FulfillmentServiceResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = FulfillmentService::class;

    /** @var string */
    protected $resourceClass = FulfillmentServiceResource::class;

    /** @var string */
    protected $dataPath = 'shipping/fulfillment_service';
}
