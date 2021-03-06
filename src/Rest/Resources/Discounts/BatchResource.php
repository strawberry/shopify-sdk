<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Discounts;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Discounts\Batch;
use Strawberry\Shopify\Models\Discounts\DiscountCode;
use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Rest\Concerns;

final class BatchResource extends ChildResource
{
    use Concerns\CreatesResource,
        Concerns\FindsResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Batch::class;

    /** @return mixed */
    public function discountCodes(int $id)
    {
        $response = $this->client->get(
            $this->uri("{$id}/discount_codes")
        );

        return $this->toCollection(
            $response,
            'discount_codes',
            DiscountCode::class
        );
    }

    public function singularResourceKey(): string
    {
        return 'discount_code_creation';
    }

    public function routeKey(): string
    {
        return 'batch';
    }

    public function postKey(): string
    {
        return 'discount_codes';
    }
}
