<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Discounts;

use Strawberry\Shopify\Models\Discounts\DiscountCode;
use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Rest\Concerns;

final class DiscountCodeResource extends ChildResource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\CreatesResource,
        Concerns\UpdatesResource,
        Concerns\DeletesResource;

    /**
     * The parent resource for this resource.
     *
     * @var string
     */
    protected $parent = PriceRuleResource::class;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = DiscountCode::class;

    /**
     * Performs bulk operations for multiple customer addresses.
     *
     * @todo
     */
    public function lookup(string $code): DiscountCode
    {
        $response = $this->client->get(
            $this->uri('lookup'),
            ['code' => $code]
        );

        return $this->toModel($response);
    }
}
