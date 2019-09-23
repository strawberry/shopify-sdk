<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Events;

use Strawberry\Shopify\Models\Events\Event;
use Strawberry\Shopify\Rest\Resources\Events\EventResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class EventResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Event::class;

    /** @var string */
    protected $resourceClass = EventResource::class;

    /** @var string */
    protected $dataPath = 'events/event';
}
