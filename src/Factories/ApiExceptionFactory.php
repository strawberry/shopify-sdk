<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Factories;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Strawberry\Shopify\Exceptions\Api\ApiException;
use Strawberry\Shopify\Exceptions\Api\RateLimitExceeded;

final class ApiExceptionFactory
{
    /** @var Exception */
    private $exception;

    /**
     * A list of status codes and the exceptions that should be thrown.
     *
     * @var array
     */
    protected $map = [
        429 => RateLimitExceeded::class,
    ];

    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
    }

    public function map(): Exception
    {
        if (! $this->exception instanceof GuzzleException) {
            return $this->exception;
        }

        if (! $this->hasMappedException()) {
            return new ApiException($this->exception);
        }

        return $this->mapException();
    }

    private function hasMappedException(): bool
    {
        return array_key_exists(
            $this->exception->getCode(),
            $this->map
        );
    }

    private function mapException(): void
    {
        $exception = $this->map[$this->exception->getCode()];

        throw new $exception($this->exception);
    }

    public static function make(Exception $exception): Exception
    {
        return (new static($exception))->map();
    }
}
