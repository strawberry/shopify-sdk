<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Models\OnlineStore\Asset;

final class AssetResource extends ChildResource
{
    use Concerns\ListsResource,
        Concerns\FindsResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Asset::class;

    /**
     * The parent resource for this resource.
     *
     * @var string
     */
    protected $parent = ThemeResource::class;

    /**
     * Creates or updates an asset for a theme.
     */
    public function createOrUpdate(array $data): Asset
    {
        $response = $this->client->post(
            $this->uri('assets'),
            $this->prepareJson($data, 'asset')
        );

        return $this->toModel($response);
    }

    /**
     * Creates or updates an asset for a theme.
     */
    public function delete(string $key): void
    {
        $this->client->delete($this->uri(), [
            'asset' => ['key' => $key],
        ]);
    }

    /**
     * Create/update an asset with the given string.
     */
    public function upload(string $key, string $value): Asset
    {
        return $this->createOrUpdate([
            'key' => $key,
            'value' => $value,
        ]);
    }

    /**
     * Create/update an asset by providing a base64-encoded attachment.
     */
    public function uploadFromBase64(string $key, string $attachment): Asset
    {
        return $this->createOrUpdate([
            'key' => $key,
            'attachment' => $attachment,
        ]);
    }

    /**
     * Duplicate an existing asset by providing a source key.
     */
    public function duplicate(string $original, string $target): Asset
    {
        return $this->createOrUpdate([
            'key' => $original,
            'source_key' => $target,
        ]);
    }
}
