<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest\Resources\OnlineStore;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Models\OnlineStore\Comment;
use Strawberry\Shopify\Rest\Concerns;
use Strawberry\Shopify\Rest\Resource;

final class CommentResource extends Resource
{
    use Concerns\ListsResource,
        Concerns\FindsResource,
        Concerns\CreatesResource,
        Concerns\UpdatesResource,
        Concerns\CountsResource;

    /**
     * The model that represents this resource.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Retrieve all the comments for a certain article of a blog.
     *
     * @return mixed
     */
    public function getForArticle(
        int $article,
        int $blog,
        array $options = []
    ) {
        return $this->get(array_merge($options, [
            'article_id' => $article,
            'blog_id' => $blog,
        ]));
    }

    /**
     * Count all comments for a certain article of a blog.
     */
    public function countForArticle(
        int $article,
        int $blog,
        array $options = []
    ): int {
        return $this->count(array_merge($options, [
            'article_id' => $article,
            'blog_id' => $blog,
        ]));
    }

    /**
     * Retrieve all the comments for all the articles of a blog.
     *
     * @return mixed
     */
    public function getForBlog(int $blog, array $options = [])
    {
        return $this->get(array_merge($options, [
            'blog_id' => $blog,
        ]));
    }

    /**
     * Count all the comments for all the articles of a blog.
     */
    public function countForBlog(
        int $blog,
        array $options = []
    ): int {
        return $this->count(array_merge($options, [
            'blog_id' => $blog,
        ]));
    }

    /**
     * Marks a comment as spam.
     */
    public function markAsSpam(int $id): Comment
    {
        $response = $this->client->post(
            $this->uri("{$id}/spam")
        );

        return new Comment($response->getContent());
    }

    /**
     * Marks a comment as spam.
     */
    public function markAsNotSpam(int $id): Comment
    {
        $response = $this->client->post(
            $this->uri("{$id}/not_spam")
        );

        return new Comment($response->getContent());
    }

    /**
     * Approves a comment.
     */
    public function approve(int $id): Comment
    {
        $response = $this->client->post(
            $this->uri("{$id}/approve")
        );

        return new Comment($response->getContent());
    }

    /**
     * Removes a comment.
     */
    public function remove(int $id): Comment
    {
        $response = $this->client->post(
            $this->uri("{$id}/remove")
        );

        return new Comment($response->getContent());
    }

    /**
     * Restores a previously removed comment.
     */
    public function restore(int $id): Comment
    {
        $response = $this->client->post(
            $this->uri("{$id}/restore")
        );

        return new Comment($response->getContent());
    }
}
