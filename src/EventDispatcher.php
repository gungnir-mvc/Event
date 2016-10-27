<?php
namespace Gungnir\Event;

use Closure;

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
class EventDispatcher {

    /** @var array $listeners Array of registered closures to events */
    private $listeners = array();

    /**
     * Triggers an event
     *
     * @param  String $eventName Name of event to trigger
     * @param  array  $data      Array of data to send to listeners
     *
     * @return EventDispatcher
     */
    public function emit(String $eventName, array $data = array()) : EventDispatcher
    {
       foreach ($this->listeners as $key => $eventListener) {
           if (strcmp($eventName, $eventListener->getEventname()) === 0) {
               $eventListener->trigger($data);
           } elseif ($eventListener->getCatchAll() === true && strpos($eventName, $eventListener->getEventName()) !== false) {
               $eventListener->trigger($data);
           }
        }
        return $this;
    }

    /**
     * Registers a listener under a certain event name
     *
     * @param  EventListener $eventListener
     *
     * @return EventDispatcher
     */
    public function registerListener(EventListener $eventListener) : EventDispatcher
    {
        $this->listeners[] = $eventListener;
        return $this;
    }

    /**
     * Registers multiple event listeners given in an array
     *
     * @param EventListener[] $eventListeners The given array with EventListeners
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
