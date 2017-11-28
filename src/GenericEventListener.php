<?php
namespace Gungnir\Event;

use \Closure;

class GenericEventListener implements EventListenerInterface
{
    /** @var string The name of the event to trigger on */
    private $eventName;

    /** @var Closure The closure to run when this EventListener is triggered */
    private $closureToRun;

    /** @var Bool */
    private $catchAll =  false;

    /**
     * {@inheritDoc}
     */
    public function trigger($data)
    {
        if ($this->closureToRun) {
            call_user_func_array($this->closureToRun, [$data]);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getEventName() : String
    {
        return $this->eventName;
    }

    /**
     * {@inheritDoc}
     */
    public function setEventName(String $eventName) : EventListenerInterface
    {
        $this->eventName = $eventName;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCatchAll() : Bool
    {
        return $this->catchAll;
    }

    /**
     * {@inheritDoc}
     */
    public function setCatchAll(Bool $flag) : EventListenerInterface
    {
        $this->catchAll = $flag;
        return $this;
    }

    /**
     * Binds given closure to be run whenever this listener is
     * triggered.
     *
     * @param Closure $closure The closure to be run
     *
     * @return void
     */
    public function setClosureToRun(Closure $closure)
    {
        $this->closureToRun = $closure;
    }
}
