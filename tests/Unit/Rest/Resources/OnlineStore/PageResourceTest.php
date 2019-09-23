<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Models\OnlineStore\Page;
use Strawberry\Shopify\Rest\Resources\OnlineStore\PageResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class PageResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Page::class;

    /** @var string */
    protected $resourceClass = PageResource::class;

    /** @var string */
    protected $dataPath = 'online_store/page';
}
