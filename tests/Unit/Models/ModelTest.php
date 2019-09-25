<?php

namespace Strawberry\Shopify\Tests\Unit\Models;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Tests\TestCase;
use Strawberry\Shopify\Tests\Stubs\Models\ModelStub;

final class ModelTest extends TestCase
{
    /** @var ModelStub */
    private $model;

    public function setUpTestCase(): void
    {
        $this->model = new ModelStub([
            'model' => ['first_name' => 'foo'],
            'foo' => ['first_name' => 'bar'],
            'array_model' => [
                ['first_name' => 'foo'],
                ['first_name' => 'bar'],
                ['first_name' => 'baz'],
            ],
            'array_foo' => [
                ['first_name' => 'baz'],
                ['first_name' => 'qux'],
            ]
        ]);
    }

    public function testMutator(): void
    {
        $this->assertSame('Hello, world!', $this->model->test_mutator);
    }

    public function testCastsToModel(): void
    {
        $this->assertInstanceOf(ModelStub::class, $this->model->model);
        $this->assertSame('foo', $this->model->model->first_name);
    }

    public function testNormalCasts(): void
    {
        $this->model->string = null;
        $this->assertNull($this->model->string);

        $this->model->int = '1';
        $this->model->integer = '1';
        $this->assertSame(1, $this->model->int);
        $this->assertSame(1, $this->model->integer);

        $this->model->real = '1.23';
        $this->model->float = '1.23';
        $this->model->double = '1.23';
        $this->assertSame(1.23, $this->model->real);
        $this->assertSame(1.23, $this->model->float);
        $this->assertSame(1.23, $this->model->double);

        $this->model->string = 1.23;
        $this->assertSame('1.23', $this->model->string);

        $this->model->bool = ['true'];
        $this->model->boolean = ['true'];
        $this->assertTrue($this->model->bool);
        $this->assertTrue($this->model->boolean);

        $this->model->bool = [];
        $this->model->boolean = [];
        $this->assertFalse($this->model->bool);
        $this->assertFalse($this->model->boolean);

        $this->model->object = ['foo' => 'bar'];
        $this->assertIsObject($this->model->object);
        $this->assertSame('bar', $this->model->object->foo);

        $this->model->array = ['foo' => 'bar'];
        $this->model->json = ['foo' => 'bar'];
        $this->assertIsArray($this->model->array);
        $this->assertIsArray($this->model->json);
        $this->assertSame('bar', $this->model->array['foo']);
        $this->assertSame('bar', $this->model->json['foo']);

        $this->model->collection = [['foo' => 'bar'], ['baz' => 'qux']];
        $this->assertInstanceOf(Collection::class, $this->model->collection);
        $this->assertCount(2, $this->model->collection);

        $this->model->default = 'Hello, world!';
        $this->assertSame('Hello, world!', $this->model->default);
    }

    public function testDoesntCastToNonExistentModel(): void
    {
        $this->assertIsArray($this->model->foo);
        $this->assertSame(['first_name' => 'bar'], $this->model->foo);
    }

    public function testCastsToModelArray(): void
    {
        $this->assertIsArray($this->model->array_model);
        $this->assertCount(3, $this->model->array_model);
        $this->assertContainsOnlyInstancesOf(ModelStub::class, $this->model->array_model);
    }

    public function testDoesntCastArrayToNonExistentModel(): void
    {
        $this->assertIsArray($this->model->array_foo);
        $this->assertCount(2, $this->model->array_foo);
    }
}
