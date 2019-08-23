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
        array $params = [],
        array $data = [],
        array $headers = []
    ): Response {
        try {
            $request = new Request($method, $url, $headers);

            $response = $this->httpClient->send($request, [
                'query' => $params,
                'form_params' => $data,
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
        array $params = [],
        array $headers = []
    ): Response {
        return $this->request('GET', $url, $params, [], $headers);
    }
}
