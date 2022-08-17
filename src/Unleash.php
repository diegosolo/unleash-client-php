<?php

namespace Unleash\Client;

use Unleash\Client\Configuration\Context;
use Unleash\Client\DTO\Variant;

interface Unleash
{
    public const SDK_VERSION = '1.7.0';

    /**
     * @param string $featureName
     * @param \Unleash\Client\Configuration\Context|null $context
     * @param bool $default
     */
    public function isEnabled($featureName, $context = null, $default = false): bool;

    /**
     * @param string $featureName
     * @param \Unleash\Client\Configuration\Context|null $context
     * @param \Unleash\Client\DTO\Variant|null $fallbackVariant
     */
    public function getVariant($featureName, $context = null, $fallbackVariant = null): Variant;

    public function register(): bool;
}
