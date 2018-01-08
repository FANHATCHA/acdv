<?php
Class Tagsmodel extends CI_Model
{
	function __construct()
	{
		$this->destination_table 	= "products_categories";
		$this->products_rel_table 	= "product_cat_rel";
		$this->products_table 		= "products";
		$this->userdetails_table	= "user_details";
		$this->banner_image_table 	= "banner_images";
		$this->tags_table 			= "tags";
		$this->parinfo_table 		= "practical_information";
		$this->pro_rel_tag_table 	= "product_rel_tags";
	}
	function gettagsdata($slug)
	{
		$query = $this->db->query('select tag_description,meta_title,meta_keyword,meta_description,tag_name,robots,h1_title from '.$this->tags_table.' WHERE slug = "'.$slug.'"');
		return $query->row_array();
	}
	
	function gettagnametoid($tagname)
	{
		$query = $this->db->query('select id from '.$this->tags_table.' WHERE tag_name 	 = "'.$tagname.'"');
		$tagid =  $query->row_array();
		return $tagid['id'];
	}
	
	function gettagsproductdata($slug,$position,$items_per_group,$filterdata_order)
	{
		$tagid = $this->gettagnametoid($slug);
		$query = $this->db->query('select pt.product_id as id from '.$this->pro_rel_tag_table.' as pt LEFT JOIN '.$this->products_table.' as p ON(p.id = pt.product_id) WHERE pt.tag_id = "'.$tagid.'" AND p.status IN("active") '.$filterdata_order.' LIMIT '.$position.','.$items_per_group.'');
		//print_r('select pt.product_id as id from '.$this->pro_rel_tag_table.' as pt LEFT JOIN '.$this->products_table.' as p ON(p.id = pt.product_id) WHERE pt.tag_id = "'.$tagid.'" AND p.status IN("active") '.$filterdata_order.' LIMIT '.$position.','.$items_per_group.'');exit;
		//$query = $this->db->query('select p.id,p.primary,p.secondary from '.$this->products_table.' as p WHERE FIND_IN_SET("'.$slug.'",p.primary) OR FIND_IN_SET("'.$slug.'",p.secondary) AND p.status IN("active") '.$filterdata_order.' LIMIT '.$position.','.$items_per_group.'');
		
		
		return $query->result_array();
	}
	function gettotalproduct($slug,$total_limit)
	{
		$items_per_group = $total_limit;
		$tagid = $this->gettagnametoid($slug);
		$query = $this->db->query('select pt.product_id as id from '.$this->pro_rel_tag_table.' as pt LEFT JOIN '.$this->products_table.' as p ON(p.id = pt.product_id) WHERE pt.tag_id = "'.$tagid.'" AND p.status IN("active")');
		$totalnumrow = $query->num_rows();
		return ceil($totalnumrow/$items_per_group);
		
	}
	function getproductdetails($productid)
	{ 
		$query = $this->db->query("select * from ".$this->products_table." WHERE id = '".$productid."' AND status IN('active')");
		$productdetails = $query->result_array();
		return $productdetails;
	}
	function gettagsslider($slug)
	{
		$query = $this->db->query("select slider_id  from ".$this->tags_table." WHERE slug = '".$slug."'");
		$tags_sliderid = $query->row_array();
		$query = $this->db->query("select banner_image from ".$this->banner_image_table." WHERE banner_id= '".$tags_sliderid['slider_id']."'");
		return $query->result_array();
	}
	
	function getproductidtoslug($proid)
	{
		$query = $this->db->query("select cat_id from ".$this->products_rel_table." WHERE product_id  = '".$proid."' ORDER BY id DESC LIMIT 0,1");
		$catid = $query->row_array();
		
		if(isset($catid['cat_id']) && !empty($catid['cat_id']))
		{
			$query = $this->db->query("select slug from ".$this->destination_table." WHERE category_id = '".$catid['cat_id']."'");
			$catslug = $query->row_array();
			return $catslug['slug'];
		}
		else
		{
			return '';
		}
			
	}
	
}
?>