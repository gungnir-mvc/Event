<?php
namespace Gungnir\Event;

interface EventInterface
{
    /**
     * Get the event name of this event. This is what listeners trigger on.
     *
     * @return string
     */
    public function getEventName(): string;

    /**
     * Get the event data of this event. This is what listeners interact with.
     *
     * @return EventObjectInterface
     */
    public function getEventObject(): EventObjectInterface;
}