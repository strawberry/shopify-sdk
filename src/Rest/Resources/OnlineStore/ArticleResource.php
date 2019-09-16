<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Models\OnlineStore\Article;

final class ArticleResource extends ChildResource
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
     * Retrieves a list all of article authors.
     */
    public function authors(): array
    {
        $response = $this->client->get('articles/authors.json');

        return $this->data($response, 'authors');
    }

    /**
     * Retrieves a list of all the tags.
     */
    public function tags(array $options = []): array
    {
        $response = $this->client->get('articles/tags.json', $options);

        return $this->data($response, 'tags');
    }
}
