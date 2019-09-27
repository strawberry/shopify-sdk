<?php

namespace Strawberry\Shopify\Tests\Unit\Factories;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Factories\CollectionFactory;
use Strawberry\Shopify\Tests\TestCase;

final class CollectionFactoryTest extends TestCase
{
    public function testReturnsArrayByDefault(): void
    {
        $items = CollectionFactory::make([]);

        $this->assertIsArray($items);
    }

    public function testReturnsInstanceOfConfiguredCollection(): void
    {
        CollectionFactory::configure(Collection::class);

        $items = CollectionFactory::make([]);

        $this->assertInstanceOf(Collection::class, $items);
    }

    public static function tearDownAfterClass(): void
    {
        CollectionFactory::configure('array');
    }
}
