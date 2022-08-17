<?php

namespace Unleash\Client\DTO;

use JetBrains\PhpStorm\ExpectedValues;
use JsonSerializable;
use Unleash\Client\Enum\Stickiness;

interface Variant extends JsonSerializable
{
    public function getName(): string;

    public function isEnabled(): bool;

    /**
     * @return \Unleash\Client\DTO\VariantPayload|null
     */
    public function getPayload();

    public function getWeight(): int;

    /**
     * @return array<VariantOverride>
     */
    public function getOverrides(): array;

    #[ExpectedValues(valuesFromClass: Stickiness::class)]
    public function getStickiness(): string;
}
