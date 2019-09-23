<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Misc;

use Strawberry\Shopify\Models\Misc\TenderTransaction;
use Strawberry\Shopify\Rest\Resources\Misc\TenderTransactionResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class TenderTransactionResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = TenderTransaction::class;

    /** @var string */
    protected $resourceClass = TenderTransactionResource::class;

    /** @var string */
    protected $dataPath = 'misc/tender_transaction';
}
