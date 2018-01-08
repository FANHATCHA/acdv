<?php
class Productmodel extends CI_Model{

	var $table_name	= "";
	
	function __construct()
	{
		$this->product_table 	   = "products";
		$this->banner_table  	   = "banner";
		$this->tags_table   	   = "tags";
		$this->productcat_table    = "products_categories";
		$this->product_cat_rel    = "product_cat_rel";
		$this->rel_table  = "rel_attribute";
		$this->userdetails_table = "user_details";
		$this->pro_rel_tag_table = "product_rel_tags";
		 
		
	}	
	
	/*================= USER DETAILS GET FOR RIGHT SIDE USED IN PRODUCT PAGE ==============================*/
	function getuserdetails()
	{
		$query = $this->db->query("select * from ".$this->userdetails_table." WHERE status IN('active')");
		return $query->result_array();
	}
	/*================= USER DETAILS GET FOR RIGHT SIDE USED IN PRODUCT PAGE ==============================*/
	
	
	function getrelattributes()

	{
	
	$query = $this->db->query("SELECT attribute_name  FROM ".$this->rel_table."");
	
	$attributes = $query->result_array();
	
	return $attributes;

	}
	
	function getproductdata()
	{
		$query = $this->db->query("select * from ".$this->product_table);
		return $query->result_array();
	}
	
	function getproductname($id)
	{
		$query = $this->db->query("SELECT product_name FROM ".$this->product_table." WHERE id='".$id."'");
		$productname = $query->result();
		
		return $productname[0]->product_name;
	}
	
	function single_productdata($id)
	{
		$query = $this->db->get_where($this->product_table,array('id'=>$id));
		return $query->row_array();
	}
	
	
	function getproduct()
	{
		$query = $this->db->query("select * from ".$this->product_table);
		return $query->result_array();
	}
	
	function getproductcatrelid($proid)
	{
		$query = $this->db->query("SELECT cat_id FROM ".$this->product_cat_rel." WHERE product_id='".$proid."'");
		$procatisd = $query->result();
		return $procatisd;
	}
	
	function getbannerid()
	{
		$query = $this->db->query("select * from ".$this->banner_table." WHERE status IN('active')");
		return $query->result_array();
	}
	
	
	
	/*function gettags()
	{
		$query = $this->db->query("select * from ".$this->tags_table." WHERE status IN('active') AND tag_type = 'product'");
		return $query->result_array();
	}*/
	
	function getprimarytags()
	{
		$query = $this->db->query("select * from ".$this->tags_table." WHERE status IN('active') AND tag_type = 'primary'");
		return $query->result_array();
	}
	
	function getsecondarytags()
	{
		$query = $this->db->query("select * from ".$this->tags_table." WHERE status IN('active') AND tag_type = 'secondary'");
		return $query->result_array();
	}
	
	function getselectedprimarytags($proid)
	{
		$query = $this->db->query("select tag_id from ".$this->pro_rel_tag_table." WHERE product_id='".$proid."' AND tag_type = 'primary'");
		$primarytag = $query->result_array();
		$primarytagmrg = '';
		foreach($primarytag as $primarytags)
		{
			$primarytagmrg[] = $this->getTagsName($primarytags['tag_id']);
		}
		
		if(isset($primarytagmrg) && !empty($primarytagmrg))
		{
			$primarytag = implode(',',$primarytagmrg);
		}
		else
		{
			$primarytag = '';
		}
		return $primarytag;
	}
	
	function getselectedsecondarytags($proid)
	{
		$query = $this->db->query("select tag_id from ".$this->pro_rel_tag_table." WHERE product_id ='".$proid."' AND tag_type = 'secondary'");
		$secoundrytag =  $query->result_array();
		$secoundrytagsmrg = '';
		foreach($secoundrytag as $secoundrytags)
		{
			$secoundrytagsmrg[] = $this->getTagsName($secoundrytags['tag_id']);
		}
		if(isset($secoundrytagsmrg) && !empty($secoundrytagsmrg))
		{
			$secoundrytagss = implode(',',$secoundrytagsmrg);
		}
		else
		{
			$secoundrytagss = '';
		}
		
		return $secoundrytagss;
	}
	
