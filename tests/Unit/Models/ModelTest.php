<?php

namespace Strawberry\Shopify\Tests\Unit\Models;

use Illuminate\Support\Collection;
use Strawberry\Shopify\Tests\TestCase;
use Strawberry\Shopify\Tests\Unit\Models\Stubs\ModelStub;
use Strawberry\Shopify\Tests\Unit\Models\Stubs\CastModelStub;

final class ModelTest extends TestCase
{
    public function testMutator(): void
    {
        $model = new ModelStub();

        $this->assertSame('Hello, world!', $model->test_mutator);
    }

    public function testCastsToModel(): void
    {
        $model = new ModelStub([
            'model' => ['first_name' => 'foo']
        ]);

        $this->assertInstanceOf(ModelStub::class, $model->model);
        $this->assertSame('foo', $model->model->first_name);
    }

    public function testNormalCasts(): void
    {
        $model = new CastModelStub();

        $model->string = null;
        $this->assertNull($model->string);

        $model->int = '1';
        $model->integer = '1';
        $this->assertSame(1, $model->int);
        $this->assertSame(1, $model->integer);

        $model->real = '1.23';
        $model->float = '1.23';
        $model->double = '1.23';
        $this->assertSame(1.23, $model->real);
        $this->assertSame(1.23, $model->float);
        $this->assertSame(1.23, $model->double);

        $model->string = 1.23;
        $this->assertSame('1.23', $model->string);

        $model->bool = ['true'];
        $model->boolean = ['true'];
        $this->assertTrue($model->bool);
        $this->assertTrue($model->boolean);

        $model->bool = [];
        $model->boolean = [];
        $this->assertFalse($model->bool);
        $this->assertFalse($model->boolean);

        $model->object = ['foo' => 'bar'];
        $this->assertIsObject($model->object);
        $this->assertSame('bar', $model->object->foo);

        $model->array = ['foo' => 'bar'];
        $model->json = ['foo' => 'bar'];
        $this->assertIsArray($model->array);
        $this->assertIsArray($model->json);
        $this->assertSame('bar', $model->array['foo']);
        $this->assertSame('bar', $model->json['foo']);

        $model->collection = [['foo' => 'bar'], ['baz' => 'qux']];
        $this->assertInstanceOf(Collection::class, $model->collection);
        $this->assertCount(2, $model->collection);

        $model->default = 'Hello, world!';
        $this->assertSame('Hello, world!', $model->default);
    }

    public function testDoesntCastToNonExistentModel(): void
    {
        $model = new ModelStub([
            'foo' => ['first_name' => 'bar']
        ]);

        $this->assertIsArray($model->foo);
        $this->assertSame(['first_name' => 'bar'], $model->foo);
    }

    public function testCastsToModelArray(): void
    {
        $model = new ModelStub([
            'array' => [
                ['first_name' => 'foo'],
                ['first_name' => 'bar'],
                ['first_name' => 'baz'],
            ]
        ]);

        $this->assertIsArray($model->array);
        $this->assertCount(3, $model->array);
        $this->assertContainsOnlyInstancesOf(ModelStub::class, $model->array);
    }

    public function testDoesntCastArrayToNonExistentModel(): void
    {
        $model = new ModelStub([
            'bar' => [
                ['first_name' => 'baz'],
                ['first_name' => 'qux'],
            ]
        ]);

        $this->assertIsArray($model->bar);
        $this->assertCount(2, $model->bar);
    }
}
