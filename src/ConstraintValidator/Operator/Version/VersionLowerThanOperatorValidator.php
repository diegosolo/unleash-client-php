<?php

namespace Unleash\Client\ConstraintValidator\Operator\Version;

/**
 * @internal
 */
final class VersionLowerThanOperatorValidator extends AbstractVersionOperatorValidator
{
    /**
     * @param mixed[]|string $searchInValue
     * @param string $currentValue
     */
    protected function validate($currentValue, $searchInValue): bool
    {
        assert(is_string($searchInValue));

        return version_compare($currentValue, $searchInValue, 'lt');
    }
}
