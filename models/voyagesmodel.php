<?php
Class Voyagesmodel extends CI_Model
{
	function __construct()
	{
		$this->products_table = "products";
		$this->bannerimage_table = "banner_images";
		$this->product_cat_rel_table = "product_cat_rel";
		$this->product_cat_table = "products_categories";
		$this->userdetails_table = "user_details";
		
	}
	
	function getproductdata($id)
	{
		$query = $this->db->query("select * from ".$this->products_table." WHERE id = '".$id."' AND status IN(1)");
		return $query->result_array();
	}
	
	function getbannerimages($id)
	{
		$query = $this->db->query("select banner_image from ".$this->bannerimage_table." WHERE banner_id = '".$id."'");
		return $query->result_array();
	}
	
	function counthits($id)
	{
		
		$query = $this->db->query("select hits from ".$this->products_table." WHERE id = '".$id."'");
		$oldhitscount = $query->result_array();
		$total_count = $oldhitscount[0]['hits'] + 1;
		
		$this->db->query('update '.$this->products_table.' set hits = '.$total_count.' where id = "'.$id.'"');
	}
	
	function getrandrelatedpro($proid,$catid)
	{
		/* select product id to category id */
		/*$query = $this->db->query("select prt.product_id,prt.cat_id from ".$this->product_cat_rel_table." as prt LEFT JOIN ".$this->products_table." as p ON(prt.product_id = p.id) WHERE p.status IN('active') AND prt.product_id = '".$id."'");
		$catid = $query->result_array();*/
		/* select product id to category id */
		
		/*=============== get related product id =============================*/
		$query = $this->db->query("select prt.product_id,prt.cat_id from ".$this->product_cat_rel_table." as prt LEFT JOIN ".$this->products_table." as p ON(prt.product_id = p.id) WHERE prt.cat_id = '".$catid."' AND prt.product_id != '".$proid."' AND p.status IN('active') ORDER BY RAND() LIMIT 0,3");
		return $query->result_array();
		/*=============== get related product id =============================*/
	}
	
	function getproductdetails($id)
	{
		$query = $this->db->query("select product_name,subtitle,number_of_nights,price,featured_image from ".$this->products_table." WHERE id = '".$id."' AND status IN('active')");
		return $query->result_array();
	}
	function getuserdetails($id)
	{
		$query = $this->db->query("select * from ".$this->userdetails_table." WHERE id = '".$id."' AND status IN('active')");
		return $query->result_array();
	}
	function getpro_cat_userd_id($id)
	{
		if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']))
		{
			$slug = end(explode('/',$_SERVER['HTTP_REFERER']));
			if(isset($slug) && !empty($slug))
			{
				$query = $this->db->query("select user_details_id from ".$this->product_cat_table." WHERE slug = '".$slug."'");
				return $query->result_array();
			}
			else
			{
				$query = $this->db->query("select cat_id from ".$this->product_cat_rel_table." WHERE product_id = '".$id."'");
				$catid =$query->result_array();
				$query = $this->db->query("select user_details_id from ".$this->product_cat_table." WHERE category_id = '".$catid[0]['cat_id']."'");
				return $query->result_array();
			}
		}
		else
		{
			$query = $this->db->query("select cat_id from ".$this->product_cat_rel_table." WHERE product_id = '".$id."'");
			$catid =$query->result_array();
			$query = $this->db->query("select user_details_id from ".$this->product_cat_table." WHERE category_id = '".$catid[0]['cat_id']."'");
			return $query->result_array();
		}
	}
	
	function autocomplete_search($searchtitle)
	{
		$query = $this->db->query("select id,product_name,slug from ".$this->products_table." WHERE status IN('active') AND product_name LIKE '%".mysql_real_escape_string($searchtitle)."%' OR content LIKE '%".mysql_real_escape_string($searchtitle)."%'");
		return  $query->result_array();
	}
	function getproducttocatslug($proid)
	{
		
		$query = $this->db->query("select cat_id from ".$this->product_cat_rel_table." WHERE product_id = '".$proid."'");
		$categoryid = $query->result_array();
		
		foreach($categoryid  as $catid)
		{
			$query = $this->db->query("select slug from ".$this->product_cat_rel_table." as pr LEFT JOIN ".$this->product_cat_table." as pc  ON(pc.category_id 	= pr.cat_id) WHERE pc.category_id = '".$catid['cat_id']."' AND pc.status IN('active') LIMIT 0,1");
			$catslug =  $query->result_array();
			return $catslug[0]['slug'];
		}
		
		
	}
	
}
?>