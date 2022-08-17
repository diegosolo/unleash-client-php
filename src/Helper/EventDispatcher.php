<?php

namespace Unleash\Client\Helper;

use JetBrains\PhpStorm\ExpectedValues;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Unleash\Client\Event\UnleashEvents;

// @codeCoverageIgnoreStart
if (!interface_exists(EventDispatcherInterface::class)) {
    require_once __DIR__ . '/../../stubs/event-dispatcher/EventDispatcherInterface.php';
}
// @codeCoverageIgnoreEnd

/**
 * @internal
 */
final class EventDispatcher implements EventDispatcherInterface
{
    /**
     * @var EventDispatcherInterface|null
     * @readonly
     */
    private $eventDispatcher;
    /**
     * @param EventDispatcherInterface|null $eventDispatcher
     */
    public function __construct(?EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }
    /**
     * @param string $eventName
     * @param callable $listener
     * @param int $priority
     */
    public function addListener($eventName, $listener, $priority = 0): void
    {
        ($eventDispatcher = $this->eventDispatcher) ? $eventDispatcher->addListener($eventName, $listener, $priority) : null;
    }

    /**
     * @param \Symfony\Component\EventDispatcher\EventSubscriberInterface $subscriber
     */
    public function addSubscriber($subscriber): void
    {
        ($eventDispatcher = $this->eventDispatcher) ? $eventDispatcher->addSubscriber($subscriber) : null;
    }

    /**
     * @param string $eventName
     * @param callable $listener
     */
    public function removeListener($eventName, $listener): void
    {
        ($eventDispatcher = $this->eventDispatcher) ? $eventDispatcher->removeListener($eventName, $listener) : null;
    }

    /**
     * @param \Symfony\Component\EventDispatcher\EventSubscriberInterface $subscriber
     */
    public function removeSubscriber($subscriber): void
    {
        ($eventDispatcher = $this->eventDispatcher) ? $eventDispatcher->removeSubscriber($subscriber) : null;
    }

    /**
     * @phpstan-return array<callable[]|callable>
     * @param string|null $eventName
     */
    public function getListeners($eventName = null): array
    {
        if (is_string($eventName)) {
            return (($eventDispatcher = $this->eventDispatcher) ? $eventDispatcher->getListeners($eventName) : null) ?? [];
        }

        return (($eventDispatcher = $this->eventDispatcher) ? $eventDispatcher->getListeners() : null) ?? [];
    }

    /**
     * @param object $event
     * @return object
     * @param string|null $eventName
     */
    public function dispatch($event, #[ExpectedValues(valuesFromClass: UnleashEvents::class)]
    $eventName = null)
    {
        if (is_string($eventName)) {
            $result = (($eventDispatcher = $this->eventDispatcher) ? $eventDispatcher->dispatch($event, $eventName) : null) ?? $event;
        } else {
            $result = (($eventDispatcher = $this->eventDispatcher) ? $eventDispatcher->dispatch($event) : null) ?? $event;
        }
        return $result;
    }

    /**
     * @param string $eventName
     * @param callable $listener
     */
    public function getListenerPriority($eventName, $listener): ?int
    {
        return ($eventDispatcher = $this->eventDispatcher) ? $eventDispatcher->getListenerPriority($eventName, $listener) : null;
    }

    /**
     * @param string|null $eventName
     */
    public function hasListeners($eventName = null): bool
    {
        if (is_string($eventName)) {
            return (($eventDispatcher = $this->eventDispatcher) ? $eventDispatcher->hasListeners($eventName) : null) ?? false;
        }

        return (($eventDispatcher = $this->eventDispatcher) ? $eventDispatcher->hasListeners() : null) ?? false;
    }
}
