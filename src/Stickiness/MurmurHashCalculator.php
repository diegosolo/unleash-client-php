<?php

namespace Unleash\Client\Stickiness;

use lastguest\Murmur;

final class MurmurHashCalculator implements StickinessCalculator
{
    /**
     * @param string $id
     * @param string $groupId
     * @param int $normalizer
     */
    public function calculate($id, $groupId, $normalizer = 100): int
    {
        return Murmur::hash3_int("{$groupId}:{$id}") % $normalizer + 1;
    }
}
