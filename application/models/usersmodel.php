<?php
class UsersModel extends CI_Model {

	var $user_id = '';
	var $user_name = '';
	var $user_secret = '';
	var $user_rights = '';
	var $user_login_stamp = '';
	var $user_logout_stamp = '';
	var $isUser = '';
	var $email = '';

	var $remoteIP_exists = '';
	var $remoteIP_count = '';

	var $remoteIP_array = '';
	var $remoteIP_count_array = '';
	var $currentIP_count_array = '';

	var $accessArray = '';
	var $count_D = '';
	var $count_P = '';

	#boolean check of a valid user

	function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this -> load -> helper('array');
	}

	function get_user() {
		#receive user credentials from the login page
		$this -> user_name = $this -> input -> post('username');
		$this -> user_secret = $this -> input -> post('secret');

		#CI query structure
		$query = $this -> db -> query("SELECT usersID,userName, userRights FROM users 
	 WHERE userName= '" . $this -> user_name . "' AND userPassword ='" . $this -> user_secret . "'");

		if ($query -> num_rows() > 0) {
			//set session variables

			$row = $query -> row();
			$this -> email = $row -> userName;

			$this -> isUser = true;
		} else {
			$this -> isUser = false;
		}
		return $this -> isUser;

	}

	function insert_user() {
		$this -> $user_name = $this -> input -> post('email');
		$this -> $user_secret = $this -> input -> post('password');
		$this -> $user_rights = $this -> input -> post('rights');

		$this -> db -> insert('users', $this);
	}

	function update_user() {
		$this -> $user_secret = $this -> input -> post('password');
		$this -> $user_rights = $this -> input -> post('rights');

		$this -> db -> update('entries', $this, array('id' => $_POST['id']));
	}

	function getLog() {

		$query_remoteIP_exists = $this -> db -> query("SELECT DISTINCT remoteIP FROM accesslog");

		$row_remoteIP_exists = $query_remoteIP_exists -> result_array();

		foreach ($row_remoteIP_exists as $key => $item) {
			$this -> remoteIP_array[$key] = $item;
			$query_remoteIP_count = $this -> db -> query("SELECT DISTINCT users.userName,remoteIP,COUNT(*) AS IP_Address FROM users,accesslog WHERE remoteIP = remoteIP = '" . $item['remoteIP'] . "' AND users.usersID=accessLog.usersID");

			$row_remoteIP_count = $query_remoteIP_count -> result_array();

			foreach ($row_remoteIP_count as $key => $item) {
				$this -> remoteIP_count_array[$key] = $item;

				$this -> accessArray[] = array($item['userName'], (int) $item['IP_Address']);

			}
		}

		return $this -> accessArray;
	}

}
?>