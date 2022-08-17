<?php

namespace Unleash\Client\Metrics;

use Unleash\Client\DTO\Feature;
use Unleash\Client\DTO\Variant;

/**
 * @internal
 */
final class MetricsBucketToggle
{
    /**
     * @readonly
     * @var \Unleash\Client\DTO\Feature
     */
    private $feature;
    /**
     * @readonly
     * @var bool
     */
    private $success;
    /**
     * @readonly
     * @var \Unleash\Client\DTO\Variant|null
     */
    private $variant;
    /**
     * @param \Unleash\Client\DTO\Variant|null $variant
     */
    public function __construct(Feature $feature, bool $success, $variant = null)
    {
        $this->feature = $feature;
        $this->success = $success;
        $this->variant = $variant;
    }
    public function getFeature(): Feature
    {
        return $this->feature;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @return \Unleash\Client\DTO\Variant|null
     */
    public function getVariant()
    {
        return $this->variant;
    }
}
