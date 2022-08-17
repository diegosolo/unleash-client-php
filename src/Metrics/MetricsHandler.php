<?php

namespace Unleash\Client\Metrics;

use Unleash\Client\DTO\Feature;
use Unleash\Client\DTO\Variant;

interface MetricsHandler
{
    /**
     * @param \Unleash\Client\DTO\Feature $feature
     * @param bool $successful
     * @param \Unleash\Client\DTO\Variant|null $variant
     */
    public function handleMetrics($feature, $successful, $variant = null): void;
}
