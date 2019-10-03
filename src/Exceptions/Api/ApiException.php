<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Exceptions\Api;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ApiException extends \Exception
{
    /** @var RequestInterface */
    protected $request;

    /** @var ResponseInterface */
    protected $response;

    public function __construct(GuzzleException $exception)
    {
        parent::__construct('', $exception->getCode(), $exception);

        $this->request = $exception->getRequest();
        $this->response = $exception->getResponse();
    }
}
