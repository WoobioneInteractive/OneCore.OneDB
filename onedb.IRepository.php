<?php

interface IRepository
{
	/**
	 * @return mixed
	 */
	public function LoadByID();

	public function LoadAll();
}