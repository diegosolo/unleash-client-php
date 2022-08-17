<?php

namespace Unleash\Client\Strategy;

use Unleash\Client\Configuration\Context;
use Unleash\Client\DTO\Constraint;
use Unleash\Client\DTO\Strategy;
use Unleash\Client\Helper\ConstraintValidatorTrait;

abstract class AbstractStrategyHandler implements StrategyHandler
{
    use ConstraintValidatorTrait;

    /**
     * @param \Unleash\Client\DTO\Strategy $strategy
     */
    public function supports($strategy): bool
    {
        return $strategy->getName() === $this->getStrategyName();
    }

    /**
     * @param string $parameter
     * @param \Unleash\Client\DTO\Strategy $strategy
     */
    protected function findParameter($parameter, $strategy): ?string
    {
        $parameters = $strategy->getParameters();

        return $parameters[$parameter] ?? null;
    }

    /**
     * @param \Unleash\Client\DTO\Strategy $strategy
     * @param \Unleash\Client\Configuration\Context $context
     */
    protected function validateConstraints($strategy, $context): bool
    {
        if (method_exists($strategy, 'hasNonexistentSegments') && $strategy->hasNonexistentSegments()) {
            return false;
        }

        $validator = $this->getValidator();
        $constraints = $this->getConstraintsForStrategy($strategy);

        foreach ($constraints as $constraint) {
            if (!$validator->validateConstraint($constraint, $context)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return iterable<Constraint>
     */
    private function getConstraintsForStrategy(Strategy $strategy): iterable
    {
        yield from $strategy->getConstraints();

        $segments = method_exists($strategy, 'getSegments') ? $strategy->getSegments() : [];
        foreach ($segments as $segment) {
            yield from $segment->getConstraints();
        }
    }
}
