<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Shipping;

use Strawberry\Shopify\Models\Shipping\CarrierService;
use Strawberry\Shopify\Rest\Resources\Shipping\CarrierServiceResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class CarrierServiceResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = CarrierService::class;

    /** @var string */
    protected $resourceClass = CarrierServiceResource::class;

    /** @var string */
    protected $dataPath = 'shipping/carrier_service';
}
