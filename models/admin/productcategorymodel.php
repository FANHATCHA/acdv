<?php
class Productcategorymodel extends CI_Model{

	var $table_name	= "";
	
	function __construct()
	{
		$this->productcat_table  = "products_categories";
		$this->banner_table      = "banner";
		$this->product_table 	 = "products";
		$this->product_cat_rel   = "product_cat_rel";
		$this->practical_info_cat   = "practical_information_categories";
		$this->rel_table 		 = "rel_attribute";
		$this->userdetails_table = "user_details";
	}
	
	/*================= USER DETAILS GET FOR RIGHT SIDE USED IN PRODUCT PAGE ==============================*/
	function getuserdetails()
	{
		$query = $this->db->query("select * from ".$this->userdetails_table." WHERE status IN('active')");
		return $query->result_array();
	}
	/*================= USER DETAILS GET FOR RIGHT SIDE USED IN PRODUCT PAGE ==============================*/
	
	function getproductcatname($id)
	{
		$query = $this->db->query("SELECT category_name FROM ".$this->productcat_table." WHERE category_id='".$id."'");
		$productcatname = $query->result();
		return $productcatname[0]->category_name;
	}
	
	function getusefullLink()
	{
		$query = $this->db->query("SELECT category_name,category_id FROM ".$this->practical_info_cat." WHERE parent_id 	='0' AND status IN('active')");
		$usefull_link = $query->result_array();
		return $usefull_link;
	}
	
	function getrelattributes()
	{
		$query = $this->db->query("SELECT attribute_name  FROM ".$this->rel_table."");
		$attributes = $query->result_array();
		return $attributes;
	}
	
	
	function getcattoproduct($catid)
	{
		$query = $this->db->query("SELECT id FROM ".$this->product_table." WHERE categories LIKE '%".$catid."%'");
		$productid = $query->result();
		return $productid;
	}	
	
	function getcattorelproduct($catid)
	{
		$query = $this->db->query("SELECT product_id FROM ".$this->product_cat_rel." WHERE cat_id = '".$catid."'");
		$productid = $query->result();
		return $productid;
	}
	
	
	function getallProdcuct()
	{
		$query = $this->db->query("select * from ".$this->product_table." WHERE status IN('active')");
		return $query->result_array();
	}
	
	
	function getproductcatdata() 
	{
		$query = $this->db->query("select * from ".$this->productcat_table." ORDER BY display_order ASC");
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
	}
	
	function getproductcat($parent = 0, $spacing = '', $user_tree_array = '') 
	{
		if (!is_array($user_tree_array))
		  $user_tree_array = array();
		  $query = $this->db->query("select * from ".$this->productcat_table." WHERE status IN('active') AND parent_id = '".$parent."' ORDER BY display_order ASC");
		  $result_cat =  $query->result();
		  $i = 1;
		  foreach($result_cat as $row) {
			$user_tree_array[] = array("category_id" =>$row->category_id, "category_name" =>$row->category_name,"status"=>$row->status,"spacing"=>$spacing);
			$user_tree_array = $this->getproductcat($row->category_id, $spacing.'— ', $user_tree_array);
			
		 }
		  return $user_tree_array;
	}
	
