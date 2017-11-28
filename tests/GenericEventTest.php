<?php
namespace Gungnir\Event\Tests;


use Gungnir\Event\GenericEvent;
use Gungnir\Event\GenericEventObject;

class GenericEventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testThatItSetsThingsCorrectly()
    {
        $eventName = 'eventName';
        $eventObject = new GenericEventObject(['key' => 'value']);
        $event = new GenericEvent($eventName, $eventObject);

        $this->assertEquals($eventName, $event->getEventName());
        $this->assertEquals($eventObject, $event->getEventObject());

    }
}