<?php

/**
 * Description of onedb
 *
 * @author anton
 */
class StringQuery implements IQuery {
	
	/**
	 * @var string 
	 */
	private $query = null;
	
	/**
	 * @var array
	 */
	private $queryParams = [];
	
	/**
	 * New QueryString
	 * @param string $query
	 * @param array $queryParams
	 */
	public function __construct($query, Array $queryParams = []) {
		$this->query = $query;
		$this->queryParams = $queryParams;
	}
	
	/**
	 * @return array
	 */
	public function GetParameters() {
		return $this->queryParams;
	}

	/**
	 * @return string
	 */
	public function GetQueryString() {
		return $this->query;
	}
	
}
