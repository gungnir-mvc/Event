<?php
namespace Gungnir\Event;

interface EventDispatcherInterface
{
    /**
     * Triggers an event
     *
     * @param  String           $eventName   Name of event to trigger
     * @param  null|EventObjectInterface $eventObject EventObject to pass to listeners
     *
     * @return EventDispatcher
     */
    public function emit(String $eventName, EventObjectInterface $eventObject = null) : EventDispatcher;

    /**
     * @param EventInterface $event
     *
     * @return EventDispatcher
     */
    public function broadcast(EventInterface $event): EventDispatcher;

    /**
     * Registers a listener under a certain event name
     *
     * @param  EventListenerInterface $eventListener
     *
     * @return EventDispatcher
     */
    public function registerListener(EventListenerInterface $eventListener) : EventDispatcher;

    /**
     * Registers multiple event listeners given in an array
     *
     * @param EventListenerInterface[] $eventListeners The given array with EventListeners
     *
     * @return EventDispatcher
     */
    public function registerListeners(array $eventListeners = []);
}