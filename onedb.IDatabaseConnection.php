<?php

interface IDatabaseConnection
{
	public function __construct($host, $databaseName, $username, $password);

	public function Connect();
}