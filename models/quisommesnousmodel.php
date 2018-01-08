<?php
Class Quisommesnousmodel extends CI_Model
{
	function __construct()
	{
		$this->userdetails_table = "user_details";
	}
	
	function getrepresentative()
	{
		$query = $this->db->query("select cms_page_description,user_name,position,description_destination,description_product,image from ".$this->userdetails_table." WHERE status IN('active') ORDER BY user_name ASC");
		return $query->result_array();
	}
	
}
?>