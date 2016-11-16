<?php

/**
 * The number one database handler for OneCore
 *
 * @author A.G. Netterwall <netterwall@gmail.com>
 */
class OneDB implements IPlugin
{
	// Configuration option
	const Config_DatabaseType = 'onedb.databaseType';
	const Config_Host = 'onedb.host';
	const Config_Database = 'onedb.database';
	const Config_Username = 'onedb.username';
	const Config_Password = 'onedb.password';
	const Config_ModelFileDirectory = 'onedb.modelFileDirectory';
	const Config_ModelFilePattern = 'onedb.modelFilePattern';

	// Database types
	const DB_MySQL = 'MySQL';
	const DB_MariaDB = 'MySQL';

	// Internal constants
	const DefaultDatabaseType = self::DB_MySQL;
	const DefaultHost = 'localhost';
	const DefaultModelFileDirectory = 'Models';
	const DefaultModelFilePattern = '{class}';
	const RepositoryInterface = 'IRepository';
	const DatabaseConnectionClassSuffix = 'Connection';
	const DatabaseConnectionInterface = 'IDatabaseConnection';

	/**
	 * @var IConfigHandler
	 */
	private $configHandler = null;

	/**
	 * @var IRepository
	 */
	private $repository = null;

	/**
	 * OneDB constructor.
	 * @param IConfigHandler $configHandler
	 * @param IFileAutoLoader $autoLoader
	 * @param IPluginLoader $pluginLoader
	 */
	public function __construct(IConfigHandler $configHandler, IFileAutoLoader $autoLoader, IPluginLoader $pluginLoader, DependencyInjector $di)
	{
		$this->configHandler = $configHandler;

		// Register autoloader for app models
		$autoLoader->AddFromDirectory(
			$pluginLoader->GetApplicationDirectory() . $configHandler->Get(self::Config_ModelFileDirectory, self::DefaultModelFileDirectory),
			$configHandler->Get(self::Config_ModelFilePattern, self::DefaultModelFilePattern));

		// Initialize main repository
		$this->repository = new DatabaseRepository($this->getMainConnection());
		$di->AddMapping(new DependencyMappingFromArray([
			self::RepositoryInterface => [
				DependencyInjector::Mapping_RemoteInstance => $this->repository
			]
		]));
	}

	/**
	 * @return IDatabaseConnection
	 */
	private function getMainConnection()
	{
		$databaseType = $this->configHandler->Get(self::Config_DatabaseType, self::DefaultDatabaseType);
		$databaseTypeConnectionClass = $databaseType . self::DatabaseConnectionClassSuffix;

		if (!class_exists($databaseTypeConnectionClass))
			throw new OneDBException("Invalid connection type '$databaseType' - no such connection handler");

		if (!OnePHP::ClassImplements($databaseTypeConnectionClass, self::DatabaseConnectionInterface))
			throw new OneDBException("Handler for connection type '$databaseType' is not a valid connection handler");

		$connection = new $databaseTypeConnectionClass(
			$this->configHandler->Get(self::Config_Host, self::DefaultHost),
			$this->configHandler->Get(self::Config_Database),
			$this->configHandler->Get(self::Config_Username),
			$this->configHandler->Get(self::Config_Password)
		);

		return $connection;
	}
}

/**
 * Class OneDBException
 */
class OneDBException extends Exception
{
}