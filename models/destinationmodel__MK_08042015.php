<?php
Class Destinationmodel extends CI_Model
{
	function __construct()
	{
		$this->destination_table		 = "products_categories";
		$this->products_rel_table 		 = "product_cat_rel";
		$this->products_table 			 = "products";
		$this->userdetails_table		 = "user_details";
		$this->banner_image_table		 = "banner_images";
		$this->tags_table 				 = "tags";
		$this->parinfo_table 			 = "practical_information";
		$this->pro_rel_tag_table 		 = "product_rel_tags";
	}
	
	function array_merge_custom($first, $second) {
			$result = array();
			foreach($first as $key => $value) {
				$result[$key] = $value;
			}
			foreach($second as $key => $value) {
				$result[$key] = $value;
			}

			return $result;
	}
	
	
	function getprimetags($id,$filterdata)
	{
		$query = $this->db->query("select prt.product_id from ".$this->products_rel_table." as prt LEFT JOIN ".$this->products_table." as p ON(prt.product_id = p.id) WHERE status IN('active') AND prt.cat_id = '".$id."'");
		//$query = $this->db->query("select pRel.product_id,pRel.cat_id from ".$this->products_rel_table." as pRel JOIN ".$this->products_table." as p ON (pRel.product_id = p.id) WHERE p.status IN('active') AND pRel.cat_id = '".$id."' ".$filterdata."");
		
		$category_product = $query->result_array();
		$primtag = '';
		if(isset($category_product) && !empty($category_product))
		{
			foreach($category_product as $cattoproduct)
			{
				$cattoproduct2[] = $cattoproduct['product_id']; 
			}
			$matchproidtotag = implode('","',$cattoproduct2);
			$query = $this->db->query('select tag_id from '.$this->pro_rel_tag_table.' WHERE product_id IN("'.$matchproidtotag.'") AND tag_type = "primary"');
			$producttoprimetag = $query->result_array();
			foreach($producttoprimetag as $producttoprimetags)
			{
				if(isset($producttoprimetags['tag_id']) && !empty($producttoprimetags['tag_id']))
				{
					$prototagprimary[] = $this->getTagsName($producttoprimetags['tag_id']);
				}
			}
			if(isset($prototagprimary) && !empty($prototagprimary))
			{
				asort($prototagprimary);
				$primarytag = implode(',',$prototagprimary);
				$primtag = array_unique(explode(',',$primarytag));
			}
		}
		return $primtag;
		
	}
	
	function getsecoundrytags($id,$filterdata)
	{
		$query = $this->db->query("select prt.product_id from ".$this->products_rel_table." as prt LEFT JOIN ".$this->products_table." as p ON(prt.product_id = p.id) WHERE status IN('active') AND prt.cat_id = '".$id."' ".$filterdata." ORDER BY p.secondary ASC");
		//print_r("select prt.product_id from ".$this->products_rel_table." as prt LEFT JOIN ".$this->products_table." as p ON(prt.product_id = p.id) WHERE status IN('active') AND prt.cat_id = '".$id."' ".$filterdata." ORDER BY p.secondary ASC");exit;
		//$query = $this->db->query("select pRel.product_id,pRel.cat_id from ".$this->products_rel_table." as pRel JOIN ".$this->products_table." as p ON (pRel.product_id = p.id) WHERE p.status IN('active') AND pRel.cat_id = '".$id."' ".$filterdata." GROUP BY pRel.product_id");
		
		$category_product = $query->result_array();
		$secoundrytag = '';
		if(isset($category_product) && !empty($category_product))
		{
			foreach($category_product as $cattoproduct)
			{
			$cattoproduct2[] = $cattoproduct['product_id']; 
			}
			$matchproidtotag = implode('","',$cattoproduct2);
			
			//$query = $this->db->query('select * from '.$this->products_table.' WHERE id IN("'.$matchproidtotag.'  ORDER BY secondary ASC")');
			//$producttosecoundtag = $query->result_array();
			
			$query = $this->db->query('select tag_id from '.$this->pro_rel_tag_table.' WHERE product_id IN("'.$matchproidtotag.'") AND tag_type = "secondary"');
			$producttosecoundtag = $query->result_array();
			
			foreach($producttosecoundtag as $producttosecoundtags)
			{
				if(isset($producttosecoundtags['tag_id']) && !empty($producttosecoundtags['tag_id']))
				{
					$prototagsecount[] = $this->getTagsName($producttosecoundtags['tag_id']);
				}
			}
			if(isset($prototagsecount) && !empty($prototagsecount))
			{
				asort($prototagsecount);
				$secountag = implode(',',$prototagsecount);
				$secoundrytag = array_unique(explode(',',$secountag));
			}
		}
		return $secoundrytag;
	}
	
	
	
	function getTagsName($tagid)
	{
		$query = $this->db->query("select tag_name from ".$this->tags_table." WHERE id ='".$tagid."'");
		$tagid = $query->row_array();
		return $tagid['tag_name'];
	}
	
	
	
	function getdestinationdata($id)
	{
		$query = $this->db->get_where($this->destination_table,array('category_id'=>$id));
		return $query->result_array();
	}
	function getdestinationproductdata($id,$position,$items_per_group,$filterdata,$filterdata_order)
	{
		//print_r("select pRel.product_id,pRel.cat_id from ".$this->products_rel_table." as pRel JOIN ".$this->products_table." as p ON (pRel.product_id = p.id) WHERE p.status IN('active') AND pRel.cat_id = '".$id."'  ".$filterdata."  GROUP BY pRel.product_id  ".$filterdata_order." LIMIT ".$position.",".$items_per_group."");exit;
		$query = $this->db->query("select pRel.product_id,pRel.cat_id from ".$this->products_rel_table." as pRel JOIN ".$this->products_table." as p ON (pRel.product_id = p.id) WHERE p.status IN('active') AND pRel.cat_id = '".$id."'  ".$filterdata."  GROUP BY pRel.product_id  ".$filterdata_order." LIMIT ".$position.",".$items_per_group."");
		return $query->result_array();
	}
	function gettotalproduct($id,$total_limit)
	{
		$items_per_group = $total_limit;
		$query = $this->db->query("select prt.product_id from ".$this->products_rel_table." as prt LEFT JOIN ".$this->products_table." as p ON(prt.product_id = p.id) WHERE status IN('active') AND prt.cat_id = '".$id."'");
		
		//$query = $this->db->query("select product_id from ".$this->products_rel_table." WHERE cat_id = '".$id."'");
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