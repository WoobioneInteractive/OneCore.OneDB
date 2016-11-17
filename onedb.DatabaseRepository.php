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

	/**
	 * @return mixed
	 */
	public function LoadByID()
	{
		// TODO: Implement LoadByID() method.
	}

	public function LoadAll()
	{
		// TODO: Implement LoadAll() method.
	}
}