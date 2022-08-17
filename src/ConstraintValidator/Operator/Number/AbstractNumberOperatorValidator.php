<?php

namespace Unleash\Client\ConstraintValidator\Operator\Number;

use Unleash\Client\ConstraintValidator\Operator\AbstractOperatorValidator;

/**
 * @internal
 */
abstract class AbstractNumberOperatorValidator extends AbstractOperatorValidator
{
    /**
     * @param mixed[]|string $values
     */
    protected function acceptsValues($values): bool
    {
        return is_string($values) && is_numeric($values);
    }

    /**
     * @return int|float
     * @param string $number
     */
    protected function convert($number)
    {
        if (strpos($number, '.') !== false) {
            return (float) $number;
        }

        return (int) $number;
    }
}
