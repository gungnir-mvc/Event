<?php
namespace Gungnir\Event;

/**
 * Interface that all event objects should
 * implement
 *
 * @package Gungnir\Event
 */
interface EventObjectInterface
{
	/**
	 * Returns registered event data
	 * 
	 * @return mixed
	 */
	public function getData();
}