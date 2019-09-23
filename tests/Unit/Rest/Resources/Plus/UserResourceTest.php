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
}
