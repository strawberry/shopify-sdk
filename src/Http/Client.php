<?php

namespace Strawberry\Shopify\Http;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;

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
        }

        // If we received a bad response from the API we keep the response
        // data as we want the developer to be able to handle that from
        // within their application.
        catch (BadResponseException $exception) {
            $response = $exception->getResponse();
        }

        // Any other exception means something went wrong with the actual
        // request, so we want to let the user know about that.
        catch (Exception $exception) {
            throw HttpException::failedRequest($exception);
        }

        return new Response(
            $response->getBody()->getContents(),
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
