<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Misc;

use Strawberry\Shopify\Models\Misc\TenderTransaction;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

final class TenderTransactionResource extends Resource
{
    use Concerns\ListsResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = TenderTransaction::class;
}
