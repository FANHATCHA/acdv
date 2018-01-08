<?php
Class Mariesmodel extends CI_Model
{
	function __construct()
	{
		$this->cmspage_table = "cmspage";
	}
	
	function getcmspagedetails($pageid)
	{
		$query = $this->db->query("select cms_content,cms_title from ".$this->cmspage_table." WHERE id = '".$pageid."' ");
		return $query->row_array();
	}
	
}
?>