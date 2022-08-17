<?php

namespace Unleash\Client\Stickiness;

interface StickinessCalculator
{
    /**
     * @param string $id
     * @param string $groupId
     * @param int $normalizer
     */
    public function calculate($id, $groupId, $normalizer = 100): int;
}
