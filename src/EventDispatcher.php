<?php
namespace Gungnir\Event;

/**
 * EventDispatcher has the responsibility to trigger EventListeners
 * registered to a given event that gets emitted.
 *
 * Best practice for emitting events are to separate words with a dot
 * and start with some kind of namespace as a prefix which will prevent
 * EventListeners getting triggered by mistake.
 *
 * Example eventName to emit: gungnir.core.event.demo
 */
class EventDispatcher 
{

    /** @var array $listeners Array of registered closures to events */
    private $listeners = array();

    /**
     * Triggers an event
     *
     * @param  String           $eventName   Name of event to trigger
     * @param  null|EventObjectInterface $eventObject EventObject to pass to listeners
     *
     * @return EventDispatcher
     */
    public function emit(String $eventName, EventObjectInterface $eventObject = null) : EventDispatcher
    {
        $event = new GenericEvent($eventName, $eventObject ?? new GenericEventObject([]));
        return $this->broadcast($event);
    }

    /**
     * @param EventInterface $event
     *
     * @return EventDispatcher
     */
    public function broadcast(EventInterface $event): EventDispatcher
    {

        $eventName = $event->getEventName();
        $eventObject = $event->getEventObject();

        foreach ($this->listeners as $key => $eventListener) {
            if (strcmp($eventName, $eventListener->getEventname()) === 0) {
                $eventListener->trigger($eventObject);
            } elseif ($eventListener->getCatchAll() === true && strpos($eventName, $eventListener->getEventName()) !== false) {
                $eventListener->trigger($eventObject);
            }
        }
        return $this;
    }

    /**
     * Registers a listener under a certain event name
     *
     * @param  EventListenerInterface $eventListener
     *
     * @return EventDispatcher
     */
    public function registerListener(EventListenerInterface $eventListener) : EventDispatcher
    {
        $this->listeners[] = $eventListener;
        return $this;
    }

    /**
     * Registers multiple event listeners given in an array
     *
     * @param EventListenerInterface[] $eventListeners The given array with EventListeners
     *
     * @return EventDispatcher
     */
    public function registerListeners(array $eventListeners = [])
    {
        foreach ($eventListeners as $eventListener) {
            $this->registerListener($eventListener);
        }
        return $this;
    }

}
