<?php
class Importmodel extends CI_Model{
	var $table_name	= "";
	function __construct()
	{
		$this->user_table = "users";
	}
	 
		 
	function insert_csv($data) 
	{
		$this->db->insert('url_redirect', $data);
	}

}
?>