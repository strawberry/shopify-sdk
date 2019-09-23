<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Misc;

use Strawberry\Shopify\Models\Misc\MarketingEvent;
use Strawberry\Shopify\Rest\Resources\Misc\MarketingEventResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class MarketingEventResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = MarketingEvent::class;

    /** @var string */
    protected $resourceClass = MarketingEventResource::class;

    /** @var string */
    protected $dataPath = 'misc/marketing_event';
}
