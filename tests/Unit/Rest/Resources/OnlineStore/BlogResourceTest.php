<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Models\OnlineStore\Blog;
use Strawberry\Shopify\Rest\Resources\OnlineStore\BlogResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class BlogResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Blog::class;

    /** @var string */
    protected $resourceClass = BlogResource::class;

    /** @var string */
    protected $dataPath = 'online_store/blog';
}
