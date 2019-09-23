<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Models\OnlineStore\ScriptTag;
use Strawberry\Shopify\Rest\Resources\OnlineStore\ScriptTagResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class ScriptTagResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = ScriptTag::class;

    /** @var string */
    protected $resourceClass = ScriptTagResource::class;

    /** @var string */
    protected $dataPath = 'online_store/script_tag';
}
