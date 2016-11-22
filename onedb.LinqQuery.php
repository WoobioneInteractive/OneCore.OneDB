<?php

class LinqQuery implements IQuery
{
	/**
	 * @var string
	 */
	private $modelName;

	/**
	 * @var IModelResolver
	 */
	private $modelResolver;

	/**
	 * @var string
	 */
	private $tablePrefix = '';

	/**
	 * @var bool
	 */
	private $autoMap = false;

	/**
	 * LinqQuery constructor.
	 * @param string $modelName
	 */
	public function __construct($modelName)
	{
		$this->modelName = $modelName;
		$this->modelResolver = new ModelResolver();
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
	 * @param bool $doAutoMap
	 */
	public function AutoMap($doAutoMap)
	{
		$this->autoMap = $doAutoMap;
		$this->modelResolver->AutoMap($doAutoMap);
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