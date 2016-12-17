<?php

class DatabaseRepository implements IRepository
{
	/**
	 * @var IDatabaseConnection
	 */
	private $connection;

	/**
	 * @var string
	 */
	private $tablePrefix;

	/**
	 * @var bool
	 */
	private $autoMap;

	/**
	 * DatabaseRepository constructor.
	 * @param IDatabaseConnection $connection
	 * @param bool $autoMap
	 */
	public function __construct(IDatabaseConnection $connection, $tablePrefix = '', $autoMap = false)
	{
		$this->connection = $connection;
		$this->tablePrefix = $tablePrefix;
		$this->autoMap = $autoMap;
	}

	/**
	 * Get new LinqQuery instance
	 * @param string $model
	 * @return LinqQuery
	 */
	public function getNewLinq($model)
	{
		return (new LinqQuery($model))->SetTablePrefix($this->tablePrefix);
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
		$linq = $this->getNewLinq($model);
		return $linq;
	}

	/**
	 * @param OneDBModel $model
	 */
	public function Save(OneDBModel $model)
	{
		if ($model->ID > 0)
			$this->Update($model);
		else
			$this->Create($model);
	}

	public function Update(OneDBModel $model)
	{

	}

	public function Create(OneDBModel $model)
	{

	}

	public function Delete(OneDBModel $model)
	{

	}
}