<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 19.06.18
 * Time: 22:23
 */

namespace Weedus\EventDispatcher;


interface EventInterface
{
    /**
     * Returns the name of the event
     *
     * @return string
     */
    public function getName(): string;
    /**
     * Returns the context when the event was called
     *
     * @return array|null
     */
    public function getContext(): ?array;
    /**
     * Returns whether further event listeners should be triggered.
     *
     * @return bool Whether propagation was already stopped for this event
     */
    public function isPropagationStopped(): bool;

    /**
     * Stops the propagation of the event to further event listeners.
     *
     * If multiple event listeners are connected to the same event, no
     * further event listener will be triggered once any trigger calls
     * stopPropagation().
     * @return EventInterface
     */
    public function stopPropagation(): EventInterface;
}