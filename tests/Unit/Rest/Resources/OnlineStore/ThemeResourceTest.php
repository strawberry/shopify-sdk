<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Models\OnlineStore\Theme;
use Strawberry\Shopify\Rest\Resources\OnlineStore\AssetResource;
use Strawberry\Shopify\Rest\Resources\OnlineStore\ThemeResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class ThemeResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Theme::class;

    /** @var string */
    protected $resourceClass = ThemeResource::class;

    /** @var string */
    protected $dataPath = 'online_store/theme';

    public function testChildren(): void
    {
        $this->assertTrue($this->resource->hasChildren());
        $this->assertChild('assets', AssetResource::class);
    }

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'themes.json');
        $this->assertCollection($response, 3);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(828155753);

        $this->assertRequest('GET', 'themes/828155753.json');
        $this->assertModel($response);
    }

    public function testCreate(): void
    {
        $this->queue(201, [], $this->response('create'));

        $response = $this->resource->create(
            $this->request('create')
        );

        $this->assertRequest('POST', 'themes.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(200, [], $this->response('update'));

        $response = $this->resource->update(
            828155753,
            $this->request('update')
        );

        $this->assertRequest('PUT', 'themes/828155753.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete(828155753);

        $this->assertRequest('DELETE', 'themes/828155753.json');
        $this->assertNull($response);
    }
}
