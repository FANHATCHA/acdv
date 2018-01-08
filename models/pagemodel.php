<?php
Class Pagemodel extends CI_Model
{
	function __construct()
	{
		$this->page_table = "cmspage";
	}
	
	function getpagedata($id)
	{
		$query = $this->db->get_where($this->page_table,array('id'=>$id));
		return $query->result_array();
	}
	
	function getpagedetails($id)
	{
		$query = $this->db->query("select meta_title,meta_keyword,meta_description,cms_title,robots,slug from ".$this->page_table." WHERE id = '".$id."' AND status IN('active')");
		return $query->result_array();
	}
}
?>