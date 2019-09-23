<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Discounts;

use Strawberry\Shopify\Models\Discounts\PriceRule;
use Strawberry\Shopify\Rest\Resources\Discounts\PriceRuleResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class PriceRuleResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = PriceRule::class;

    /** @var string */
    protected $resourceClass = PriceRuleResource::class;

    /** @var string */
    protected $dataPath = 'discounts/price_rule';
}
