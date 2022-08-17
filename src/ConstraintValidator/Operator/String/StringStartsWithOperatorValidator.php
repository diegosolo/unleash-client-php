<?php

namespace Unleash\Client\ConstraintValidator\Operator\String;

/**
 * @internal
 */
final class StringStartsWithOperatorValidator extends AbstractStringOperatorValidator
{
    /**
     * @param mixed[]|string $searchInValue
     * @param string $currentValue
     */
    protected function validate($currentValue, $searchInValue): bool
    {
        assert(is_string($searchInValue));

        return strncmp($currentValue, $searchInValue, strlen($searchInValue)) === 0;
    }
}
