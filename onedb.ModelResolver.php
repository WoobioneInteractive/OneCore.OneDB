<?php

class ModelResolver implements IModelResolver
{
	/**
	 * @var bool
	 */
	private $autoMap;

	/**
	 * ModelResolver constructor.
	 * TODO Configure on construct
	 */
	public function __construct($autoMap = false)
	{
		$this->autoMap = $autoMap;
	}

	/**
	 * @param bool $autoMap
	 */
	public function AutoMap($autoMap)
	{
		$this->autoMap = $autoMap;
	}

	/**
	 * @param string|OneDBModel $model
	 */
	public function GetMapping($model)
	{
		if (!is_subclass_of($model, OneDB::ModelBaseClass))
			throw new ModelResolverException("Failed to resolve model '$model' - no such class which implements '" . OneDB::ModelBaseClass . "' exists");

		if (is_object($model))
			$model = $model::Model();

		$modelMapping = $model . 'Mapping';

		/* @var $test OneDBMapping */
		$mapping = new $modelMapping($model);
		if ($this->autoMap)
			$mapping->AutoMap();
		return $mapping;
	}
}

/**
 * Internal exceptions
 */
class ModelResolverException extends Exception
{
}