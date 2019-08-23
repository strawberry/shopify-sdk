<?php

namespace Strawberry\Shopify;

use Strawberry\Shopify\Exceptions\ClientException;
use Strawberry\Shopify\Rest\Client;

class Shopify
{
    /**
     * Configuration for the SDK.
     *
     * @var array
     */
    private $config = [];

    /**
     * The Shopify REST client instance.
     *
     * @var Client
     */
    private $client;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Set up the REST client.
     *
     * @throws ClientException
     */
    private function setupClient(): Client
    {
        if ($this->isPublicApp()) {
            return Client::forPublicApp($this->config);
        }

        if ($this->isPrivateApp()) {
            return Client::forPrivateApp($this->config);
        }

        throw ClientException::credentialsNotSet();
    }

    /**
     * Determine whether we're connecting to the Shopify API with
     * private application credentials.
     *
     * @return bool
     */
    public function isPrivateApp(): bool
    {
        if (empty($this->config['api_key'])) {
            return false;
        }

        if (empty($this->config['api_password'])) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether we're connecting to the Shopify API with
     * public application credentials.
     *
     * @return bool
     */
    public function isPublicApp(): bool
    {
        return ! empty($this->config['access_token']);
    }

    /**
     * Returns an instance of the REST client.
     *
     * @throws ClientException
     */
    public function getClient(): Client
    {
        if (is_null($this->client)) {
            $this->client = $this->setupClient();
        }

        return $this->client;
    }

    /**
     * Magic method to lazily pass on calls to the REST client.
     *
     * @return mixed
     */
    public function __call(string $method, array $params)
    {
        return $this->getClient()->{$method}(...$params);
    }
}
