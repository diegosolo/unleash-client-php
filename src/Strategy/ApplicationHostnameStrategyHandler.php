<?php

namespace Unleash\Client\Strategy;

use Unleash\Client\Configuration\Context;
use Unleash\Client\DTO\Strategy;

final class ApplicationHostnameStrategyHandler extends AbstractStrategyHandler
{
    public function getStrategyName(): string
    {
        return 'applicationHostname';
    }

    /**
     * @param \Unleash\Client\DTO\Strategy $strategy
     * @param \Unleash\Client\Configuration\Context $context
     */
    public function isEnabled($strategy, $context): bool
    {
        if (!$hostnames = $this->findParameter('hostNames', $strategy)) {
            return false;
        }

        $hostnames = array_map('trim', explode(',', $hostnames));
        $enabled = in_array($context->getHostname(), $hostnames, true);

        if (!$enabled) {
            return false;
        }

        if (!$this->validateConstraints($strategy, $context)) {
            return false;
        }

        return true;
    }
}