	function getTagsName($tagid)
	{
		$query = $this->db->query("select tag_name from ".$this->tags_table." WHERE id ='".$tagid."'");
		$tagid = $query->row_array();
		return $tagid['tag_name'];
	}
	
	
	/*function getproductcatdata() 
	{
		$query = $this->db->query("select * from ".$this->productcat_table." WHERE status IN('active') ORDER BY display_order ASC");
		$categories = $query->result_array();
		$map = array(
			0 => array('subcategories' => array())
		);
		foreach ($categories as &$category) {
			$category['subcategories'] = array();
			$map[$category['category_id']] = &$category;
		}
		foreach ($categories as &$category) {
			$map[$category['parent_id']]['subcategories'][] = &$category;
		}
		return $map[0]['subcategories'];
	}*/
	
	
	function getproductcatdata($parent = 0, $spacing = '', $user_tree_array = '') 
	{
		if (!is_array($user_tree_array))
		  $user_tree_array = array();
		  $query = $this->db->query("select * from ".$this->productcat_table." WHERE status IN('active') AND parent_id = '".$parent."' ORDER BY display_order ASC");
		  $result_cat =  $query->result();
		  $i = 1;
		  foreach($result_cat as $row) {
			$user_tree_array[] = array("category_id" =>$row->category_id, "category_name" =>$row->category_name,"status"=>$row->status,"spacing"=>$spacing);
			$user_tree_array = $this->getproductcatdata($row->category_id, $spacing.$i, $user_tree_array);
			
		 }
		  return $user_tree_array;
	}
	
	
	function gettagsids($tagsname)
	{
		
		$tagsidget1 = explode(',',$tagsname);
		$tagsidget = implode(",",$tagsidget1);
		return $tagsidget;
	}
	
	function getTagsId($tagname)
	{
		$query = $this->db->query("select id from ".$this->tags_table." WHERE tag_name ='".mysql_real_escape_string($tagname)."'");
		$tagid = $query->row_array();
		return $tagid['id'];
	}
	
