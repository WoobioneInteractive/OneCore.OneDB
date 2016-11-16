<?php

abstract class OneDBModel
{
	/**
	 * @var array
	 */
	protected $mapping = [];

	/**
	 * @var int
	 */
	public $ID;

	/**
	 * @return OneDBMapping
	 */
	public final function _GetMapping()
	{
		return new OneDBMapping($this->mapping);
	}

	/**
	 * Create new object
	 * @return mixed
	 */
	public static final function Create()
	{
		// Get derived class
		$class = static::class;

		return new $class;
	}

	/**
	 * Load single object by ID
	 * @param int $id
	 */
	public static final function LoadByID($id)
	{

	}
}