<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Models\OnlineStore\Article;
use Strawberry\Shopify\Rest\Resources\Misc\MetafieldResource;
use Strawberry\Shopify\Rest\Resources\OnlineStore\BlogArticleResource;
use Strawberry\Shopify\Rest\Resources\OnlineStore\BlogResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ChildResourceTestCase;

final class BlogArticleResourceTest extends ChildResourceTestCase
{
    /** @var string */
    protected $modelClass = Article::class;

    /** @var array */
    protected $parentResources = [
        [BlogResource::class, 241253187],
    ];

    /** @var string */
    protected $resourceClass = BlogArticleResource::class;

    /** @var string */
    protected $dataPath = 'online_store/article';

    public function testChildren(): void
    {
        $this->assertTrue($this->resource->hasChildren());
        $this->assertChild('metafields', MetafieldResource::class);
    }

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'blogs/241253187/articles.json');
        $this->assertCollection($response, 4);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(998730532);

        $this->assertRequest('GET', 'blogs/241253187/articles/998730532.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('article');
        $this->assertRequest('POST', 'blogs/241253187/articles.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(200, [], $this->response('update'));

        $response = $this->resource->update(
            998730532,
            $this->request('update')
        );

        $this->assertPostKey('article');
        $this->assertRequest('PUT', 'blogs/241253187/articles/998730532.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(998730532);

        $this->assertRequest('DELETE', 'blogs/241253187/articles/998730532.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'blogs/241253187/articles/count.json');
        $this->assertSame(4, $response);
    }

    public function testTags(): void
    {
        $this->queue(200, [], $this->response('tags'));

        $response = $this->resource->tags();

        $this->assertRequest('GET', 'blogs/241253187/articles/tags.json');
        $this->assertSame([
            'Announcing', 'Mystery'
        ], $response);
    }
}
