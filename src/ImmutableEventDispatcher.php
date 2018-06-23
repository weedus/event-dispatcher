<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 20.06.18
 * Time: 00:06
 */

namespace Weedus\EventDispatcher;

use Weedus\Exceptions\BadMethodCallException;

class ImmutableEventDispatcher implements EventDispatcherInterface
{
    /** @var EventDispatcherInterface */
    protected $dispatcher;

    /**
     * ImmutableEventDispatcher constructor.
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }


    /**
     * Dispatches an event to all registered listeners.
     *
     * @param string $eventName The name of the event to dispatch. The name of
     *                          the event is the name of the method that is
     *                          invoked on listeners.
     * @param EventInterface $event The event to pass to the event handlers/listeners
     *                          If not supplied, an empty Event instance is created
     *
     * @return EventInterface
     */
    public function dispatch($eventName, ?EventInterface $event = null): EventInterface
    {
        return $this->dispatcher->dispatch($eventName, $event);
    }

    /**
     * Adds an event listener that listens on the specified events.
     *
     * @param string $eventName The event to listen on
     * @param callable $listener The listener
     * @param int $priority The higher this value, the earlier an event
     *                            listener will be triggered in the chain (defaults to 0)
     * @return EventDispatcherInterface
     * @throws BadMethodCallException
     */
    public function addListener(string $eventName, $listener, int $priority = 0): EventDispatcherInterface
    {
        throw new BadMethodCallException(__METHOD__.": immutable dispatcher must not be modified.");
    }

    /**
     * Adds an event subscriber.
     *
     * The subscriber is asked for all the events he is
     * interested in and added as a listener for these events.
     * @param EventSubscriberInterface $subscriber subscriber
     * @return EventDispatcherInterface
     * @throws BadMethodCallException
     */
    public function addSubscriber(EventSubscriberInterface $subscriber): EventDispatcherInterface
    {
        throw new BadMethodCallException(__METHOD__.": immutable dispatcher must not be modified.");
    }

    /**
     * Removes an event listener from the specified events.
     *
     * @param string $eventName The event to remove a listener from
     * @param callable $listener The listener to remove
     * @return EventDispatcherInterface
     * @throws BadMethodCallException
     */
    public function removeListener(string $eventName, $listener): EventDispatcherInterface
    {
        throw new BadMethodCallException(__METHOD__.": immutable dispatcher must not be modified.");
    }

    /**
     * Removes event listener from the specified events by subscriber.
     *
     * @param EventSubscriberInterface $subscriber The subscriber containing the listener(s) and event(s) to be removed
     * @return EventDispatcherInterface
     * @throws BadMethodCallException
     */
    public function removeSubscriber(EventSubscriberInterface $subscriber): EventDispatcherInterface
    {
        throw new BadMethodCallException(__METHOD__.": immutable dispatcher must not be modified.");
    }

    /**
     * Gets the listeners of a specific event or all listeners sorted by descending priority.
     *
     * @param string $eventName The name of the event
     *
     * @return array The event listeners for the specified event, or all event listeners by event name
     */
    public function getListeners(?string $eventName = null): array
    {
        return $this->dispatcher->getListeners($eventName);
    }

    /**
     * Gets the listener priority for a specific event.
     *
     * Returns null if the event or the listener does not exist.
     *
     * @param string $eventName The name of the event
     * @param callable $listener The listener
     *
     * @return int|null The event listener priority
     */
    public function getListenerPriority(string $eventName, $listener): ?int
    {
        return $this->dispatcher->getListenerPriority($eventName, $listener);
    }

    /**
     * Checks whether an event has any registered listeners.
     *
     * @param string $eventName The name of the event
     *
     * @return bool true if the specified event has any listeners, false otherwise
     */
    public function hasListeners(?string $eventName = null): bool
    {
        return $this->dispatcher->hasListeners($eventName);
    }
}