	function insert_record()
	{ 
			
		$primarytag 	= $this->input->post("primary");
		$secoundrytag  = $this->input->post("secondary");
		
		$categoryids = $this->input->post("category");
		if(isset($categoryids) && !empty($categoryids))
		{
			$categorysel = implode(',',$categoryids);
		}
		else
		{
			$categorysel = '';
		}	
		
		$slug = $this->input->post("slug");
		if(isset($slug) && !empty($slug))
	    {
			$slug = $this->toAscii($this->input->post("slug"));
	    }
	    else
	    {	
		   $slug = $this->toAscii($this->input->post("product_name"));
	    }
		
		$createdate = date('Y-m-d H:i:s');
		$data= array(
			"product_name" => $this->input->post("product_name"),
			"slug" => $slug,
			"content" => $this->input->post("content"),
			"short_point" => $this->input->post("short_point"),
			"map_link" => $this->input->post("map_link"),
			"presentation" => $this->input->post("presentation"),
			"route" => $this->input->post("route"),
			"hotel" => $this->input->post("hotel"),
			"budget" => $this->input->post("budget"),
			"special_offers"=> $this->input->post("special_offers"),
			"reviews" => $this->input->post("reviews"),
			"short_description" => $this->input->post("short_description"),
			"price"=> $this->input->post("price"),
			"number_of_nights"=> $this->input->post("number_of_nights"),
			"type"=> $this->input->post("type"),
			"subtitle"=> $this->input->post("subtitle"),
			"slider_id"=> $this->input->post("slider_id"),
			"you_will_appreciate"=> $this->input->post("you_will_appreciate"),
			"authentic_experience"=> $this->input->post("authentic_experience"),
			"golf"=> $this->input->post("golf"),
			"link_travel_notebook"=> $this->input->post("link_travel_notebook"),
			"image_title_sidebar"=> $this->input->post("image_title_sidebar"),
			"primary"=> $primarytag,
			"secondary"=> $secoundrytag,
			"categories"=> $categorysel,
			"status"=> $this->input->post("status"),
			"is_display_on_sitemap"=> $this->input->post("is_display_on_sitemap"),
			"is_seo"=> $this->input->post("is_seo"),
			"rewrite_url"=> $this->input->post("rewrite_url"),
			"meta_title"=> $this->input->post("meta_title"),
			"meta_keyword"=> $this->input->post("meta_keyword"),
			"meta_description"=> $this->input->post("meta_description"),
			"robots" => $this->input->post("robots"),
			"rel"=> $this->input->post("rel"),
			"canonical_url"=> $this->input->post("canonical_url"),
			"created_date"=> $createdate,
			"modified_date"=> $createdate
		);
		
		$this->db->insert($this->product_table,$data);
		$id = $this->db->insert_id();
		
		
		
		if(isset($primarytag) && !empty($primarytag))
		{
			foreach($primarytag as $primarytags)
			{
				//$primarytagid = $this->gettagsids($primarytags);
				print_r($primarytags);
			}
		}
		exit;
		$data= array(
			"tag_id"   => $lastorderid,
			"tag_type" => 'primary'
		);
		
		$data= array(
			"tag_id"   => $lastorderid,
			"tag_type" => 'secondary'
		);
		
		//$this->db->where('id', $id);
		//$this->db->update($this->pro_rel_tag_table, $data);
		
		//$this->db->where('id',$id);
		//$this->db->update($this->pro_rel_tag_table, $data);
		
		/* DISPLAY ORDER LOGIN */
		$display_order = $this->input->post("display_order");
		
		$query = $this->db->query("select id from ".$this->product_table." WHERE display_order = ".$display_order."");
		$productid = $query->row_array();
		
		
		
		if(isset($productid) && !empty($productid))
		{
			$data= array(
				"display_order" => $display_order,
			);
			$this->db->where('id', $id);
			$this->db->update($this->product_table, $data);
			
			$query = $this->db->get_where($this->product_table);
			
			$lastorderid =  $query->num_rows();
			$data= array(
				"display_order" => $lastorderid,
			);
			$this->db->where('id', $productid['id']);
			$this->db->update($this->product_table, $data);
			
		}
		else
		{
			$data= array(
				"display_order" => $display_order,
			);
			$this->db->where('id', $id);
			$this->db->update($this->product_table, $data);
		}
		/* DISPLAY ORDER LOGIN */
		foreach($categoryids as $catids)
		{
			$data= array("product_id" => $id,"cat_id"=> $catids);
			$this->db->insert($this->product_cat_rel,$data);
		}
		
			
			
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '0';
			$config['remove_spaces'] = true;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			
			
			if($_FILES['image_link_sidebar']['name'] != "")
			{
				$uploaddir = FCPATH.'application/uploads/product/sidebarimage/';
				
				$config['upload_path'] = $uploaddir.'original/';
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);	
				
				if (!$this->upload->do_upload('image_link_sidebar'))
				{
					$error =  $this->upload->display_errors();
					$this->session->set_userdata('error_image', $error);
					redirect('admin/product');
				}
				else
				{
					$image_link_sidebar = $this->upload->data();
					$this->db->query("update ".$this->product_table." set image_link_sidebar='".$image_link_sidebar['file_name']."' where id=".$id);
					
					$upload_name = $image_link_sidebar['file_name'];
					
					$image_sizes = array(
					'thumb200' => array(200, 200),
					'thumb100' => array(100, 100),
					'thumb50' => array(50, 50)
					);
					
					foreach ($image_sizes as $key => $resize) {
					
						$config["source_image"] = $image_link_sidebar['full_path'];
						$config['new_image'] = $uploaddir.$key.'/'.$upload_name;
						$config['width'] =  $resize[0];
						$config['height'] = $resize[1];
						
						$this->load->library('image_lib');
						
						$this->image_lib->initialize($config);
						
						if ( ! $this->image_lib->resize())
						{
							 $this->image_lib->display_errors();
						}
					}
					$this->image_lib->clear();
				}
			} 
			
