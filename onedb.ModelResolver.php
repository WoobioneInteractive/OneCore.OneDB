<?php

class ModelResolver implements IModelResolver
{
	/**
	 * @var string|OneDBModel
	 */
	private $model;

	/**
	 * @var bool
	 */
	private $autoMap;

	/**
	 * ModelResolver constructor.
	 * @var string $modelName
	 */
	public function __construct($model)
	{
		$this->model = $model;
	}

	/**
	 * @param string|OneDBModel $model
	 * @return array
	 * @throws ModelResolverException
	 */
	public function GetMapping()
	{
		if (!is_subclass_of($this->modelName, OneDB::ModelBaseClass))
			throw new ModelResolverException("Failed to resolve model '{$this->model}' - no such class which implements '" . OneDB::ModelBaseClass . "' exists");

		if (is_object($this->model))
			$model = '';//($this->model)::Model();

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