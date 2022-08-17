<?php

namespace Unleash\Client\Strategy;

use Unleash\Client\Configuration\Context;
use Unleash\Client\DTO\Strategy;

final class UserIdStrategyHandler extends AbstractStrategyHandler
{
    /**
     * @param \Unleash\Client\DTO\Strategy $strategy
     * @param \Unleash\Client\Configuration\Context $context
     */
    public function isEnabled($strategy, $context): bool
    {
        if (!$userIds = $this->findParameter('userIds', $strategy)) {
            return false;
        }
        if ($context->getCurrentUserId() === null) {
            return false;
        }

        $userIds = array_map('trim', explode(',', $userIds));

        $enabled = in_array($context->getCurrentUserId(), $userIds, true);

        if (!$enabled) {
            return false;
        }
        if (!$this->validateConstraints($strategy, $context)) {
            return false;
        }

        return true;
    }

    public function getStrategyName(): string
    {
        return 'userWithId';
    }
}