	/*function getproductcat() 
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

	function getparentid($id)
	{
		$query = $this->db->query("select parent_id from ".$this->productcat_table." WHERE category_id	= '".$id."'");
		return $query->result_array();
		
	}
	
	
	
	function single_productcategorydata($id)
	{
		$query = $this->db->get_where($this->productcat_table,array('category_id'=>$id));
		return $query->row_array();
	}
	
	function getbannerid()
	{
		$query = $this->db->query("select * from ".$this->banner_table." WHERE status IN('active')");
		return $query->result_array();
	}
	
	function insert_record()
	{ 
		$createdate = date('Y-m-d H:i:s');
		
		$slug = $this->input->post("slug");
		if(isset($slug) && !empty($slug))
		{
			$slug = $this->toAscii($this->input->post("slug")); //strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post("slug")));
		}
		else
		{	
			$slug = $this->toAscii($this->input->post("category_name"));//strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post("category_name")));
		}
		$data= array(
			"category_name" => $this->input->post("category_name"),
			"h1_name" => $this->input->post("h1_name"),
			"slug" => $slug,
			"user_details_id" => $this->input->post("user_details_id"),
			"parent_id" => $this->input->post("parent_id"),
			"category_description" => $this->input->post("category_description"),
			"slider_id" => $this->input->post("slider_id"),
			"status" => $this->input->post("status"),
			"info_usefull" => $this->input->post("info_usefull"),
			"is_seo"=> $this->input->post("is_seo"),
			"rewrite_url" => $this->input->post("rewrite_url"),
			"meta_title"=> $this->input->post("meta_title"),
			"display_order"=> $this->input->post("display_order"),
			"is_display_on_sitemap"=>$this->input->post("is_display_on_sitemap"),
			"meta_title"=> $this->input->post("meta_title"),
			"meta_keyword"=> $this->input->post("meta_keyword"),
			"meta_description"=> $this->input->post("meta_description"),
			"robots" => $this->input->post("robots"),
			"rel"=> $this->input->post("rel"),
			"canonical_url"=> $this->input->post("canonical_url"),
			"created_date"=> $createdate,
			"modified_date"=> $createdate
		);
		
		
		
		$this->db->insert($this->productcat_table,$data);
		$id = $this->db->insert_id();
		
		
		$cat_current_id = $id;
		$postproductids  = $this->input->post("product");
		$query = $this->db->query("select id from ".$this->product_table." WHERE categories LIKE '%".$cat_current_id."%'");
		$procatidscheck = $query->result_array();
		$existingproductids = array();
		
		foreach($procatidscheck as $procatidsche)
		{
			$existingproductids[] = $procatidsche['id'];
		}
		$existingproductid = implode(',',$existingproductids);
		
		$this->db->delete($this->product_cat_rel,array('cat_id'=>$cat_current_id));
		if(isset($postproductids) && !empty($postproductids))
		{
			foreach($postproductids as $postproductid)
			{
				$data= array("product_id" => $postproductid,"cat_id"=>$cat_current_id);
				$this->db->insert($this->product_cat_rel,$data);
			}
		}		
		
			
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '0';
			$config['remove_spaces'] = true;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			
			if($_FILES['image']['name'] != "")
			{
				
				$uploaddir = FCPATH.'application/uploads/destinationimage/categoryimage/';
				$config['upload_path'] = $uploaddir.'original/';
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);	
				
				if (!$this->upload->do_upload('image'))
				{
					$error =  $this->upload->display_errors();
					$this->session->set_userdata('error_image', $error);
					redirect('admin/product_category/add');
				}
				else
				{
					$image = $this->upload->data();
					$this->db->query("update ".$this->productcat_table." set image='".$image['file_name']."' where category_id=".$id);
				
					$upload_name = $image['file_name'];
					
					$image_sizes = array(
					'thumb200' => array(200, 200),
					'thumb100' => array(100, 100),
					'thumb50' => array(50, 50)
					);
					
					foreach ($image_sizes as $key => $resize) {
					
						$config["source_image"] = $image['full_path'];
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
			
			if($_FILES['logo_home']['name'] != "")
			{
				$uploaddir = FCPATH.'application/uploads/destinationimage/homelogo/';
				$config['upload_path'] = $uploaddir.'original/';
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);	
				
				if (!$this->upload->do_upload('logo_home'))
				{
					$error =  $this->upload->display_errors();
					$this->session->set_userdata('error_image', $error);
					redirect('admin/product_category/add');
				}
				else
				{
					$logo_home = $this->upload->data();
					$this->db->query("update ".$this->productcat_table." set logo_home='".$logo_home['file_name']."' where category_id=".$id);
					
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
			
			if($_FILES['logo_destination']['name'] != "")
			{
				
				$uploaddir = FCPATH.'application/uploads/destinationimage/logodestination/';
				$config['upload_path'] = $uploaddir.'original/';
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);	
				
				if (!$this->upload->do_upload('logo_destination'))
				{
					$error =  $this->upload->display_errors();
					$this->session->set_userdata('error_image', $error);
					redirect('admin/product_category/add');
				}
				else
				{
					$logo_destination = $this->upload->data();
					$this->db->query("update ".$this->productcat_table." set logo_destination='".$logo_destination['file_name']."' where category_id=".$id);
					
					$upload_name = $logo_destination['file_name'];
					
					$image_sizes = array(
					'thumb200' => array(200, 200),
					'thumb100' => array(100, 100),
					'thumb50' => array(50, 50)
					);
					
					foreach ($image_sizes as $key => $resize) {
					
						$config["source_image"] = $logo_destination['full_path'];
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
	   
	   $createdate = date('Y-m-d H:i:s');
	   $slug = $this->input->post("slug");
	   if(isset($slug) && !empty($slug))
	   {
		 $slug = $this->toAscii($this->input->post("slug")); //strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post("slug")));
	   }
	   else
	   {	
		 $slug = $this->toAscii($this->input->post("category_name"));//strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post("category_name")));
	   }
	   $data= array(
			"category_name" => $this->input->post("category_name"),
			"h1_name" => $this->input->post("h1_name"),
			"slug" => $slug,
			"user_details_id" => $this->input->post("user_details_id"),
			"parent_id" => $this->input->post("parent_id"),
			"category_description" => $this->input->post("category_description"),
			"slider_id" => $this->input->post("slider_id"),
			"status" => $this->input->post("status"),
			"info_usefull" => $this->input->post("info_usefull"),
			"is_seo"=> $this->input->post("is_seo"),
			"rewrite_url" => $this->input->post("rewrite_url"),
			"meta_title"=> $this->input->post("meta_title"),
			"display_order"=> $this->input->post("display_order"),
			"is_display_on_sitemap"=>$this->input->post("is_display_on_sitemap"),
			"meta_title"=> $this->input->post("meta_title"),
			"meta_keyword"=> $this->input->post("meta_keyword"),
			"meta_description"=> $this->input->post("meta_description"),
			"robots" => $this->input->post("robots"),
			"rel"=> $this->input->post("rel"),
			"canonical_url"=> $this->input->post("canonical_url"),
			"created_date"=> $createdate,
			"modified_date"=> $createdate
		);
		
		$this->db->where('category_id', $id);
		$this->db->update($this->productcat_table, $data);
		
			
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '0';
			$config['remove_spaces'] = true;
			$config['encrypt_name'] = true;
			$config['max_width']  = '';
			$config['max_height']  = '';
			
			
			if($_FILES['image']['name'] != "")
			{
				
				$uploaddir = FCPATH.'application/uploads/destinationimage/categoryimage/';
				$config['upload_path'] = $uploaddir.'original/';
				
				$this->load->library('upload');
				$this->upload->initialize($config);	
				
				if (!$this->upload->do_upload('image'))
				{
					$error =  $this->upload->display_errors();
					$this->session->set_userdata('error_image', $error);
					redirect('admin/product_category');
				}
				else
				{
					$image = $this->upload->data();
					$this->db->query("update ".$this->productcat_table." set image='".$image['file_name']."' where category_id=".$id);
				
					$upload_name = $image['file_name'];
					
					$image_sizes = array(
					'thumb200' => array(200, 200),
					'thumb100' => array(100, 100),
					'thumb50' => array(50, 50)
					);
					
					foreach ($image_sizes as $key => $resize) {
					
						$config["source_image"] = $image['full_path'];
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
			
			if($_FILES['logo_home']['name'] != "")
			{
				$uploaddir = FCPATH.'application/uploads/destinationimage/homelogo/';
				$config['upload_path'] = $uploaddir.'original/';
				
				$this->load->library('upload');
				$this->upload->initialize($config);	
				
				if (!$this->upload->do_upload('logo_home'))
				{
					$error =  $this->upload->display_errors();
					$this->session->set_userdata('error_image', $error);
					redirect('admin/product_category');
				}
				else
				{
					$logo_home = $this->upload->data();
					$this->db->query("update ".$this->productcat_table." set logo_home='".$logo_home['file_name']."' where category_id=".$id);
					
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
			
			if($_FILES['logo_destination']['name'] != "")
			{
				
				$uploaddir = FCPATH.'application/uploads/destinationimage/logodestination/';
				$config['upload_path'] = $uploaddir.'original/';
				
				$this->load->library('upload');
				$this->upload->initialize($config);	
				
				if (!$this->upload->do_upload('logo_destination'))
				{
					$error =  $this->upload->display_errors();
					$this->session->set_userdata('error_image', $error);
					redirect('admin/product_category');
				}
				else
				{
					$logo_destination = $this->upload->data();
					$this->db->query("update ".$this->productcat_table." set logo_destination='".$logo_destination['file_name']."' where category_id=".$id);
					
					$upload_name = $logo_destination['file_name'];
					
					$image_sizes = array(
					'thumb200' => array(200, 200),
					'thumb100' => array(100, 100),
					'thumb50' => array(50, 50)
					);
					
					foreach ($image_sizes as $key => $resize) {
					
						$config["source_image"] = $logo_destination['full_path'];
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
	function updateproductcat($postproductids)
	{
		$cat_current_id = $this->input->post('pro_cat_id');
		
		$query = $this->db->query("select id from ".$this->product_table." WHERE categories LIKE '%".$cat_current_id."%'");
		$procatidscheck = $query->result_array();
		$existingproductids = array();
		
		foreach($procatidscheck as $procatidsche)
		{
			$existingproductids[] = $procatidsche['id'];
		}
		$existingproductid = implode(',',$existingproductids);
		
		$this->db->delete($this->product_cat_rel,array('cat_id'=>$cat_current_id));
		if(isset($postproductids) && !empty($postproductids)){
			foreach($postproductids as $postproductid)
			{
				$data= array("product_id" => $postproductid,"cat_id"=>$cat_current_id);
				$this->db->insert($this->product_cat_rel,$data);
			}
		}
		
		
	}
	
	function delete_record($id)
	{
		$this->db->delete($this->productcat_table,array('category_id'=>$id));
	}
	function update_statusm($id)
	{
		$this->db->query('update '.$this->productcat_table.' set status = case when status="active" then "inactive" else "active" end where category_id = "'.$id.'"');
	}
	function update_statusactive($id)
	{
		$this->db->query('update '.$this->productcat_table.' set status = "active"  where category_id = "'.$id.'"');
	}
	function update_statusinactive($id)
	{
		$this->db->query('update '.$this->productcat_table.' set status = "inactive"  where category_id = "'.$id.'"');
	}
	function displayorder()
	{
		$query = $this->db->get_where($this->productcat_table);
		return $query->num_rows();
	}

}
?>