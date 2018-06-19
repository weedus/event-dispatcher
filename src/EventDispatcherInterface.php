<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 19.06.18
 * Time: 22:22
 */

namespace Weedus\EventDispatcher;

interface EventDispatcherInterface
{
    /**
     * Dispatches an event to all registered listeners.
     *
     * @param string $eventName The name of the event to dispatch. The name of
     *                          the event is the name of the method that is
     *                          invoked on listeners.
     * @param EventInterface  $event     The event to pass to the event handlers/listeners
     *                          If not supplied, an empty Event instance is created
     *
     * @return EventInterface
     */
    public function dispatch($eventName, ?EventInterface $event = null): EventInterface;
    /**
     * Adds an event listener that listens on the specified events.
     *
     * @param string   $eventName The event to listen on
     * @param callable $listener  The listener
     * @param int      $priority  The higher this value, the earlier an event
     *                            listener will be triggered in the chain (defaults to 0)
     * @return EventDispatcherInterface
     */
    public function addListener(string $eventName, $listener, int $priority = 0): EventDispatcherInterface;
    /**
     * Adds an event subscriber.
     *
     * The subscriber is asked for all the events he is
     * interested in and added as a listener for these events.
     * @param string $subscriber subscriber class, must implement EventSubscriberInterface
     * @return EventDispatcherInterface
     */
    public function addSubscriber(string $subscriber): EventDispatcherInterface;
    /**
     * Removes an event listener from the specified events.
     *
     * @param string   $eventName The event to remove a listener from
     * @param callable $listener  The listener to remove
     * @return EventDispatcherInterface
     */
    public function removeListener(string $eventName, $listener): EventDispatcherInterface;
    /**
     * Removes event listener from the specified events by subscriber.
     *
     * @param string $subscriber The subscriber class containing the listener(s) and event(s) to be removed
     * @return EventDispatcherInterface
     */
    public function removeSubscriber(string $subscriber): EventDispatcherInterface;
    /**
     * Gets the listeners of a specific event or all listeners sorted by descending priority.
     *
     * @param string $eventName The name of the event
     *
     * @return array The event listeners for the specified event, or all event listeners by event name
     */
    public function getListeners(?string $eventName = null): array;
    /**
     * Gets the listener priority for a specific event.
     *
     * Returns null if the event or the listener does not exist.
     *
     * @param string   $eventName The name of the event
     * @param callable $listener  The listener
     *
     * @return int|null The event listener priority
     */
    public function getListenerPriority(string $eventName, $listener): ?int;
    /**
     * Checks whether an event has any registered listeners.
     *
     * @param string $eventName The name of the event
     *
     * @return bool true if the specified event has any listeners, false otherwise
     */
    public function hasListeners(?string $eventName = null): bool;
}