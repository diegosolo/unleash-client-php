<?php

namespace Unleash\Client\Strategy;

use Unleash\Client\Configuration\Context;
use Unleash\Client\DTO\Strategy;

interface StrategyHandler
{
    /**
     * @param \Unleash\Client\DTO\Strategy $strategy
     */
    public function supports($strategy): bool;

    public function getStrategyName(): string;

    /**
     * @param \Unleash\Client\DTO\Strategy $strategy
     * @param \Unleash\Client\Configuration\Context $context
     */
    public function isEnabled($strategy, $context): bool;
}
