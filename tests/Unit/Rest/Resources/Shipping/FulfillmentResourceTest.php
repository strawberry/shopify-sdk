<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Shipping;

use Strawberry\Shopify\Models\Shipping\Fulfillment;
use Strawberry\Shopify\Rest\Resources\Shipping\FulfillmentResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class FulfillmentResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Fulfillment::class;

    /** @var string */
    protected $resourceClass = FulfillmentResource::class;

    /** @var string */
    protected $dataPath = 'shipping/fulfillment';
}
