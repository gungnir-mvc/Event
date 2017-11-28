<?php
namespace Gungnir\Event;

class GenericEvent implements EventInterface
{

    /** @var string */
    private $eventName = null;

    /** @var EventObjectInterface */
    private $eventObject = null;

    /**
     * GenericEvent constructor.
     *
     * @param string $eventName
     * @param EventObjectInterface $eventObject
     */
    public function __construct(string $eventName, EventObjectInterface $eventObject)
    {
        $this->eventName = $eventName;
        $this->eventObject = $eventObject;
    }

    /**
     * Get the event name of this event. This is what listeners trigger on.
     *
     * @return string
     */
    public function getEventName(): string
    {
        return (string) $this->eventName;
    }

    /**
     * Get the event data of this event. This is what listeners interact with.
     *
     * @return EventObjectInterface
     */
    public function getEventObject(): EventObjectInterface
    {
        return $this->eventObject;
    }
}