<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Discounts;

use Strawberry\Shopify\Models\Discounts\DiscountCode;
use Strawberry\Shopify\Rest\Resources\Discounts\DiscountCodeResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class DiscountCodeResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = DiscountCode::class;

    /** @var string */
    protected $resourceClass = DiscountCodeResource::class;

    /** @var string */
    protected $dataPath = 'discounts/discount_code';
}
