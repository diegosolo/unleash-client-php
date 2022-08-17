<?php

namespace Unleash\Client\Configuration;

use DateTimeInterface;

/**
 * @todo move to required methods in next major
 *
 * @method string|null       getHostname()
 * @method string|null       getEnvironment()
 * @method DateTimeInterface getCurrentTime()
 * @method Context           setHostname(string|null $hostname)
 * @method Context           setEnvironment(string|null $environment)
 * @method Context           setCurrentTime(DateTimeInterface|null $time)
 * @method array<string,     string> getCustomProperties()
 */
interface Context
{
    /**
     * @return string|null
     */
    public function getCurrentUserId();

    /**
     * @return string|null
     */
    public function getIpAddress();

    /**
     * @return string|null
     */
    public function getSessionId();

    /**
     * @param string $name
     */
    public function getCustomProperty($name): string;

    /**
     * @todo make $value nullable
     * @param string $name
     * @param string $value
     */
    public function setCustomProperty($name, $value): self;

    /**
     * @param string $name
     */
    public function hasCustomProperty($name): bool;

    /**
     * @param string $name
     * @param bool $silent
     */
    public function removeCustomProperty($name, $silent = true): self;

    /**
     * @param string|null $currentUserId
     */
    public function setCurrentUserId($currentUserId): self;

    /**
     * @param string|null $ipAddress
     */
    public function setIpAddress($ipAddress): self;

    /**
     * @param string|null $sessionId
     */
    public function setSessionId($sessionId): self;

    /**
     * @param array<string> $values
     * @param string $fieldName
     */
    public function hasMatchingFieldValue($fieldName, $values): bool;

    /**
     * @param string $fieldName
     * @return string|null
     */
    public function findContextValue($fieldName);
}
