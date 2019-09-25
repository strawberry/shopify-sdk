<?php

namespace Strawberry\Shopify\Tests\Unit\Rest\Resources;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use Strawberry\Shopify\Http\Client;
use Strawberry\Shopify\Rest\ChildResource;
use Strawberry\Shopify\Rest\Resource;
use Strawberry\Shopify\Tests\Concerns\MocksRequests;

abstract class ChildResourceTestCase extends ResourceTestCase
{
    use MocksRequests;

    /**
     * The stack of parent resources. Each item is an array with two values;
     * the parent resource and the ID for testing. The final item in the
     * array is the direct parent of the resource that's being tested.
     *
     * @var array[]
     */
    protected $parentResources = [
        ['Grandparent', 1],
        ['Parent', 2],
    ];

    public function setUpTestCase(): void
    {
        $this->mockHandler = new MockHandler();
        $this->client = new Client(new GuzzleHttpClient([
            'handler' => HandlerStack::create($this->mockHandler),
            'allow_redirects' => true,
        ]));

        $this->resource = $this->setUpResource();
    }

    private function setUpResource(): ChildResource
    {
        [$parent, $parentId] = $this->setUpParentResource();

        $resourceClass = $this->resourceClass;
        return new $resourceClass($this->client, $parent, $parentId);
    }

    private function setUpParentResource(): array
    {
        return array_reduce($this->parentResources, function (
            ?array $parent,
            array $item
        ) {
            [$resource, $id] = $item;

            $resource = $parent
                ? new $resource($this->client, ...$parent)
                : new $resource($this->client);

            return [$resource, $id];
        });
    }
}
