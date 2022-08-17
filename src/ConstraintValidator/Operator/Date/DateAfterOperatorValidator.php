<?php

namespace Unleash\Client\ConstraintValidator\Operator\Date;

/**
 * @internal
 */
final class DateAfterOperatorValidator extends AbstractDateOperatorValidator
{
    /**
     * @param mixed[]|string $searchInValue
     * @param string $currentValue
     */
    protected function validate($currentValue, $searchInValue): bool
    {
        assert(is_string($searchInValue));

        return $this->convert($currentValue) > $this->convert($searchInValue);
    }
}
