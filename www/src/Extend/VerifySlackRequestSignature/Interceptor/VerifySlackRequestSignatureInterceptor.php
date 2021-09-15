<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\VerifySlackRequestSignature\Interceptor;

use BEAR\Resource\Code;
use Fer\Deli\Extend\VerifySlackRequestSignature\Exception;
use Psr\Http\Message\ServerRequestInterface;
use Ray\Aop\MethodInterceptor;
use Ray\Aop\MethodInvocation;
use Ray\Di\Di\Named;

use function hash_hmac;
use function sprintf;

final class VerifySlackRequestSignatureInterceptor implements MethodInterceptor
{
    private const HEADER_TIMESTAMP = 'X-Slack-Request-Timestamp';
    private const HEADER_SIGNATURE = 'X-Slack-Signature';

    #[Named('signingSecret=slack_signing_secret')]
    public function __construct(
        private ServerRequestInterface $request,
        private string $signingSecret
    ) {
    }

    public function invoke(MethodInvocation $invocation): mixed
    {
        $signature = $this->hashAndFormatSignature(
            $this->formatSignatureBaseString(
                $this->request->getHeaderLine(self::HEADER_TIMESTAMP),
                (string) $this->request->getBody()
            )
        );

        if ($signature !== $this->request->getHeaderLine(self::HEADER_SIGNATURE)) {
            throw new Exception\VerifySlackRequestSignatureException('signature error.', Code::ERROR);
        }

        return $invocation->proceed();
    }

    private function formatSignatureBaseString(string $timestamp, string $requestBody): string
    {
        return sprintf('v0:%s:%s', $timestamp, $requestBody);
    }

    private function hashAndFormatSignature(string $baseString): string
    {
        return sprintf('v0=%s', hash_hmac('sha256', $baseString, $this->signingSecret));
    }
}
