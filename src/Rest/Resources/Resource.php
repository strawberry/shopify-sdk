<?php

namespace Strawberry\Shopify\Rest\Resources;

use Strawberry\Shopify\Rest\Client;

abstract class Resource
{
    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
