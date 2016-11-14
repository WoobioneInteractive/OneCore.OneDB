<?php

/**
 * Description of onedb
 *
 * @author anton
 */
class QueryExecuter {
	
	const QueryParamPrefix = ':';
	
	/**
	 * @var IQuery 
	 */
	private $query;
	
	/**
	 * @var bool
	 */
	private $prepared = false;
	
	/**
	 * 
	 */
	public function __construct() {
		
	}
	
	/**
	 * Prepare query and params
	 */
	private function prepare() {
		if (!$this->prepared) {
			$queryString = $this->query->GetQueryString();
			$queryParameters = $this->query->GetParameters();
			
			foreach($queryParameters as $name => $value) {
				$occurances = 0;
				// TODO: Måste även kolla om parametern finns och isf. öka igen tills det går
				$queryString = preg_replace_callback('/' . self::QueryParamPrefix . $name . '/', function($match) use (&$occurances, &$queryParameters, &$value) {
					$newName = $match[0] . ($occurances++ ?: '');
					$queryParameters[$newName] = $value;
					return $newName;
				}, $queryString);
			}
		}
	}
	
}
