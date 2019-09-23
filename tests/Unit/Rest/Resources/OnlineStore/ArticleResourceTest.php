<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Models\OnlineStore\Article;
use Strawberry\Shopify\Rest\Resources\OnlineStore\ArticleResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class ArticleResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Article::class;

    /** @var string */
    protected $resourceClass = ArticleResource::class;

    /** @var string */
    protected $dataPath = 'online_store/article';
}
