<?php
/*
* Contains APIs which handle mercenary settings
*/

//require_once('config.php');
class MercMgmnt
{
	public $config;
	
	public function  __construct()
	{
		//$this->config = new config();
	}
	
	/**
     *
     * @url GET /
     */
	 public function index()
	 {
		return "Welcome to A3!";
	 }
}
?>