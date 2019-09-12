<?php

namespace Strawberry\Shopify\Tests\Unit\Models;

use Strawberry\Shopify\Models\Model;
use Strawberry\Shopify\Tests\TestCase;

final class ModelTest extends TestCase
{
    public function testCastsToModel(): void
    {
        $model = new ModelStub([
            'model' => [
                'first_name' => 'foo',
                'last_name' => 'bar',
            ]
        ]);

        $this->assertInstanceOf(ModelStub::class, $model->model);
        $this->assertSame('foo', $model->model->first_name);
        $this->assertSame('bar', $model->model->last_name);
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
}

final class ModelStub extends Model
{
    protected $casts = ['model' => ModelStub::class];
    protected $castArrays = ['array' => ModelStub::class];
}
