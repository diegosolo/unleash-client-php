<?php

namespace Unleash\Client\Repository;

use Unleash\Client\DTO\Feature;

interface UnleashRepository
{
    /**
     * @param string $featureName
     * @return \Unleash\Client\DTO\Feature|null
     */
    public function findFeature($featureName);

    /**
     * @return mixed[]
     */
    public function getFeatures();
}
