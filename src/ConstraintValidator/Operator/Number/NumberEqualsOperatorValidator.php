<?php

namespace Unleash\Client\ConstraintValidator\Operator\Number;

/**
 * @internal
 */
final class NumberEqualsOperatorValidator extends AbstractNumberOperatorValidator
{
    /**
     * @param mixed[]|string $searchInValue
     * @param string $currentValue
     */
    protected function validate($currentValue, $searchInValue): bool
    {
        assert(is_string($searchInValue));

        return $this->convert($currentValue) == $this->convert($searchInValue);
    }
}