			if($_FILES['featured_image']['name'] != "")
			{
				$uploaddir = FCPATH.'application/uploads/product/featuredimage/';
				
				$config['upload_path'] = $uploaddir.'original/';
				
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);			
				
				if (!$this->upload->do_upload('featured_image'))
				{
					$error =  $this->upload->display_errors();
					$this->session->set_userdata('error_image', $error);
					redirect('admin/product');
				}
				else
				{
					$logo_home = $this->upload->data();
					$this->db->query("update ".$this->product_table." set featured_image='".$logo_home['file_name']."' where id=".$id);
					
					$upload_name = $logo_home['file_name'];
					
					$image_sizes = array(
					'thumb200' => array(200, 200),
					'thumb100' => array(100, 100),
					'thumb50' => array(50, 50)
					);
					
					foreach ($image_sizes as $key => $resize) {
					
						$config["source_image"] = $logo_home['full_path'];
						$config['new_image'] = $uploaddir.$key.'/'.$upload_name;
						$config['width'] =  $resize[0];
						$config['height'] = $resize[1];
						
						$this->load->library('image_lib');
						
						$this->image_lib->initialize($config);
						
						if ( ! $this->image_lib->resize())
						{
							 $this->image_lib->display_errors();
						}
					}
					$this->image_lib->clear();
				}
			}
			
			
		return $id;
	}
	
	
	function update_record($id)
	{
	   
	   //$tagsname = $this->input->post("tags");
	   // $getproductname = $this->gettagsids($tagsname);
		$categoryids = $this->input->post("category");
		
	    if(isset($categoryids) && !empty($categoryids))
		{
			$categorysel = implode(',',$categoryids);
		}
		else
		{
			$categorysel = '';
		}	
		
		$primarytag 	= $this->input->post("primary");
		$secoundrytag  = $this->input->post("secondary");
		
		
		$slug = $this->input->post("slug");
		if(isset($slug) && !empty($slug))
	    {
			$slug = $this->toAscii($this->input->post("slug"));
	    }
	    else
	    {	
		   $slug = $this->toAscii($this->input->post("product_name"));
	    }
		
	   $createdate = date('Y-m-d H:i:s');
	   $data= array(
			"product_name" => $this->input->post("product_name"),
			"slug" => $slug,
			"content" => $this->input->post("content"),
			"short_point" => $this->input->post("short_point"),
			"map_link" => $this->input->post("map_link"),
			//"user_details_id" => $this->input->post("user_details_id"),
			"presentation" => $this->input->post("presentation"),
			"route" => $this->input->post("route"),
			"hotel" => $this->input->post("hotel"),
			"budget" => $this->input->post("budget"),
			"special_offers"=> $this->input->post("special_offers"),
			"reviews" => $this->input->post("reviews"),
			"short_description" => $this->input->post("short_description"),
			"price"=> $this->input->post("price"),
			"number_of_nights"=> $this->input->post("number_of_nights"),
			"type"=> $this->input->post("type"),
			"subtitle"=> $this->input->post("subtitle"),
			"slider_id"=> $this->input->post("slider_id"),
			"you_will_appreciate"=> $this->input->post("you_will_appreciate"),
			"authentic_experience"=> $this->input->post("authentic_experience"),
			"golf"=> $this->input->post("golf"),
			"link_travel_notebook"=> $this->input->post("link_travel_notebook"),
			"image_title_sidebar"=> $this->input->post("image_title_sidebar"),
			"primary"=> $primarytag,
			"secondary"=> $secoundrytag,
			"categories"=> $categorysel,
			"status"=> $this->input->post("status"),
			"is_display_on_sitemap"=> $this->input->post("is_display_on_sitemap"),
			"is_seo"=> $this->input->post("is_seo"),
			"rewrite_url"=> $this->input->post("rewrite_url"),
			"meta_title"=> $this->input->post("meta_title"),
			"meta_keyword"=> $this->input->post("meta_keyword"),
			"robots" => $this->input->post("robots"),
			"rel"=> $this->input->post("rel"),
			"canonical_url"=> $this->input->post("canonical_url"),
			"meta_description"=> $this->input->post("meta_description"),
			"modified_date"=> $createdate
		);
			
		$this->db->where('id', $id);
		$this->db->update($this->product_table, $data);
		
		/* TAG RELATION */
		$this->db->delete($this->pro_rel_tag_table,array('product_id'=>$id));
		
		if(isset($primarytag) && !empty($primarytag))
		{	$primarytag = explode(',',$primarytag);
			foreach($primarytag as $primarytags)
			{
				$primarytagid = $this->getTagsId($primarytags);
				$data= array(
					"tag_id"   => $primarytagid,
					"tag_type" => 'primary',
					"product_id" => $id
				);
				$this->db->insert($this->pro_rel_tag_table,$data);
			}
		}
		if(isset($secoundrytag) && !empty($secoundrytag))
		{	$secoundrytag = explode(',',$secoundrytag);
			foreach($secoundrytag as $secoundrytags)
			{
				$secoundrytagid = $this->getTagsId($secoundrytags);
				$data= array(
					"tag_id"   => $secoundrytagid,
					"tag_type" => 'secondary',
					"product_id" => $id
					
				);
				$this->db->insert($this->pro_rel_tag_table,$data);
			}
		}
		
		/* TAG RELATION */
		
		/* DISPLAY ORDER LOGIN */
		$display_order = $this->input->post("display_order");
	
		$query = $this->db->query("select id,display_order from ".$this->product_table." WHERE display_order = '".$display_order."'");
		$productid = $query->row_array();
		
		$query = $this->db->query("select id,display_order from ".$this->product_table." WHERE id = '".$id."'");
		$currentid = $query->row_array();
		
		
		if(isset($productid) && !empty($productid))
		{
			$data= array(
				"display_order" => $display_order,
			);
			$this->db->where('id', $id);
			$this->db->update($this->product_table, $data);
			
			$query = $this->db->get_where($this->product_table);
			
			$data= array(
				"display_order" => $currentid['display_order'],
			);
			$this->db->where('id', $productid['id']);
			$this->db->update($this->product_table, $data);
			
		}
		else
		{
			$data= array(
				"display_order" => $display_order,
			);
			$this->db->where('id', $id);
			$this->db->update($this->product_table, $data);
		}
		/* DISPLAY ORDER LOGIN */
		
		$this->db->delete($this->product_cat_rel,array('product_id'=>$id));
		foreach($categoryids as $catids)
		{
			$data= array("product_id" => $id,"cat_id"=> $catids);
			$this->db->insert($this->product_cat_rel,$data);
		}
	
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '0';
		$config['remove_spaces'] = true;
		$config['encrypt_name'] = true;
		$config['max_width']  = '';
		$config['max_height']  = '';
		
		if($_FILES['image_link_sidebar']['name'] != "")
		{
			$uploaddir = FCPATH.'application/uploads/product/sidebarimage/';
			
			$config['upload_path'] = $uploaddir.'original/';
			 
			$this->load->library('upload', $config);
			$this->upload->initialize($config);	
			
			if (!$this->upload->do_upload('image_link_sidebar'))
			{
				$error =  $this->upload->display_errors();
				$this->session->set_userdata('error_image', $error);
				redirect('admin/product');
			}
			else
			{
				$image_link_sidebar = $this->upload->data();
				$this->db->query("update ".$this->product_table." set image_link_sidebar='".$image_link_sidebar['file_name']."' where id=".$id);
				
				$upload_name = $image_link_sidebar['file_name'];
				
				$image_sizes = array(
				'thumb200' => array(200, 200),
				'thumb100' => array(100, 100),
				'thumb50' => array(50, 50)
				);
				
				foreach ($image_sizes as $key => $resize) {
				
					$config["source_image"] = $image_link_sidebar['full_path'];
					$config['new_image'] = $uploaddir.$key.'/'.$upload_name;
					$config['width'] =  $resize[0];
					$config['height'] = $resize[1];
					
					$this->load->library('image_lib');
					
					$this->image_lib->initialize($config);
					
					if ( ! $this->image_lib->resize())
					{
						 $this->image_lib->display_errors();
					}
				}
				$this->image_lib->clear();
			}
		}
		
		
		if($_FILES['featured_image']['name'] != "")
		{
			$uploaddir = FCPATH.'application/uploads/product/featuredimage/';
			
			$config['upload_path'] = $uploaddir.'original/';
			
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);			
			
			if (!$this->upload->do_upload('featured_image'))
			{
				$error =  $this->upload->display_errors();
				$this->session->set_userdata('error_image', $error);
				redirect('admin/product');
			}
			else
			{
				$logo_home = $this->upload->data();
				$this->db->query("update ".$this->product_table." set featured_image='".$logo_home['file_name']."' where id=".$id);
				
				$upload_name = $logo_home['file_name'];
				
				$image_sizes = array(
				'thumb200' => array(200, 200),
				'thumb100' => array(100, 100),
				'thumb50' => array(50, 50)
				);
				
				foreach ($image_sizes as $key => $resize) {
				
					$config["source_image"] = $logo_home['full_path'];
					$config['new_image'] = $uploaddir.$key.'/'.$upload_name;
					$config['width'] =  $resize[0];
					$config['height'] = $resize[1];
					
					$this->load->library('image_lib');
					
					$this->image_lib->initialize($config);
					
					if ( ! $this->image_lib->resize())
					{
						 $this->image_lib->display_errors();
					}
				}
				$this->image_lib->clear();
			}
		}
		
	}
	
	function toAscii($str) {
		$replace = array(
			'&lt;' => '', '&gt;' => '', '&#039;' => '', '&amp;' => '',
			'&quot;' => '', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'Ae',
			'&Auml;' => 'A', 'Å' => 'A', 'Ā' => 'A', 'Ą' => 'A', 'Ă' => 'A', 'Æ' => 'Ae',
			'Ç' => 'C', 'Ć' => 'C', 'Č' => 'C', 'Ĉ' => 'C', 'Ċ' => 'C', 'Ď' => 'D', 'Đ' => 'D',
			'Ð' => 'D', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ē' => 'E',
			'Ę' => 'E', 'Ě' => 'E', 'Ĕ' => 'E', 'Ė' => 'E', 'Ĝ' => 'G', 'Ğ' => 'G',
			'Ġ' => 'G', 'Ģ' => 'G', 'Ĥ' => 'H', 'Ħ' => 'H', 'Ì' => 'I', 'Í' => 'I',
			'Î' => 'I', 'Ï' => 'I', 'Ī' => 'I', 'Ĩ' => 'I', 'Ĭ' => 'I', 'Į' => 'I',
			'İ' => 'I', 'Ĳ' => 'IJ', 'Ĵ' => 'J', 'Ķ' => 'K', 'Ł' => 'K', 'Ľ' => 'K',
			'Ĺ' => 'K', 'Ļ' => 'K', 'Ŀ' => 'K', 'Ñ' => 'N', 'Ń' => 'N', 'Ň' => 'N',
			'Ņ' => 'N', 'Ŋ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O',
			'Ö' => 'Oe', '&Ouml;' => 'Oe', 'Ø' => 'O', 'Ō' => 'O', 'Ő' => 'O', 'Ŏ' => 'O',
			'Œ' => 'OE', 'Ŕ' => 'R', 'Ř' => 'R', 'Ŗ' => 'R', 'Ś' => 'S', 'Š' => 'S',
			'Ş' => 'S', 'Ŝ' => 'S', 'Ș' => 'S', 'Ť' => 'T', 'Ţ' => 'T', 'Ŧ' => 'T',
			'Ț' => 'T', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'Ue', 'Ū' => 'U',
			'&Uuml;' => 'Ue', 'Ů' => 'U', 'Ű' => 'U', 'Ŭ' => 'U', 'Ũ' => 'U', 'Ų' => 'U',
			'Ŵ' => 'W', 'Ý' => 'Y', 'Ŷ' => 'Y', 'Ÿ' => 'Y', 'Ź' => 'Z', 'Ž' => 'Z',
			'Ż' => 'Z', 'Þ' => 'T', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
			'ä' => 'ae', '&auml;' => 'ae', 'å' => 'a', 'ā' => 'a', 'ą' => 'a', 'ă' => 'a',
			'æ' => 'ae', 'ç' => 'c', 'ć' => 'c', 'č' => 'c', 'ĉ' => 'c', 'ċ' => 'c',
			'ď' => 'd', 'đ' => 'd', 'ð' => 'd', 'è' => 'e', 'é' => 'e', 'ê' => 'e',
			'ë' => 'e', 'ē' => 'e', 'ę' => 'e', 'ě' => 'e', 'ĕ' => 'e', 'ė' => 'e',
			'ƒ' => 'f', 'ĝ' => 'g', 'ğ' => 'g', 'ġ' => 'g', 'ģ' => 'g', 'ĥ' => 'h',
			'ħ' => 'h', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ī' => 'i',
			'ĩ' => 'i', 'ĭ' => 'i', 'į' => 'i', 'ı' => 'i', 'ĳ' => 'ij', 'ĵ' => 'j',
			'ķ' => 'k', 'ĸ' => 'k', 'ł' => 'l', 'ľ' => 'l', 'ĺ' => 'l', 'ļ' => 'l',
			'ŀ' => 'l', 'ñ' => 'n', 'ń' => 'n', 'ň' => 'n', 'ņ' => 'n', 'ŉ' => 'n',
			'ŋ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'oe',
			'&ouml;' => 'oe', 'ø' => 'o', 'ō' => 'o', 'ő' => 'o', 'ŏ' => 'o', 'œ' => 'oe',
			'ŕ' => 'r', 'ř' => 'r', 'ŗ' => 'r', 'š' => 's', 'ù' => 'u', 'ú' => 'u',
			'û' => 'u', 'ü' => 'ue', 'ū' => 'u', '&uuml;' => 'ue', 'ů' => 'u', 'ű' => 'u',
			'ŭ' => 'u', 'ũ' => 'u', 'ų' => 'u', 'ŵ' => 'w', 'ý' => 'y', 'ÿ' => 'y',
			'ŷ' => 'y', 'ž' => 'z', 'ż' => 'z', 'ź' => 'z', 'þ' => 't', 'ß' => 'ss',
			'ſ' => 'ss', 'ый' => 'iy', 'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G',
			'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I',
			'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
			'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F',
			'Х' => 'H', 'Ц' => 'C', 'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SCH', 'Ъ' => '',
			'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA', 'а' => 'a',
			'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo',
			'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l',
			'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's',
			'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
			'ш' => 'sh', 'щ' => 'sch', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e',
			'ю' => 'yu', 'я' => 'ya'
		);
		$clean = str_replace(" ",'-', $str);
		$clean = str_replace(array_keys($replace),$replace,$clean);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/",'', $clean);
		$clean = str_replace("|",'', $clean);
		$clean = str_replace("--",'-', $clean);
		$clean = strtolower(trim($clean));
		return $clean;
	}
	function delete_record($id)
	{
		$this->db->delete($this->product_table,array('id'=>$id));
	}
	function update_statusm($id)
	{
		$this->db->query('update '.$this->product_table.' set status = case when status="active" then "inactive" else "active" end where id = "'.$id.'"');
	}
	function update_statusactive($id)
	{
		$this->db->query('update '.$this->product_table.' set status = "active"  where id = "'.$id.'"');
	}
	function update_statusinactive($id)
	{
		$this->db->query('update '.$this->product_table.' set status = "inactive"  where id = "'.$id.'"');
	}
	function displayorder()
	{
		$query = $this->db->get_where($this->product_table);
		return $query->num_rows();
	}

}
?>