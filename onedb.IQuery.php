<?php

/**
 * Description of onedb
 *
 * @author A.G. Netterwall <netterwall@gmail.com>
 */
interface IQuery {
	
	/**
	 * @return string
	 */
	public function GetQueryString();
	
	/**
	 * @return array
	 */
	public function GetParameters();
	
}
