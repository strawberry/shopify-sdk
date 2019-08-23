<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Http;

final class Response
{
    /** @var string */
    private $content;

    /** @var int */
    private $statusCode;

    /** @var array */
    private $headers;

    public function __construct(
        string $content,
        int $statusCode,
        array $headers = []
    ) {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public function getContent(): array
    {
        return json_decode($this->content, true);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Returns as true if the status code is in the 2XX or 3XX region
     * of status codes.
     */
    public function ok(): bool
    {
        return $this->getStatusCode() < 400;
    }

    /**
     * Returns as true if the response was not a success.
     */
    public function error(): bool
    {
        return ! $this->ok();
    }
}
