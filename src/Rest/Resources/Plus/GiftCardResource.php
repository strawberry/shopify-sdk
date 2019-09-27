<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Plus;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Plus\GiftCard;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

final class GiftCardResource extends Resource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\CreatesResource,
        Concerns\UpdatesResource,
        Concerns\DeletesResource,
        Concerns\CountsResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = GiftCard::class;

    /**
     * Searches for gift card that match a supplied query.
     *
     * @return mixed
     */
    public function search(string $query, array $options = [])
    {
        $response = $this->client->get(
            $this->uri('search'),
            array_merge($options, ['query' => $query])
        );

        return $this->toCollection($response);
    }

    /**
     * Searches for gift card that match a supplied query.
     */
    public function disable(int $id): GiftCard
    {
        $json = $this->prepareJson(['id' => $id], 'gift_card');

        $response = $this->client->post(
            $this->uri("{$id}/disable"),
            $json
        );

        return $this->toModel($response);
    }
}
