<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Services;

use Illuminate\Http\Request;

final class VerificationService
{
    /**
     * The shared secret for signing the HMAC.
     *
     * @var string
     */
    private $sharedSecret;

    public function __construct(string $sharedSecret)
    {
        $this->sharedSecret = $sharedSecret;
    }

    /**
     * Verify the given content matches the HMAC and has come from the
     * configured Shopify store.
     */
    public function verify(string $content, string $hmac): bool
    {
        return md5($hmac) === $this->hash($content);
    }

    /**
     * Verify the incoming request came from the configured Shopify store.
     */
    public function verifyRequest(Request $request): bool
    {
        return $this->verify(
            $request->getContent(),
            $request->header('X-Shopify-Hmac-Sha256')
        );
    }

    private function hash(string $data): string
    {
        $hmac = base64_encode(hash_hmac(
            'sha256',
            $data,
            $this->sharedSecret,
            true
        ));

        return md5($hmac);
    }
}
