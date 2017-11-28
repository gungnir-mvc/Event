<?php
namespace Gungnir\Event;

/**
 * Generic event object that carries data
 * and also keeps track of how many times the data
 * have been retrieved
 *
 * @package Gungnir\Event
 */
class GenericEventObject implements EventObjectInterface
{
	/** @var mixed Any data sent with the event */
	private $data = null;

	/** @var integer Counts the amount of times the data have been retrieved */
	private $countGetData = 0;

	/**
	 * {@inheritDoc}
	 */
	public function __construct($data)
	{
		$this->data = $data;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getData()
	{
		$this->incrementCountGetData();
		return $this->data;
	}

	/**
	 * Get the data retrieval counter amount
	 * 
	 * @return integer
	 */
	public function getCountGetData()
	{
		return $this->countGetData;
	}

	/**
	 * Increments data retrieval counter with 1
	 * 
	 * @return void
	 */
	private function incrementCountGetData()
	{
		++$this->countGetData;
	}
}