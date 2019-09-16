<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\Plus;

use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Models\Plus\User;

final class UserResource extends Resource
{
    use Concerns\ListsResource,
        Concerns\FindsResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Searches for gift card that match a supplied query.
     */
    public function current(): User
    {
        $response = $this->client->get($this->uri('current'));

        return $this->toModel($response);
    }
}
