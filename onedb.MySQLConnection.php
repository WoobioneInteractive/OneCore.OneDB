<?php

class MySQLConnection implements IDatabaseConnection
{
	/**
	 * @var PDO
	 */
	private $pdo = null;

	/**
	 * @var string
	 */
	private $host = null;

	/**
	 * @var string
	 */
	private $databaseName = null;

	/**
	 * @var string
	 */
	private $username = null;

	/**
	 * @var string
	 */
	private $password = null;

	public function __construct($host, $databaseName, $username, $password)
	{
		if (!filter_var(gethostbyname($host), FILTER_VALIDATE_IP))
			throw new MySQLConnectionException("Could not find host '$host'");

		$this->host = $host;
		$this->databaseName = $databaseName;
		$this->username = $username;
		$this->password = $password;
	}

	public function Connect()
	{
		var_dump("connected");
		if (is_null($this->pdo)) {
			$options = [
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			];
			$this->pdo = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password, $options);
		}
	}
}

/**
 * Class MySQLConnectionException
 */
class MySQLConnectionException extends Exception
{
}