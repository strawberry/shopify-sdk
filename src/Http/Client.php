<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Http;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;
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

            $response = $this->httpClient->send($request, array_filter([
                'query' => $query,
                'json' => $json,
            ]));
        } catch (ClientException | ServerException $exception) {
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
    public function delete(
        string $url,
        array $headers = [],
        array $query = []
    ): Response {
        return $this->request('DELETE', $url, $query, [], $headers);
    }
}
