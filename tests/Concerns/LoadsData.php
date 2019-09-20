<?php

namespace Strawberry\Shopify\Tests\Concerns;

trait LoadsData
{
    protected function data(string $file): string
    {
        return file_get_contents($this->base . $file);
    }
}
