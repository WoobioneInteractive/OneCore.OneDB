<?php

class OneDBMapping
{
	// Options
	const Opt_TableName = 'tableName';
	const Opt_Identifier = 'identifierProperty';

	// Property mappings
	const Map_Column = 'column';

	/**
	 * Name of model mapping belongs to
	 * @var string
	 */
	protected $mappingForModel;

	/**
	 * @var string
	 */
	protected $tablePrefix;

	/**
	 * @var array
	 */
	protected $options = [];

	/**
	 * @var array
	 */
	protected $properties = [];

	/**
	 * OneDBMapping constructor.
	 * @param string $modelName
	 * @param string $tablePrefix
	 */
	public final function __construct($modelName = null, $tablePrefix = '')
	{
		$this->mappingForModel = $modelName ?: str_ireplace('mapping', '', static::class);
		$this->tablePrefix = $tablePrefix;
	}

	/**
	 * @return mixed
	 */
	public function GetOption($optionName, $defaultValue = false)
	{
		return OnePHP::ValueIfExists($optionName, $this->options, $defaultValue);
	}

	/**
	 * @return string|array
	 */
	public function GetPropertyMapping($propertyName, $defaultValue = false)
	{
		return OnePHP::ValueIfExists($propertyName, $this->properties, $defaultValue);
	}

	/**
	 *
	 */
	public function GetTableName()
	{
		return $this->tablePrefix . $this->GetOption(self::Opt_TableName, strtolower($this->mappingForModel) . 's');
	}

	/**
	 *
	 */
	public function GetIDMapping()
	{
		return $this->GetPropertyMapping(
			$this->GetOption(self::Opt_Identifier, 'ID'),
			[
				self::Map_Column => $this->mappingForModel . 'ID'
			]
		);
	}

	/**
	 * TODO OneDBModel should come from somewhere, not be inline
	 */
	public function AutoMap()
	{
		if (!class_exists($this->mappingForModel))
			throw new OneDBMappingException("Failed to automap model '{$this->mappingForModel}' - no such class");

		if (!is_subclass_of($this->mappingForModel, 'OneDBModel'))
			throw new OneDBMappingException("Failed to automap model '{$this->mappingForModel}' - corresponding class does not extend 'OneDBModel'");

		var_dump(get_class_vars($this->mappingForModel));
	}
}

/**
 * Class OneDBMappingException
 */
class OneDBMappingException extends Exception
{
}