<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Models\OnlineStore\Theme;
use Strawberry\Shopify\Rest\Resources\OnlineStore\ThemeResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class ThemeResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Theme::class;

    /** @var string */
    protected $resourceClass = ThemeResource::class;

    /** @var string */
    protected $dataPath = 'online_store/theme';
}
