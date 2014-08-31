<?php namespace Boilerplate\Drops\Events;


use Boilerplate\Drops\Drop;

class DropEdited {

	/**
	 * @var \Boilerplate\Drops\Drop
	 */
	public $drop;

	/**
	 * @param Drop $drop
	 */
	function __construct(Drop $drop)
	{
		$this->drop = $drop;
	}
}