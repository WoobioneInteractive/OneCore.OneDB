<?php

abstract class OneDBModel
{
	/**
	 * @var int
	 */
	public $ID;

	/**
	 * Get derived model name
	 * @return string
	 */
	public static final function Model()
	{
		return static::class;
	}

	/**
	 * Create new object
	 * @return mixed
	 */
	public static final function Create()
	{
		// Get derived class
		return new ${self::Model()};
	}
}