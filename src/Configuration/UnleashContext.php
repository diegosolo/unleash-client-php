<?php

namespace Unleash\Client\Configuration;

use DateTimeImmutable;
use DateTimeInterface;
use Unleash\Client\Enum\ContextField;
use Unleash\Client\Enum\Stickiness;
use Unleash\Client\Exception\InvalidValueException;

final class UnleashContext implements Context
{
    /**
     * @var string|null
     */
    private $currentUserId;
    /**
     * @var string|null
     */
    private $ipAddress;
    /**
     * @var string|null
     */
    private $sessionId;
    /**
     * @var array<string, string>
     */
    private $customContext = [];
    /**
     * @var string|null
     */
    private $environment;
    /**
     * @param array<string,string> $customContext
     * @param \DateTimeInterface|string|null $currentTime
     * @param string|null $currentUserId
     * @param string|null $ipAddress
     * @param string|null $sessionId
     * @param string|null $hostname
     * @param string|null $environment
     */
    public function __construct($currentUserId = null, $ipAddress = null, $sessionId = null, array $customContext = [], $hostname = null, $environment = null, $currentTime = null)
    {
        $this->currentUserId = $currentUserId;
        $this->ipAddress = $ipAddress;
        $this->sessionId = $sessionId;
        $this->customContext = $customContext;
        $this->environment = $environment;
        $this->setHostname($hostname);
        $this->setCurrentTime($currentTime);
    }
    /**
     * @return string|null
     */
    public function getCurrentUserId()
    {
        return $this->currentUserId;
    }

    /**
     * @return string|null
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @return string|null
     */
    public function getIpAddress()
    {
        return $this->ipAddress ?? $_SERVER['REMOTE_ADDR'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getSessionId()
    {
        return $this->sessionId ?? (session_id() ?: null);
    }

    /**
     * @param string $name
     */
    public function getCustomProperty($name): string
    {
        if (!array_key_exists($name, $this->customContext)) {
            throw new InvalidValueException("The custom context value '{$name}' does not exist");
        }

        return $this->customContext[$name];
    }

    /**
     * @return $this
     * @param string $name
     * @param string|null $value
     */
    public function setCustomProperty($name, $value): \Unleash\Client\Configuration\Context
    {
        $this->customContext[$name] = $value ?? '';

        return $this;
    }

    /**
     * @param string $name
     */
    public function hasCustomProperty($name): bool
    {
        return array_key_exists($name, $this->customContext);
    }

    /**
     * @return $this
     * @param string $name
     * @param bool $silent
     */
    public function removeCustomProperty($name, $silent = true): \Unleash\Client\Configuration\Context
    {
        if (!$this->hasCustomProperty($name) && !$silent) {
            throw new InvalidValueException("The custom context value '{$name}' does not exist");
        }

        unset($this->customContext[$name]);

        return $this;
    }

    /**
     * @return $this
     * @param string|null $currentUserId
     */
    public function setCurrentUserId($currentUserId): \Unleash\Client\Configuration\Context
    {
        $this->currentUserId = $currentUserId;

        return $this;
    }

    /**
     * @return $this
     * @param string|null $ipAddress
     */
    public function setIpAddress($ipAddress): \Unleash\Client\Configuration\Context
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * @return $this
     * @param string|null $sessionId
     */
    public function setSessionId($sessionId): \Unleash\Client\Configuration\Context
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    /**
     * @param string|null $environment
     */
    public function setEnvironment($environment): self
    {
        $this->environment = $environment;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getHostname()
    {
        return $this->findContextValue(ContextField::HOSTNAME) ?? (gethostname() ?: null);
    }

    /**
     * @param string|null $hostname
     */
    public function setHostname($hostname): self
    {
        if ($hostname === null) {
            $this->removeCustomProperty(ContextField::HOSTNAME);
        } else {
            $this->setCustomProperty(ContextField::HOSTNAME, $hostname);
        }

        return $this;
    }

    /**
     * @param array<string> $values
     * @param string $fieldName
     */
    public function hasMatchingFieldValue($fieldName, $values): bool
    {
        $fieldValue = $this->findContextValue($fieldName);
        if ($fieldValue === null) {
            return false;
        }

        return in_array($fieldValue, $values, true);
    }

    /**
     * @param string $fieldName
     * @return string|null
     */
    public function findContextValue($fieldName)
    {
        switch ($fieldName) {
            case ContextField::USER_ID:
            case Stickiness::USER_ID:
                return $this->getCurrentUserId();
            case ContextField::SESSION_ID:
            case Stickiness::SESSION_ID:
                return $this->getSessionId();
            case ContextField::IP_ADDRESS:
                return $this->getIpAddress();
            case ContextField::ENVIRONMENT:
                return $this->getEnvironment();
            case ContextField::CURRENT_TIME:
                return $this->getCurrentTime()->format(DateTimeInterface::ISO8601);
            default:
                return $this->customContext[$fieldName] ?? null;
        }
    }

    public function getCurrentTime(): DateTimeInterface
    {
        if (!$this->hasCustomProperty('currentTime')) {
            return new DateTimeImmutable();
        }

        return new DateTimeImmutable($this->getCustomProperty('currentTime'));
    }

    /**
     * @param \DateTimeInterface|string|null $time
     */
    public function setCurrentTime($time): self
    {
        if ($time === null) {
            $this->removeCustomProperty('currentTime');
        } else {
            $value = is_string($time) ? $time : $time->format(DateTimeInterface::ISO8601);
            $this->setCustomProperty('currentTime', $value);
        }

        return $this;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return array<string, string>
     */
    public function getCustomProperties(): array
    {
        return $this->customContext;
    }
}
