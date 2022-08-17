<?php

namespace Unleash\Client\ConstraintValidator\Operator\Lists;

/**
 * @internal
 */
final class InListOperatorValidator extends AbstractListOperatorValidator
{
    /**
     * @param mixed[]|string $searchInValue
     * @param string $currentValue
     */
    protected function validate($currentValue, $searchInValue): bool
    {
        assert(is_array($searchInValue));

        return in_array($currentValue, $searchInValue, true);
    }
}
