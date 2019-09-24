<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Models\OnlineStore\Article;
use Strawberry\Shopify\Rest\Resources\OnlineStore\BlogArticleResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class BlogArticleResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Article::class;

    /** @var string */
    protected $resourceClass = BlogArticleResource::class;

    /** @var string */
    protected $dataPath = 'online_store/article';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->withParent(123456789)->get();

        $this->assertRequest('GET', 'blogs/123456789/articles.json');
        $this->assertCollection($response, 4);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->withParent(123456789)->find(998730532);

        $this->assertRequest('GET', 'blogs/123456789/articles/998730532.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->withParent(123456789)->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'blogs/123456789/articles.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(200, [], $this->response('update'));

        $response = $this->resource->withParent(123456789)->update(
            998730532,
            $this->request('update')
        );

        $this->assertRequest('PUT', 'blogs/123456789/articles/998730532.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->withParent(123456789)->delete(998730532);

        $this->assertRequest('DELETE', 'blogs/123456789/articles/998730532.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->withParent(123456789)->count();

        $this->assertRequest('GET', 'blogs/123456789/articles/count.json');
        $this->assertSame(4, $response);
    }

    public function testTags(): void
    {
        $this->queue(200, [], $this->response('tags'));

        $response = $this->resource->withParent(123456789)->tags();

        $this->assertRequest('GET', 'blogs/123456789/articles/tags.json');
        $this->assertSame([
            'Announcing', 'Mystery'
        ], $response);
    }
}
