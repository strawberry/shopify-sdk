<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Billing;

use Strawberry\Shopify\Models\Billing\ApplicationCredit;
use Strawberry\Shopify\Rest\Resources\Billing\ApplicationCreditResource;

final class ApplicationCreditResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = ApplicationCredit::class;

    /** @var string */
    protected $resourceClass = ApplicationCreditResource::class;
}
