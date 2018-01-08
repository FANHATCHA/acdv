<?php
Class Destinationmodel extends CI_Model
{
	function __construct()
	{
		$this->destination_table = "products_categories";
		$this->products_rel_table = "product_cat_rel";
		$this->products_table = " products";
		$this->userdetails_table = "user_details";
		$this->banner_image_table = "banner_images";
		$this->tags_table = "tags";
		$this->parinfo_table = "practical_information";
	}
	
	
	
	function getprimetags()
	{
		$query = $this->db->query("select tag_name from ".$this->tags_table." WHERE tag_type = 'primary' AND status IN('active') ORDER BY id DESC");
		return $query->result_array();
		
	}
	
	function getsecoundrytags()
	{
		$query = $this->db->query("select tag_name from ".$this->tags_table." WHERE tag_type = 'secondary' AND status IN('active') ORDER BY id DESC");
		return $query->result_array();
		
	}
	
	
	function getdestinationdata($id)
	{
		$query = $this->db->get_where($this->destination_table,array('category_id'=>$id));
		return $query->result_array();
	}
	function getdestinationproductdata($id,$position,$items_per_group,$filterdata,$filterdata_order)
	{
		$query = $this->db->query("select pRel.product_id,pRel.cat_id from ".$this->products_rel_table." as pRel,".$this->products_table." as p WHERE pRel.product_id = p.id AND pRel.cat_id = '".$id."' AND p.status IN('active') ".$filterdata."  ".$filterdata_order." LIMIT ".$position.",".$items_per_group."");
		return $query->result_array();
	}
	function gettotalproduct($id,$total_limit)
	{
		$items_per_group = $total_limit;
		$query = $this->db->query("select product_id from ".$this->products_rel_table." WHERE cat_id = '".$id."'");
		$totalnumrow = $query->num_rows();
		return ceil($totalnumrow/$items_per_group);
		
	}
	function getproductdetails($productid)
	{ 
		$query = $this->db->query("select * from ".$this->products_table." WHERE id = '".$productid."' AND status IN('active') ORDER BY id DESC");
		$productdetails = $query->result_array();
		return $productdetails;
	}
	function getuserdetails($id)
	{
		$query = $this->db->query("select * from ".$this->userdetails_table." WHERE id = '".$id."' AND status IN('active')");
		return $query->result_array();
	}
	function getdestinationslider($id)
	{
		$query = $this->db->query("select slider_id  from ".$this->destination_table." WHERE category_id = '".$id."'");
		$dest_sliderid = $query->result_array();
		$query = $this->db->query("select banner_image from ".$this->banner_image_table." WHERE banner_id= '".$dest_sliderid[0]['slider_id']."'");
		return $query->result_array();
		
	}
	
}
?>