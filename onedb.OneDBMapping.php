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
	public final function __construct($modelName = null)
	{
		$this->mappingForModel = $modelName ?: str_ireplace('mapping', '', static::class);
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
		return $this->GetOption(self::Opt_TableName, strtolower($this->mappingForModel) . 's');
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
	 * Map model automatically from all its properties
	 * @throws OneDBMappingException
	 */
	public function AutoMap()
	{
		if (!class_exists($this->mappingForModel))
			throw new OneDBMappingException("Failed to automap model '{$this->mappingForModel}' - no such class");

		if (!is_subclass_of($this->mappingForModel, OneDB::ModelBaseClass))
			throw new OneDBMappingException("Failed to automap model '{$this->mappingForModel}' - corresponding class does not extend '" . OneDB::ModelBaseClass . "'");

		foreach (array_keys(get_class_vars($this->mappingForModel)) as $propertyName) {
			$this->properties[$propertyName] = $this->GetPropertyMapping($propertyName, [
				self::Map_Column => $propertyName
			]);
		}
	}
}

/**
 * Class OneDBMappingException
 */
class OneDBMappingException extends Exception
{
}