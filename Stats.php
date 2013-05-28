<?php
/*
* Contains APIs which returns server stats
*/

//require_once('config.php');
class Stats
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