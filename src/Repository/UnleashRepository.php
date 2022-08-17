<?php

namespace Unleash\Client\Repository;

use Unleash\Client\DTO\Feature;

interface UnleashRepository
{
    /**
     * @param string $featureName
     */
    public function findFeature($featureName): ?Feature;

    /**
     * @return iterable<Feature>
     */
    public function getFeatures(): iterable;
}
