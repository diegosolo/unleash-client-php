<?php

namespace Unleash\Client\Metrics;

interface MetricsSender
{
    /**
     * @param \Unleash\Client\Metrics\MetricsBucket $bucket
     * @return void
     */
    public function sendMetrics($bucket);
}
