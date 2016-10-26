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

    public function testMultipleEventListenersCanBeRegisteredAtOnce()
    {
        $eventDispatcher = new EventDispatcher();

        $listener1 = new GenericEventListener();
        $listener2 = new GenericEventListener();

        $closure1 = (function($eventData){
            $eventData['eventObject']->tested1 = true;
        });

        $closure2 = (function($eventData){
            $eventData['eventObject']->tested2 = true;
        });

        $listener1->setClosureTorun($closure1);
        $listener2->setClosureTorun($closure2);

        $listener1->setEventName('event.test');
        $listener2->setEventName('event.test');

        $eventDispatcher->registerEventListeners([$listener1, $listener2]);

        $object = new \StdClass;    

        $eventDispatcher->emit('event.test', ['eventObject' => $object]);

        $this->assertTrue($object->tested1);
        $this->assertTrue($object->tested2);
    }
}
