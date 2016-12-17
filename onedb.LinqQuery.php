<?php

class LinqQuery implements IQuery
{
	/**
	 * @var string
	 */
	private $modelName;

	/**
	 * @var IModelResolver[]
	 */
	private $modelResolvers = [];

	/**
	 * @var string
	 */
	private $tablePrefix = '';

	/**
	 * LinqQuery constructor.
	 * @param string $modelName
	 */
	public function __construct($modelName)
	{
		$this->modelName = $modelName;
		$this->modelResolvers[$modelName] = new ModelResolver($modelName);
	}

	/**
	 * @param string $tablePrefix
	 * @return LinqQuery $this
	 */
	public function SetTablePrefix($tablePrefix)
	{
		$this->tablePrefix = $tablePrefix;
		return $this;
	}

	/**
	 * @return string
	 */
	public function GetQueryString()
	{
		// TODO: Implement GetQueryString() method.
	}

	/**
	 * @return array
	 */
	public function GetParameters()
	{
		// TODO: Implement GetParameters() method.
	}
}