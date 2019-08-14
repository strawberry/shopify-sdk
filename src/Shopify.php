<?php

namespace Strawberry\Shopify;

final class Shopify
{
    /**
     * Configuration for the SDK.
     * @var array
     */
    private $config = [];

    public function __construct(array $config)
    {
        $this->config = $config;
    }
}
