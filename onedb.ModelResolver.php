<?php

class ModelResolver implements IModelResolver
{
	public function GetMapping($model)
	{
		$mapping = $model . 'Mapping';

		/* @var $test OneDBMapping */
		$test = new $mapping($model, 'onetrack_');
		var_dump($test->GetTableName());
	}
}