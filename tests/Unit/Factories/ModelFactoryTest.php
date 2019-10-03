<?php

namespace Strawberry\Shopify\Tests\Unit\Factories;

use Strawberry\Shopify\Factories\ModelFactory;
use Strawberry\Shopify\Models\Store\Shop;
use Strawberry\Shopify\Tests\Stubs\Models\ModelStub;
use Strawberry\Shopify\Tests\TestCase;

final class ModelFactoryTest extends TestCase
{
    public function testReturnsInstanceOfPassedModelWhenNoMappingExists(): void
    {
        $model = ModelFactory::make(Shop::class, ['foo' => 'bar']);

        $this->assertInstanceOf(Shop::class, $model);
    }

    public function testReturnsInstanceOfMappedModel(): void
    {
        ModelFactory::configure([
            Shop::class => ModelStub::class,
        ]);

        $model = ModelFactory::make(Shop::class, ['foo' => 'bar']);

        $this->assertInstanceOf(ModelStub::class, $model);
    }

    public static function tearDownAfterClass(): void
    {
        ModelFactory::configure([]);
    }
}
