<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Sales;

use Strawberry\Shopify\Models\Sales\Payment;
use Strawberry\Shopify\Rest\Resources\Sales\PaymentResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class PaymentResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = Payment::class;

    /** @var string */
    protected $resourceClass = PaymentResource::class;

    /** @var string */
    protected $dataPath = 'sales/payment';
}
