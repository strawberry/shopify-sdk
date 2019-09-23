<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Models\OnlineStore\Comment;
use Strawberry\Shopify\Rest\Resources\OnlineStore\CommentResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class CommentResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Comment::class;

    /** @var string */
    protected $resourceClass = CommentResource::class;

    /** @var string */
    protected $dataPath = 'online_store/comment';
}
