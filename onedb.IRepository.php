<?php

interface IRepository
{
	/**
	 * Load type model by id
	 * @return mixed
	 */
	public function FindByID($model, $id);

	/**
	 * @return mixed
	 */
	public function FindOne($model);

	/**
	 * Load all of type model
	 * @param string $model Get by using ModelName::Model()
	 * @return array
	 */
	public function FindAll($model);
}