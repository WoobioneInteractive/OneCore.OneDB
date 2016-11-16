<?php

class DatabaseRepository implements IRepository
{
	/**
	 * @var IDatabaseConnection
	 */
	private $connection = null;

	/**
	 * DatabaseRepository constructor.
	 * @param IDatabaseConnection $connection
	 */
	public function __construct(IDatabaseConnection $connection)
	{
		$this->connection = $connection;
	}

	/**
	 * @return IDatabaseConnection
	 */
	public function GetConnection()
	{
		return $this->connection;
	}
}