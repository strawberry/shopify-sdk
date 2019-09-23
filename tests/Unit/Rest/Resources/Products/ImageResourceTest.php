<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Products;

use Strawberry\Shopify\Models\Products\Image;
use Strawberry\Shopify\Rest\Resources\Products\ImageResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class ImageResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Image::class;

    /** @var string */
    protected $resourceClass = ImageResource::class;

    /** @var string */
    protected $dataPath = 'products/image';
}
