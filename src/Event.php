<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 19.06.18
 * Time: 22:40
 */

namespace Weedus\EventDispatcher;


class Event implements EventInterface
{
    /** @var string */
    protected $name;
    /** @var array|null */
    protected $context;
    /** @var bool */
    protected $propagationStopped = false;

    /**
     * Event constructor.
     * @param string $name
     * @param array $context
     */
    public function __construct(string $name, array $context = null)
    {
        $this->name = $name;
        $this->context = $context;
    }


    /**
     * Returns the name of the event
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns the context when the event was called
     *
     * @return array|null
     */
    public function getContext(): ?array
    {
        return $this->context;
    }

    /**
     * Returns whether further event listeners should be triggered.
     *
     * @return bool Whether propagation was already stopped for this event
     */
    public function isPropagationStopped(): bool
    {
        return $this->propagationStopped;
    }

    /**
     * Stops the propagation of the event to further event listeners.
     *
     * If multiple event listeners are connected to the same event, no
     * further event listener will be triggered once any trigger calls
     * stopPropagation().
     * @return EventInterface
     */
    public function stopPropagation(): EventInterface
    {
        $this->propagationStopped = true;
        return $this;
    }
}