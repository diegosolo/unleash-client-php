<?php

namespace Unleash\Client\Metrics;

interface MetricsSender
{
    /**
     * @param \Unleash\Client\Metrics\MetricsBucket $bucket
     */
    public function sendMetrics($bucket): void;
}
