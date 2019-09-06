<?php

namespace Strawberry\Shopify\Tests\Unit\Models;

use DateTime;
use Carbon\Carbon;
use Strawberry\Shopify\Tests\TestCase;
use Illuminate\Contracts\Support\Arrayable;
use Strawberry\Shopify\Models\Concerns\HasAttributes;

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
    public function it_is_fillable_with_arrayable(): void
    {
        $stub = new HasAttributesStub;

        $stub->fill(new ArrayableStub);

        $this->assertSame([
            'name' => 'foo',
            'age' => 'bar'
        ], $stub->getAttributes());
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

    /**
     * @dataProvider dateValues
     * @test
     */
    public function it_gets_dates_as_carbon_instances($date): void
    {
        $stub = new HasAttributesStub;
        $carbon = new \Carbon\Carbon('2019-01-01');

        $stub->fill(['created_at' => $date]);
        $this->assertEquals($carbon, $stub->getAttribute('created_at'));
    }

    public function dateValues(): array
    {
        return [
            [new Carbon('2019-01-01')], // Carbon instance
            [new DateTime('2019-01-01')], // DateTimeInterface
            [1546300800], // Timestamp
            ['2019-01-01'],  // String
        ];
    }
}

final class HasAttributesStub
{
    use HasAttributes;
}

final class ArrayableStub implements Arrayable
{
    public function toArray(): array
    {
        return [
            'name' => 'foo',
            'age' => 'bar'
        ];
    }
}
