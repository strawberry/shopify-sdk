<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Models\OnlineStore\Asset;
use Strawberry\Shopify\Rest\Resources\OnlineStore\AssetResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class AssetResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Asset::class;

    /** @var string */
    protected $resourceClass = AssetResource::class;

    /** @var string */
    protected $dataPath = 'online_store/asset';
}
