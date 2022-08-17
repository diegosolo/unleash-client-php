<?php

namespace Unleash\Client\Enum;

use JetBrains\PhpStorm\Deprecated;

final class ConstraintOperator
{
    // legacy
    #[Deprecated('Please use IN_LIST constant')]const IN = self::IN_LIST;

    #[Deprecated('Please use NOT_IN_LIST constant')]const NOT_IN = self::NOT_IN_LIST;

    // list
    const IN_LIST = 'IN';

    const NOT_IN_LIST = 'NOT_IN';

    // string
    const STRING_STARTS_WITH = 'STR_STARTS_WITH';

    const STRING_ENDS_WITH = 'STR_ENDS_WITH';

    const STRING_CONTAINS = 'STR_CONTAINS';

    // number
    const NUMBER_EQUALS = 'NUM_EQ';

    const NUMBER_GREATER_THAN = 'NUM_GT';

    const NUMBER_GREATER_THAN_OR_EQUALS = 'NUM_GTE';

    const NUMBER_LOWER_THAN = 'NUM_LT';

    const NUMBER_LOWER_THAN_OR_EQUALS = 'NUM_LTE';

    // date
    const DATE_AFTER = 'DATE_AFTER';

    const DATE_BEFORE = 'DATE_BEFORE';

    // versions
    const VERSION_EQUALS = 'SEMVER_EQ';

    const VERSION_GREATER_THAN = 'SEMVER_GT';

    const VERSION_LOWER_THAN = 'SEMVER_LT';
}
