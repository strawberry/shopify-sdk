<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Plus;

use Strawberry\Shopify\Models\Plus\GiftCard;
use Strawberry\Shopify\Rest\Resources\Plus\GiftCardResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class GiftCardResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = GiftCard::class;

    /** @var string */
    protected $resourceClass = GiftCardResource::class;

    /** @var string */
    protected $dataPath = 'plus/gift_card';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'gift_cards.json');
        $this->assertCollection($response, 3);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(48394658);

        $this->assertRequest('GET', 'gift_cards/48394658.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertPostKey('gift_card');
        $this->assertRequest('POST', 'gift_cards.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(201, [], $this->response('update'));

        $response = $this->resource->update(
            48394658,
            $this->request('update')
        );

        $this->assertPostKey('gift_card');
        $this->assertRequest('PUT', 'gift_cards/48394658.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(48394658);

        $this->assertRequest('DELETE', 'gift_cards/48394658.json');
        $this->assertNull($response);
    }

    public function testCount(): void
    {
        $this->queue(200, [], $this->response('count'));

        $response = $this->resource->count();

        $this->assertRequest('GET', 'gift_cards/count.json');
        $this->assertSame(3, $response);
    }

    public function testSearch(): void
    {
        $this->queue(200, [], $this->response('search'));

        $response = $this->resource->search('mnop');

        $this->assertRequest('GET', 'gift_cards/search.json?query=mnop');
        $this->assertCollection($response);
    }

    public function testDisable(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->disable(48394658);

        $this->assertPostKey('gift_card');
        $this->assertRequest('POST', 'gift_cards/48394658/disable.json');
        $this->assertModel($response);
    }
}
