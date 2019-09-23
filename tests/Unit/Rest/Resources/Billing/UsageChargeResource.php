<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Billing;

use Strawberry\Shopify\Models\Billing\UsageCharge;
use Strawberry\Shopify\Rest\Resources\Billing\UsageChargeResource;

final class UsageChargeResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = UsageCharge::class;

    /** @var string */
    protected $resourceClass = UsageChargeResource::class;
}
