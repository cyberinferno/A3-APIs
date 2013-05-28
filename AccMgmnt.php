<?php
/*
* Contains APIs which handle account settings
*/

require_once('config.php');
class AccMgmnt
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
    * @url GET /login @data
    */
	public function login($data)
	{
		if(isset($data['appid']) && $data['appid'] == $config->app_id)
		{
			if(isset($data['username']) && isset($data['password']))
			{
				$username = $data['username'];
				$password = $data['password'];
				$query = odbc_exec($config->con,"SELECT c_headera FROM account WHERE c_id='$username'");
				$num_rows = odbc_num_rows($query);
				if($num_rows != 0)
				{
					$pass = odbc_result($query, 'c_headera');
					if($pass == $password)
						return array('RESULT' => 'SUCCESS');
					else
						return array('RESULT' => 'FAILURE', 'REASON' => 'Invalid password');
				}
				else
					return array('RESULT' => 'FAILURE', 'REASON' => 'Invalid username');
			}
			else
				return array('RESULT' => 'FAILURE', 'REASON' => 'Incomplete data');
		}
		else
			return array('RESULT' => 'FAILURE', 'REASON' => 'Invalid Application ID');
	}
	
	/**
    *
    * @url GET /register @data
    */
	public function register($data)
	{
		if(isset($data['appid']) && $data['appid'] == $config->app_id)
		{
			if(isset($data['username']) && isset($data['password']) && isset($data['email']))
			{
				$username = $data['username'];
				$password = $data['password'];
				$email = $data['email'];
				$query = odbc_exec($config->con,"SELECT * FROM account WHERE c_id='$username'");
				$num_rows = odbc_num_rows($query);
				if($num_rows == 0)
				{
					$date = date();
					$sql1 = "INSERT INTO account (c_id, c_sheadera, c_sheaderb, c_sheaderc, c_headera, c_headerb, c_headerc, d_cdate, d_udate, c_status, m_body, acc_status) VALUES ('$username', 'reserve', 'reserve', 'reserve', '$password', '$email', 'reserve', CONVERT(DATETIME, '$date', 102), CONVERT(DATETIME, '$date', 102), 'F', 'reserve', 'Normal')";
					$query1 = odbc_exec($config->con, $sql1);
					if(!$query1)
						return array('RESULT' => 'FAILURE', 'REASON' => 'Could not update database');
					else
						return array('RESULT' => 'SUCCESS');						
				}
				else
					return array('RESULT' => 'FAILURE', 'REASON' => 'Username already exists');
			}
			else
				return array('RESULT' => 'FAILURE', 'REASON' => 'Incomplete data');
		}
		else
			return array('RESULT' => 'FAILURE', 'REASON' => 'Invalid Application ID');
	}
	
	/**
    *
    * @url GET /fpasswd @data
    */
	public function forgot_passwd($data)
	{
		if(isset($data['appid']) && $data['appid'] == $config->app_id)
		{
			if(isset($data['username']))
			{
				$username = $data['username'];
				$query = odbc_exec($config->con,"SELECT c_headerb FROM account WHERE c_id='$username'");
				$num_rows = odbc_num_rows($query);
				if($num_rows != 0)
				{
					$email = odbc_result($query,'c_headerb');
					$new_passwd = substr(sha1(uniqid(rand(),true)), 0, 5);
					$sql1 = "update account set c_headera = '$new_pass' where c_id = '$username'";
					$query1 = odbc_exec($config->con, $sql1);
					if(!$query1)
						return array('RESULT' => 'FAILURE', 'REASON' => 'Could not update database');
					else
						return array('RESULT' => 'SUCCESS', 'DATA' => array('EMAIL' => $email, 'PASSWD' => $new_passwd));					
				}
				else
					return array('RESULT' => 'FAILURE', 'REASON' => 'Invalid username');
			}
			else
				return array('RESULT' => 'FAILURE', 'REASON' => 'Incomplete data');
		}
		else
			return array('RESULT' => 'FAILURE', 'REASON' => 'Invalid Application ID');
	}
	
	/**
    *
    * @url GET /changepasswd @data
    */
	public function change_password($data)
	{
		if(isset($data['appid']) && $data['appid'] == $config->app_id)
		{
			if(isset($data['username']) && isset($data['oldpassword']) && isset($data['newpassword']))
			{
				$username = $data['username'];
				$opassword = $data['oldpassword'];
				$npassword = $data['newpassword'];
				$query = odbc_exec($config->con,"SELECT c_headera FROM account WHERE c_id='$username'");
				$num_rows = odbc_num_rows($query);
				if($num_rows != 0)
				{
					$pass = odbc_result($query, 'c_headera');
					if($pass == $opassword)
					{
						$sql1 = "update account set c_headera = '$npassword' where c_id = '$username'";
						$query1 = odbc_exec($config->con, $sql1);
						if(!$query1)
							return array('RESULT' => 'FAILURE', 'REASON' => 'Could not update database');
						else
							return array('RESULT' => 'SUCCESS');
					}
					else
						return array('RESULT' => 'FAILURE', 'REASON' => 'Invalid old password');
				}
				else
					return array('RESULT' => 'FAILURE', 'REASON' => 'Invalid username');
			}
			else
				return array('RESULT' => 'FAILURE', 'REASON' => 'Incomplete data');
		}
		else
			return array('RESULT' => 'FAILURE', 'REASON' => 'Invalid Application ID');
	}
}
?>