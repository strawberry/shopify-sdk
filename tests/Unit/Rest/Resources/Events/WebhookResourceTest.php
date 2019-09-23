<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Events;

use Strawberry\Shopify\Models\Events\Webhook;
use Strawberry\Shopify\Rest\Resources\Events\WebhookResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class WebhookResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Webhook::class;

    /** @var string */
    protected $resourceClass = WebhookResource::class;

    /** @var string */
    protected $dataPath = 'events/webhook';
}
