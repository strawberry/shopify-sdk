<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Plus;

use Strawberry\Shopify\Models\Plus\GiftCard;
use Strawberry\Shopify\Rest\Resources\Plus\GiftCardResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class GiftCardResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = GiftCard::class;

    /** @var string */
    protected $resourceClass = GiftCardResource::class;

    /** @var string */
    protected $dataPath = 'plus/gift_card';
}
