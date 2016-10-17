<?php
namespace Gungnir\Event\Tests;

use Gungnir\Event\GenericEventListener;

class GenericEventListenerTest extends \PHPUnit_Framework_TestCase
{
    public function testItCanRunItsClosureAndModifyEventObjectWhenTriggered()
    {
        $listener = new GenericEventListener();
        $closure = (function($eventData){
            $eventData['eventObject']->tested = true;
        });
        $listener->setClosureTorun($closure);
        $listener->setEventName('event.test');

        $stdObject = new \StdClass;

        $listener->trigger(['eventObject' => $stdObject]);

        $this->assertTrue($stdObject->tested);
    }
}
