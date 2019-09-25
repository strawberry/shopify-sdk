<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Products;

use Strawberry\Shopify\Models\Products\Variant;
use Strawberry\Shopify\Rest\Resources\Products\VariantResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class VariantResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Variant::class;

    /** @var string */
    protected $resourceClass = VariantResource::class;

    /** @var string */
    protected $dataPath = 'products/variant';

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find('808950810');

        $this->assertRequest('GET', 'variants/808950810.json');
        $this->assertModel($response);
    }

    public function testUpdate(): void
    {
        $this->queue(201, [], $this->response('update'));

        $response = $this->resource->update(
            808950810,
            $this->request('update')
        );

        $this->assertRequest('PUT', 'variants/808950810.json');
        $this->assertModel($response);
    }
}
