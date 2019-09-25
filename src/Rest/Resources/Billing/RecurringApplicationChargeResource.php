<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Billing;

use Illuminate\Contracts\Support\Arrayable;
use Strawberry\Shopify\Models\Billing\RecurringApplicationCharge;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

final class RecurringApplicationChargeResource extends Resource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\CreatesResource,
        Concerns\DeletesResource;

    /**
     * A list of the child resources.
     *
     * @var string[]
     */
    protected $childResources = [
        'usageCharges' => UsageChargeResource::class,
    ];

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = RecurringApplicationCharge::class;

    /**
     * Activates an accepted application charge.
     *
     * @param  array|Arrayable  $data
     */
    public function activate(int $id, $data): RecurringApplicationCharge
    {
        $response = $this->client->post(
            $this->uri("{$id}/activate"),
            $this->prepareJson($data, 'recurring_application_charge')
        );

        return $this->toModel($response);
    }

    /**
     * Cancels a recurring application charge. Alias for `delete`.
     */
    public function cancel(int $id): void
    {
        $this->delete($id);
    }

    /**
     * Updates the capped amount of an active recurring application charge.
     */
    public function updateCappedAmount(
        int $id,
        float $amount
    ): RecurringApplicationCharge {
        $response = $this->client->put($this->uri("{$id}/customize"), [], [
            'recurring_application_charge' => ['capped_amount' => $amount],
        ]);

        return $this->toModel($response);
    }
}
