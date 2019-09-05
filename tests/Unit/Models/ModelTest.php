<?php

namespace Strawberry\Shopify\Tests\Unit\Models;

use Strawberry\Shopify\Models\Model;
use Strawberry\Shopify\Tests\TestCase;

final class ModelTest extends TestCase
{
    /** @test */
    public function it_fills_attributes_from_constructor(): void
    {
        $attributes = [
            'name' => 'foo',
            'age' => 'bar'
        ];

        $stub = new ModelStub($attributes);

        $this->assertSame($attributes, $stub->getAttributes());
    }

    /** @test */
    public function it_gets_attributes_as_properties(): void
    {
        $stub = new ModelStub(['name' => 'foo', 'age' => 'bar']);

        $this->assertSame('foo', $stub->name);
        $this->assertSame('bar', $stub->age);
    }

    /** @test */
    public function it_casts_to_array(): void
    {
        $attributes = ['name' => 'foo', 'age' => 'bar'];

        $stub = new ModelStub($attributes);

        $this->assertEquals($attributes, $stub->toArray());
    }
}

final class ModelStub extends Model
{
}
