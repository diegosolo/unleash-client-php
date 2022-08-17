<?php

namespace Unleash\Client\Strategy;

use JetBrains\PhpStorm\Deprecated;
use Unleash\Client\Configuration\Context;
use Unleash\Client\DTO\DefaultStrategy;
use Unleash\Client\DTO\Strategy;
use Unleash\Client\Enum\Stickiness;

#[Deprecated(reason: 'The strategy has been deprecated, please use Gradual Rollout (flexibleRollout)')]
final class GradualRolloutRandomStrategyHandler extends AbstractStrategyHandler
{
    /**
     * @readonly
     * @var \Unleash\Client\Strategy\GradualRolloutStrategyHandler
     */
    private $rolloutStrategyHandler;
    public function __construct(GradualRolloutStrategyHandler $rolloutStrategyHandler)
    {
        $this->rolloutStrategyHandler = $rolloutStrategyHandler;
    }

    /**
     * @param \Unleash\Client\DTO\Strategy $strategy
     * @param \Unleash\Client\Configuration\Context $context
     */
    public function isEnabled($strategy, $context): bool
    {
        $transformedStrategy = new DefaultStrategy(
            $this->getStrategyName(),
            [
                'stickiness' => Stickiness::RANDOM,
                'groupId' => $strategy->getParameters()['groupId'] ?? '',
                'rollout' => $strategy->getParameters()['percentage'],
            ]
        );

        return $this->rolloutStrategyHandler->isEnabled($transformedStrategy, $context);
    }

    public function getStrategyName(): string
    {
        return 'gradualRolloutRandom';
    }
}
