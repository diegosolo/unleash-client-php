<?php

namespace Unleash\Client\DTO;

/**
 * @method bool hasImpressionData()
 */
interface Feature
{
    public function getName(): string;

    public function isEnabled(): bool;

    /**
     * @return mixed[]
     */
    public function getStrategies();

    /**
     * @return array<Variant>
     */
    public function getVariants(): array;
}
