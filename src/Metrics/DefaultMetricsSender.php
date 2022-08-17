<?php

namespace Unleash\Client\Metrics;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Unleash\Client\Configuration\UnleashConfiguration;
use Unleash\Client\Helper\StringStream;

final class DefaultMetricsSender implements MetricsSender
{
    /**
     * @readonly
     * @var \Psr\Http\Client\ClientInterface
     */
    private $httpClient;
    /**
     * @readonly
     * @var \Psr\Http\Message\RequestFactoryInterface
     */
    private $requestFactory;
    /**
     * @readonly
     * @var \Unleash\Client\Configuration\UnleashConfiguration
     */
    private $configuration;
    public function __construct(ClientInterface $httpClient, RequestFactoryInterface $requestFactory, UnleashConfiguration $configuration)
    {
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->configuration = $configuration;
    }
    /**
     * @param \Unleash\Client\Metrics\MetricsBucket $bucket
     * @return void
     */
    public function sendMetrics($bucket)
    {
        if (!$this->configuration->isMetricsEnabled() || !$this->configuration->isFetchingEnabled()) {
            return;
        }

        $request = $this->requestFactory
            ->createRequest('POST', $this->configuration->getUrl() . 'client/metrics')
            ->withHeader('Content-Type', 'application/json')
            ->withBody(new StringStream(json_encode([
                'appName' => $this->configuration->getAppName(),
                'instanceId' => $this->configuration->getInstanceId(),
                'bucket' => $bucket->jsonSerialize(),
            ], 0)));
        foreach ($this->configuration->getHeaders() as $name => $value) {
            $request = $request->withHeader($name, $value);
        }
        $this->httpClient->sendRequest($request);
    }
}
