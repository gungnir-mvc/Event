<?php
namespace Gungnir\Event;

/**
 * Interface that all event objects should
 * implement
 *
 * @package Gungnir\Event
 */
interface EventObject
{
	/**
	 * Constructor
	 * 
	 * @param mixed $data The data to store in the event
	 *
	 * @return self
	 */
	public function __construct($data);

	/**
	 * Returns registered event data
	 * 
	 * @return mixed
	 */
	public function getData();
}