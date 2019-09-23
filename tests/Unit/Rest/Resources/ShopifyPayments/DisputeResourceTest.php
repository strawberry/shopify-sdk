<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\ShopifyPayments;

use Strawberry\Shopify\Models\ShopifyPayments\Dispute;
use Strawberry\Shopify\Rest\Resources\ShopifyPayments\DisputeResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class DisputeResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Dispute::class;

    /** @var string */
    protected $resourceClass = DisputeResource::class;

    /** @var string */
    protected $dataPath = 'shopify_payments/dispute';
}
