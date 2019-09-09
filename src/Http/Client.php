<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Http;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Strawberry\Shopify\Exceptions\HttpException;

final class Client
{
    private $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Makes a request to the Shopify API.
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

            $response = $this->httpClient->send($request, [
                'query' => $query,
                'json' => $json,
            ]);
        } catch (RequestException $exception) {
            throw HttpException::failedRequest($exception);
        }

        return new Response(
            (string) $response->getBody(),
            $response->getStatusCode(),
            $response->getHeaders()
        );
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
    public function delete(string $url, array $headers = []): Response
    {
        return $this->request('DELETE', $url, [], [], $headers);
    }
}
