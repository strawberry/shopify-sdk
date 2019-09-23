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
}
