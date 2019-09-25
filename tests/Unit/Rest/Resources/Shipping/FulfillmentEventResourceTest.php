<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Shipping;

use Strawberry\Shopify\Models\Shipping\FulfillmentEvent;
use Strawberry\Shopify\Rest\Resources\Shipping\FulfillmentEventResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class FulfillmentEventResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = FulfillmentEvent::class;

    /** @var string */
    protected $resourceClass = FulfillmentEventResource::class;

    /** @var string */
    protected $dataPath = 'shipping/fulfillment_event';
}
