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

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'comments.json');
        $this->assertCollection($response, 2);
    }

    public function testGetForArticle(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->getForArticle(134645308, 241253187);

        $this->assertRequest('GET', 'comments.json?article_id=134645308&blog_id=241253187');
        $this->assertCollection($response, 2);
    }

    public function testGetForBlog(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->getForBlog(241253187);

        $this->assertRequest('GET', 'comments.json?blog_id=241253187');
        $this->assertCollection($response, 2);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(118373535);

        $this->assertRequest('GET', 'comments/118373535.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'comments.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(200, [], $this->response('update'));

        $response = $this->resource->update(
            118373535,
            $this->request('update')
        );

        $this->assertRequest('PUT', 'comments/118373535.json');
        $this->assertModel($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'comments/count.json');
        $this->assertSame(2, $response);
    }

    public function testCountForArticle(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->countForArticle(134645308, 241253187);

        $this->assertRequest('GET', 'comments/count.json?article_id=134645308&blog_id=241253187');
        $this->assertSame(2, $response);
    }

    public function testCountForBlog(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->countForBlog(241253187);

        $this->assertRequest('GET', 'comments/count.json?blog_id=241253187');
        $this->assertSame(2, $response);
    }

    public function testMarkAsSpam(): void
    {
        $this->queue(200, [], $this->response('spam'));

        $response = $this->resource->markAsSpam(653537639);

        $this->assertRequest('POST', 'comments/653537639/spam.json');
        $this->assertModel($response);
    }

    public function testMarkAsNotSpam(): void
    {
        $this->queue(200, [], $this->response('not_spam'));

        $response = $this->resource->markAsNotSpam(653537639);

        $this->assertRequest('POST', 'comments/653537639/not_spam.json');
        $this->assertModel($response);
    }

    public function testApprove(): void
    {
        $this->queue(200, [], $this->response('approve'));

        $response = $this->resource->approve(653537639);

        $this->assertRequest('POST', 'comments/653537639/approve.json');
        $this->assertModel($response);
    }

    public function testRemove(): void
    {
        $this->queue(200, [], $this->response('remove'));

        $response = $this->resource->remove(653537639);

        $this->assertRequest('POST', 'comments/653537639/remove.json');
        $this->assertModel($response);
    }

    public function testRestore(): void
    {
        $this->queue(200, [], $this->response('restore'));

        $response = $this->resource->restore(653537639);

        $this->assertRequest('POST', 'comments/653537639/restore.json');
        $this->assertModel($response);
    }
}
