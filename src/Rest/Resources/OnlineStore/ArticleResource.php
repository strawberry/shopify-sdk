<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\OnlineStore;

use Strawberry\Shopify\Models\OnlineStore\Article;
use Strawberry\Shopify\Rest\Resource;

final class ArticleResource extends Resource
{
    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Retrieves a list all article authors.
     *
     * @return string[]
     */
    public function authors(): array
    {
        $response = $this->client->get(
            $this->uri('authors')
        );

        return $this->data($response, 'authors');
    }

    /**
     * Retrieves a list of all tags for all articles.
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
