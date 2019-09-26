<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Middleware;

use Closure;
use Illuminate\Http\Request;
use Strawberry\Shopify\Services\VerificationService;

final class VerifyShopifyWebhook
{
    /** @var VerificationService */
    private $verification;

    public function __construct(VerificationService $verification)
    {
        $this->verification = $verification;
    }

    /**
     * @return  mixed
     *
     * @throws  InvalidShopifyRequest
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $this->verification->verifyRequest($request)) {
            throw InvalidShopifyRequest::hmacDoesNotMatch($request);
        }

        return $next($request);
    }
}
