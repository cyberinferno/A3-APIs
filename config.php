<?php
/*
* Contains configuration details for APIs
*/

class config 
{
	public $db_username;
	public $db_password;
	public $char_db;
	public $merc_db;
	public $app_id;
	public $con;
	public $conhs;
	
	public function  __construct($db_username = 'sa', $db_password = 'ley', $app_id = 'demo_id')
	{
		$this->db_username = $db_username;
		$this->db_password = $db_password;
		$this->char_db = 'ASD';
		$this->merc_rb = 'HSDB';
		$this->app_id = $app_id;
		$this->con = odbc_connect('ASD', $db_username, $db_password) or die("Fatal Error : Cannot Connect To ASD Database.");
		$this->conhs = odbc_connect('HSDB', $db_username, $db_password) or die("Fatal Error : Cannot Connect To HSDB Database.");
	}
	
	public function set_app_id($app_id)
	{
		$this->app_id = $app_id;
	}
}

?>