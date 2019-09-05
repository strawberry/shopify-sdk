<?php

namespace Strawberry\Shopify\Tests\Unit\Models;

use Strawberry\Shopify\Models\Concerns\HasAttributes;
use Strawberry\Shopify\Tests\TestCase;

final class HasAttributesTest extends TestCase
{
    /** @test */
    public function it_is_fillable(): void
    {
        $stub = new HasAttributesStub;
        $attributes = [
            'name' => 'foo',
            'age' => 'bar'
        ];

        $stub->fill($attributes);

        $this->assertSame($attributes, $stub->getAttributes());
    }

    /** @test */
    public function it_gets_attributes(): void
    {
        $stub = new HasAttributesStub;

        $stub->fill(['name' => 'foo', 'age' => 'bar']);

        $this->assertSame('foo', $stub->getAttribute('name'));
        $this->assertSame('bar', $stub->getAttribute('age'));
    }

    /** @test */
    public function it_returns_null_for_nonexistent_attributes(): void
    {
        $stub = new HasAttributesStub;

        $stub->fill(['bar' => 'abc']);

        $this->assertNull($stub->getAttribute('foo'));
        $this->assertNotNull($stub->getAttributes('bar'));
    }

    /** @test */
    public function it_determines_date_time_columns(): void
    {
        $stub = new HasAttributesStub;

        $this->assertFalse($stub->isDateTime('name'));
        $this->assertTrue($stub->isDateTime('created_at'));
    }

    /** @test */
    public function it_gets_dates_as_carbon_instances(): void
    {
        $stub = new HasAttributesStub;
        $carbon = new \Carbon\Carbon('2019-01-01');

        $stub->fill(['created_at' => '2019-01-01']);

        $this->assertEquals($carbon, $stub->getAttribute('created_at'));
    }
}

final class HasAttributesStub
{
    use HasAttributes;
}
