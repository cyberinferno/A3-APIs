<?php
/*
* Contains APIs which handle character settings
*/

require_once('config.php');
class CharMgmnt
{
	public $config;
	
	public function  __construct()
	{
		$this->config = new config();
	}
	
	/**
     *
     * @url GET /
     */
	 public function index()
	 {
		return "Welcome to A3!";
	 }
	 
	/**
    *
    * @url GET /getlist @data
    */
	public function get_character_list($data)
	{
		if(isset($data['appid']) && $data['appid'] == $config->app_id)
		{
			if(isset($data['username']))
			{
				$sql = "select c_id from charac0 where c_sheadera = '$username'";
				$query = odbc_exec($config->con, $sql);
				$num_rows = odbc_num_rows($query);
				if($num_rows != 0)
				{
					$i = 0;
					while(odbc_fetch_row($query))
					{
						$chars[$i] = odbc_result($query, 'c_id');
						$i++;
					}
					$count = count($chars);
					return array('RESULT' => 'SUCCESS', 'DATA' => array('COUNT' => $count, 'CHARACTERS' => $chars));
				}
				else
					return array('RESULT' => 'FAILURE', 'REASON' => 'No characters found!');
			}
			else
				return array('RESULT' => 'FAILURE', 'REASON' => 'Incomplete data');
		}
		else
			return array('RESULT' => 'FAILURE', 'REASON' => 'Invalid Application ID');
	}
	
	/**
    *
    * @url GET /getdetails @data
    */
	public function get_character_details($data)
	{
		if(isset($data['appid']) && $data['appid'] == $config->app_id)
		{
		}
		else
			return array('RESULT' => 'FAILURE', 'REASON' => 'Invalid Application ID');
	}
	
	/**
    *
    * @url GET /charexists @data
    */
	public function character_exists($data)
	{
		if(isset($data['appid']) && $data['appid'] == $config->app_id)
		{
		}
		else
			return array('RESULT' => 'FAILURE', 'REASON' => 'Invalid Application ID');
	}
	
	/**
    *
    * @url GET /updaterb @data
    */
	public function update_character_rebirth($data)
	{
		if(isset($data['appid']) && $data['appid'] == $config->app_id)
		{
		}
		else
			return array('RESULT' => 'FAILURE', 'REASON' => 'Invalid Application ID');
	}
	
	/**
    *
    * @url GET /getinv @data
    */
	public function get_character_inventory($data)
	{
		if(isset($data['appid']) && $data['appid'] == $config->app_id)
		{
		}
		else
			return array('RESULT' => 'FAILURE', 'REASON' => 'Invalid Application ID');
	}
	
	/**
    *
    * @url GET /updateinv @data
    */
	public function update_character_inventory($data)
	{
		if(isset($data['appid']) && $data['appid'] == $config->app_id)
		{
		}
		else
			return array('RESULT' => 'FAILURE', 'REASON' => 'Invalid Application ID');
	}
}
?>