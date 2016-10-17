<?php
namespace Gungnir\Event\Tests;

use Gungnir\Event\GenericEventListener;
use Gungnir\Event\EventDispatcher;

class EventDispatcherTest extends \PHPUnit_Framework_TestCase
{
    public function testEventsCanBeEmittedAndListenersCanModifyTheEventData()
    {
        $eventDispatcher = new EventDispatcher();

        $listener = new GenericEventListener();
        $closure = (function($eventData){
            $eventData['eventObject']->tested = true;
        });

        $listener->setClosureTorun($closure);

        $listener->setEventName('event.test');

        $eventDispatcher->registerListener($listener);

        $object = new \StdClass;

        $eventDispatcher->emit('event.test', ['eventObject' => $object]);

        $this->assertTrue($object->tested);
    }

    public function testListenersWithCatchAllTriggersOnWildCardEventName()
    {
        $eventDispatcher = new EventDispatcher();

        $listener = new GenericEventListener();
        $listener->setCatchAll(true);
        $closure = (function($eventData){
            $eventData['eventObject']->tested = true;
        });

        $listener->setClosureTorun($closure);

        $listener->setEventName('event.test');
        $eventDispatcher->registerListener($listener);

        $object1 = new \StdClass();
        $object2 = new \StdClass();

        $eventDispatcher->emit('event.test', ['eventObject' => $object1]);
        $eventDispatcher->emit('event.test.alternative', ['eventObject' => $object2]);

        $this->assertTrue($object1->tested);
        $this->assertTrue($object2->tested);
    }
}
