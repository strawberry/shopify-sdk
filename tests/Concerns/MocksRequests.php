<?php

namespace Strawberry\Shopify\Tests\Concerns;

trait MocksRequests
{
    protected function request(string $key): ?array
    {
        $data = $this->data("data/{$this->dataPath}/{$key}_request.json");

        return json_decode($data, true);
    }

    protected function response(string $key): string
    {
        return $this->data("data/{$this->dataPath}/{$key}_response.json");
    }
}
