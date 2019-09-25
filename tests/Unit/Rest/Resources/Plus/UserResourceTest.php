<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources\Plus;

use Strawberry\Shopify\Models\Plus\User;
use Strawberry\Shopify\Rest\Resources\Plus\UserResource;
use Strawberry\Shopify\Tests\Unit\Rest\Resources\ResourceTestCase;

final class UserResourceTest extends ResourceTestCase
{
    /** @var string */
    protected $modelClass = User::class;

    /** @var string */
    protected $resourceClass = UserResource::class;

    /** @var string */
    protected $dataPath = 'plus/user';

    public function testGet(): void
    {
        $this->queue(200, [], $this->response('get'));

        $response = $this->resource->get();

        $this->assertRequest('GET', 'users.json');
        $this->assertCollection($response, 2);
    }

    public function testFind(): void
    {
        $this->queue(200, [], $this->response('find'));

        $response = $this->resource->find(799407056);

        $this->assertRequest('GET', 'users/799407056.json');
        $this->assertModel($response);
    }

    public function testCurrent(): void
    {
        $this->queue(200, [], $this->response('current'));

        $response = $this->resource->current();

        $this->assertRequest('GET', 'users/current.json');
        $this->assertModel($response);
    }
}
