<?php
namespace Gungnir\Event;

/**
 * Interface which all implementations of
 * event listeners should implement
 *
 * @package Gungnir\Event
 */
interface EventListenerInterface
{
    /**
     * Method that handles anything that should be done
     * when event is triggered.
     *
     * @param mixed $data Any data that the event dispatches with
     */
    public function trigger($data);

    /*
     * Retrieves the name of which this listener should
     * be triggered on.
     *
     * @return String
     */
    public function getEventName() : String;

    /**
     * Set name of the event that this listner should
     * be triggered on.
     *
     * @param string $eventName The given event name
     *
     * @return EventListenerInterface
     */
    public function setEventName(String $eventName) : EventListenerInterface;

    /**
     * If flag is true then this EventListener will trigger on all events
     * that starts with the registered event name
     *
     * @param Bool $flag    True Listener should catch all events possible
     *
     * @return EventListenerInterface
     */
    public function setCatchAll(Bool $flag) : EventListenerInterface;

    /**
     * Get flag that determines if EventListener is greedy
     *
     * @return Bool     True if greedy
     */
    public function getCatchAll() : Bool;
}
