<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Models\OnlineStore\Blog;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

final class BlogResource extends Resource
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
    protected $model = Blog::class;

    /**
     * A list of the child resources.
     *
     * @var string[]
     */
    protected $childResources = [
        'articles' => BlogArticleResource::class,
    ];
}
