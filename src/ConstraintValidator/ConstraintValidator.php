<?php

namespace Unleash\Client\ConstraintValidator;

use Unleash\Client\Configuration\Context;
use Unleash\Client\DTO\Constraint;

interface ConstraintValidator
{
    /**
     * @param \Unleash\Client\DTO\Constraint $constraint
     * @param \Unleash\Client\Configuration\Context $context
     */
    public function validateConstraint($constraint, $context): bool;
}
