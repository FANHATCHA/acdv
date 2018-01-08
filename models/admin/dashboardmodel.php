<?php

class Dashboardmodel extends CI_Model{
	var $table_name	= "";
	function __construct()
	{
		$this->product_table = "products";
	}
	function getrecentproduct()
	{
		$query = $this->db->query("SELECT * FROM ".$this->product_table." ORDER BY id DESC LIMIT 0,20");
		return $query->result();
	}
}
?>