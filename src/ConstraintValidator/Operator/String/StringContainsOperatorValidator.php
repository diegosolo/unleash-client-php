<?php

namespace Unleash\Client\ConstraintValidator\Operator\String;

/**
 * @internal
 */
final class StringContainsOperatorValidator extends AbstractStringOperatorValidator
{
    /**
     * @param mixed[]|string $searchInValue
     * @param string $currentValue
     */
    protected function validate($currentValue, $searchInValue): bool
    {
        assert(is_string($searchInValue));

        return strpos($currentValue, $searchInValue) !== false;
    }
}
