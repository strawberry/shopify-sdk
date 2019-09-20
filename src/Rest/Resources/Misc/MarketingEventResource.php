<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Misc;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\Misc\Engagement;
use Strawberry\Shopify\Models\Misc\MarketingEvent;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

final class MarketingEventResource extends Resource
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
    protected $model = MarketingEvent::class;

    /**
     * Add engagements to a marketing engagement.
     */
    public function engagements(int $id, array $engagements): Collection
    {
        $response = $this->client->post(
            $this->uri("{$id}/engagements"),
            $this->prepareJson($engagements, 'engagements')
        );

        return $this->toCollection($response, 'engagements', Engagement::class);
    }
}
