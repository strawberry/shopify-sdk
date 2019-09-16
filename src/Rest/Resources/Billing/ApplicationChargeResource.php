<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Billing;

use Illuminate\Contracts\Support\Arrayable;
use Strawberry\Shopify\Models\Billing\ApplicationCharge;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

final class ApplicationChargeResource extends Resource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\CreatesResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = ApplicationCharge::class;

    /**
     * Activates an accepted application charge.
     *
     * @param  array|Arrayable  $data
     */
    public function activate(int $id, $data): ApplicationCharge
    {
        $response = $this->client->post(
            $this->uri("{$id}/activate"),
            $this->prepareJson($data, 'application_charge')
        );

        return $this->toModel($response);
    }
}
