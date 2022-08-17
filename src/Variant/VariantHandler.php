<?php

namespace Unleash\Client\Variant;

use Unleash\Client\Configuration\Context;
use Unleash\Client\DTO\Feature;
use Unleash\Client\DTO\Variant;

interface VariantHandler
{
    public function getDefaultVariant(): Variant;

    /**
     * @param \Unleash\Client\DTO\Feature $feature
     * @param \Unleash\Client\Configuration\Context $context
     */
    public function selectVariant($feature, $context): ?Variant;
}
