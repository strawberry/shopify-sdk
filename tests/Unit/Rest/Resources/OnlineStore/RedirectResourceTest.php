<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Models\OnlineStore\Redirect;
use Strawberry\Shopify\Rest\Resources\OnlineStore\RedirectResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class RedirectResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Redirect::class;

    /** @var string */
    protected $resourceClass = RedirectResource::class;

    /** @var string */
    protected $dataPath = 'online_store/redirect';
}
