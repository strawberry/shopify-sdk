<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Models\OnlineStore\Article;
use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Rest\Concerns;

final class BlogArticleResource extends ChildResource
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
    protected $model = Article::class;

    /**
     * The parent resource for this resource.
     *
     * @var string
     */
    protected $parent = BlogResource::class;

    /**
     * Retrieves a list of all tags from a specific blog.
     *
     * @return string[]
     */
    public function tags(array $options = []): array
    {
        $response = $this->client->get(
            $this->uri('tags'),
            $options
        );

        return $this->data($response, 'tags');
    }
}
