<?php

namespace Unleash\Client\Client;

use DateTimeImmutable;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Unleash\Client\Configuration\UnleashConfiguration;
use Unleash\Client\Enum\CacheKey;
use Unleash\Client\Helper\StringStream;
use Unleash\Client\Strategy\StrategyHandler;
use Unleash\Client\Unleash;

final class DefaultRegistrationService implements RegistrationService
{
    public function __construct(
        private readonly ClientInterface $httpClient,
        private readonly RequestFactoryInterface $requestFactory,
        private readonly UnleashConfiguration $configuration,
        private ?string $sdkName = null,
        private ?string $sdkVersion = null,
    ) {
        $this->sdkName ??= 'unleash-client-php';
        $this->sdkVersion ??= Unleash::SDK_VERSION;
    }

    /**
     * @param iterable<StrategyHandler> $strategyHandlers
     *
     * @throws JsonException
     * @throws ClientExceptionInterface
     */
    public function register(iterable $strategyHandlers): bool
    {
        if (!$this->configuration->isFetchingEnabled()) {
            return false;
        }
        if ($this->hasValidCacheRegistration()) {
            return true;
        }
        if (!is_array($strategyHandlers)) {
            $strategyHandlers = iterator_to_array($strategyHandlers);
        }
        $request = $this->requestFactory
            ->createRequest('POST', $this->configuration->getUrl() . 'client/register')
            ->withHeader('Content-Type', 'application/json')
            ->withBody(new StringStream(json_encode([
                'appName' => $this->configuration->getAppName(),
                'instanceId' => $this->configuration->getInstanceId(),
                'sdkVersion' => $this->sdkName . ':' . $this->sdkVersion,
                'strategies' => array_map(function (StrategyHandler $strategyHandler): string {
                    return $strategyHandler->getStrategyName();
                }, $strategyHandlers),
                'started' => (new DateTimeImmutable())->format('c'),
                'interval' => $this->configuration->getMetricsInterval(),
            ], JSON_THROW_ON_ERROR)));
        foreach ($this->configuration->getHeaders() as $name => $value) {
            $request = $request->withHeader($name, $value);
        }
        $response = $this->httpClient->sendRequest($request);

        $result = $response->getStatusCode() >= 200 && $response->getStatusCode() < 300;
        $this->storeCache($result);

        return $result;
    }

    private function hasValidCacheRegistration(): bool
    {
        $cache = $this->configuration->getCache();
        if (!$cache->has(CacheKey::REGISTRATION)) {
            return false;
        }

        return (bool) $cache->get(CacheKey::REGISTRATION);
    }

    private function storeCache(bool $result): void
    {
        $this->configuration->getCache()->set(CacheKey::REGISTRATION, $result, $this->configuration->getTtl());
    }
}
