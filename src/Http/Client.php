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
        string $body = '',
        array $formParams = [],
        array $headers = []
    ): Response {
        try {
            $request = new Request($method, $url, $headers);

            $response = $this->httpClient->send($request, [
                'query' => $query,
                'form_params' => $formParams,
                'body' => $body
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
        return $this->request('GET', $url, $query, "", [], $headers);
    }

    /**
     * Helper method for POST requests to the Shopify API.
     */
    public function post(
        string $url,
        string $body = "",
        array $query = [],
        array $formParams = [],
        array $headers = []
    ): Response {
        return $this->request('POST', $url, $query, $body, $formParams, $headers);
    }
}
