<?php
namespace Gungnir\Event\Tests;

use \Gungnir\Event\GenericEventObject;

class EventObjectTest extends \PHPUnit_Framework_TestCase
{
	public function testDataCanBeRetrievedFromEventObject()
	{
		$expected = 'testData';
		$eventObject = new GenericEventObject($expected);
		$this->assertEquals($expected, $eventObject->getData());
		$this->assertEquals(1, $eventObject->getCountGetData());
	}
}