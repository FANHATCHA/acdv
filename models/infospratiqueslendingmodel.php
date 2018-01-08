<?php
Class Infospratiqueslendingmodel extends CI_Model
{
	
	function __construct()
	{
		$this->destination_table = "products_categories";
		$this->practical_information_categories_table = "practical_information_categories";
		$this->parinfo_table 	 = "practical_information";
	}
	
	function getpracticalinfodata($id)
	{
		$query = $this->db->query("select meta_title,meta_keyword,meta_description,canonical_url,category_name from ".$this->destination_table." WHERE category_id = '".$id."'");
		return $query->row_array();
	}
	
	function getcategoryimage($id)
	{
		$query = $this->db->query("select image,category_name from ".$this->destination_table." WHERE category_id = '".$id."'");
		return $query->row_array();
	}
	
	function getpracticalinfopagesname($id)
	{
		$query = $this->db->query("select practical_information_id from ".$this->parinfo_table." WHERE destination_id = '".$id."' AND status IN('active') ORDER BY display_order ASC");
		$productdetails = $query->result_array();
		return $productdetails;
	}
	
	function getcountrycattodetailscat($id)
	{
		$query = $this->db->query("select practical_information_id,meta_title,meta_keyword,meta_description,canonical_url,robots from ".$this->parinfo_table." WHERE destination_id = '".$id."' AND status IN('active') ORDER BY display_order ASC LIMIT 0,1");
		$productdetails = $query->row_array();
		return $productdetails;
	}
	
	function getpracticalinfoslugtosname($particalslug)
	{
		$query = $this->db->query("select category_name from ".$this->practical_information_categories_table." WHERE slug = '".$particalslug."'");
		$productdetails = $query->row_array();
		return $productdetails['category_name'];
	}
	
	function getdetailscatidtoslug($detailscatid)
	{
		$query = $this->db->query("select category_name,slug from ".$this->practical_information_categories_table." WHERE category_id = '".$detailscatid."'");
		$productdetails = $query->row_array();
		return $productdetails;
	}
	
	
}
?>