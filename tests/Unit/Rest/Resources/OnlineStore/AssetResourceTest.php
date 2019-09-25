<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Models\OnlineStore\Asset;
use Strawberry\Shopify\Rest\Resources\OnlineStore\AssetResource;
use Strawberry\Shopify\Rest\Resources\OnlineStore\ThemeResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ChildResourceTestCase;

final class AssetResourceTest extends ChildResourceTestCase
{
    /** @var string */
    protected $modelClass = Asset::class;

    /** @var array */
    protected $parentResources = [
        [ThemeResource::class, 828155753],
    ];

    /** @var string */
    protected $resourceClass = AssetResource::class;

    /** @var string */
    protected $dataPath = 'online_store/asset';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'themes/828155753/assets.json');
        $this->assertCollection($response, 27);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find('templates/index.liquid');

        $this->assertRequest('GET', 'themes/828155753/assets.json?asset[key]=templates/index.liquid');
        $this->assertModel($response);
    }

    public function testCreateOrUpdate(): void
    {
        $this->queue(200, [], $this->response('create_or_update'));

        $response = $this->resource->createOrUpdate(
            $this->request('create_or_update')
        );

        $this->assertRequest('PUT', 'themes/828155753/assets.json');
        $this->assertModel($response);
    }

    public function testDelete(): void
    {
        $this->queue(200);

        $response = $this->resource->delete('assets/bg-body.gif');

        $this->assertRequest('DELETE', 'themes/828155753/assets.json?asset[key]=assets/bg-body.gif');
        $this->assertNull($response);
    }

    public function testUpload(): void
    {
        $this->queue(200, [], $this->response('create_or_update'));

        $response = $this->resource->upload(
            'templates/index.liquid',
            "<img src='backsoon-postit.png'><p>We are busy updating the store for you and will be back within the hour.</p>"
        );

        $this->assertRequest('PUT', 'themes/828155753/assets.json');
        $this->assertModel($response);
    }

    public function testUploadFromBase64(): void
    {
        $this->queue(200, [], $this->response('create_or_update'));

        $response = $this->resource->uploadFromBase64(
            'assets/empty.gif',
            'R0lGODlhAQABAPABAP///wAAACH5BAEKAAAALAAAAAABAAEAAAICRAEAOw==\n'
        );

        $this->assertRequest('PUT', 'themes/828155753/assets.json');
        $this->assertModel($response);
    }

    public function testUploadFromUrl(): void
    {
        $this->queue(200, [], $this->response('create_or_update'));

        $response = $this->resource->uploadFromUrl(
            'assets/bg-body.gif',
            'http://apple.com/new_bg.gif'
        );

        $this->assertRequest('PUT', 'themes/828155753/assets.json');
        $this->assertModel($response);
    }

    public function testDuplicate(): void
    {
        $this->queue(200, [], $this->response('create_or_update'));

        $response = $this->resource->duplicate(
            'layout/alternate.liquid',
            'layout/theme.liquid'
        );

        $this->assertRequest('PUT', 'themes/828155753/assets.json');
        $this->assertModel($response);
    }
}
