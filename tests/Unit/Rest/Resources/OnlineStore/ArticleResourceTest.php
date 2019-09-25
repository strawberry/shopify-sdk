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

    public function testAuthors(): void
    {
        $this->queue(200, [], $this->response('authors'));

        $response = $this->resource->authors();

        $this->assertRequest('GET', 'articles/authors.json');
        $this->assertSame([
            'dennis', 'John', 'Rob', 'Dennis'
        ], $response);
    }

    public function testTags(): void
    {
        $this->queue(200, [], $this->response('tags'));

        $response = $this->resource->tags();

        $this->assertRequest('GET', 'articles/tags.json');
        $this->assertSame([
            'Announcing', 'Mystery'
        ], $response);
    }
}
