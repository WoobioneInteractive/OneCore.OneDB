<?php

class DatabaseRepository implements IRepository
{
	/**
	 * @var IDatabaseConnection
	 */
	private $connection = null;

	/**
	 * @var IModelResolver
	 */
	private $modelResolver = null;

	/**
	 * DatabaseRepository constructor.
	 * @param IDatabaseConnection $connection
	 * @param IModelResolver $modelResolver
	 */
	public function __construct(IDatabaseConnection $connection, IModelResolver $modelResolver)
	{
		$this->connection = $connection;
		$this->modelResolver = $modelResolver;
	}

	/**
	 * @return IDatabaseConnection
	 */
	public function GetConnection()
	{
		return $this->connection;
	}

	/**
	 * @param string $model
	 * @param int $id
	 * @throws Exception
	 */
	public function FindByID($model, $id)
	{
		throw new Exception('Not implemented');
	}

	/**
	 * @throws Exception
	 */
	public function FindOne($model)
	{
		throw new Exception('Not implemented');
	}

	/**
	 * @param string $model
	 */
	public function FindAll($model)
	{
		return $this->modelResolver->GetMapping($model);
	}
}