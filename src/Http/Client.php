<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Http;

use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use Strawberry\Shopify\Exceptions\Api\RateLimitExceeded;
use Strawberry\Shopify\Exceptions\SdkException;
use Strawberry\Shopify\Factories\ApiExceptionFactory;

final class Client
{
    /** @var ClientInterface */
    private $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Makes a request to the Shopify API.
     *
     * @throws ApiException
     */
    public function request(
        string $method,
        string $url,
        array $query = [],
        array $json = [],
        array $headers = []
    ): Response {
        try {
            $request = new Request($method, $url, $headers);
            $options = array_filter(compact('query', 'json'));

            return $this->sendRequest($request, $options);
        } catch (RateLimitExceeded $exception) {
            usleep($exception->retryAfter());

            return $this->request($method, $url, $query, $json, $headers);
        }
    }

    /**
     * Sends a request to the API. If an error response is received, the most
     * relevant exception is thrown.
     *
     * @throws ApiException
     */
    private function sendRequest(Request $request, array $options): Response
    {
        try {
            $response = $this->httpClient->send($request, $options);

            return new Response(
                (string) $response->getBody(),
                $response->getStatusCode(),
                $response->getHeaders()
            );
        } catch (Exception $exception) {
            throw ApiExceptionFactory::make($exception);
        }
    }

    /**
     * Helper method for GET requests to the Shopify API.
     */
    public function get(
        string $url,
        array $query = [],
        array $headers = []
    ): Response {
        return $this->request('GET', $url, $query, [], $headers);
    }

    /**
     * Helper method for POST requests to the Shopify API.
     */
    public function post(
        string $url,
        array $json = [],
        array $query = [],
        array $headers = []
    ): Response {
        return $this->request('POST', $url, $query, $json, $headers);
    }

    /**
     * Helper method for PUT requests to the Shopify API.
     */
    public function put(
        string $url,
        array $json = [],
        array $query = [],
        array $headers = []
    ): Response {
        return $this->request('PUT', $url, $query, $json, $headers);
    }

    /**
     * Helper method for PATCH requests to the Shopify API.
     */
    public function patch(
        string $url,
        array $json = [],
        array $query = [],
        array $headers = []
    ): Response {
        return $this->request('PATCH', $url, $query, $json, $headers);
    }

    /**
     * Helper method for DELETE requests to the Shopify API.
     */
    public function delete(
        string $url,
        array $headers = [],
        array $query = []
    ): Response {
        return $this->request('DELETE', $url, $query, [], $headers);
    }
}
