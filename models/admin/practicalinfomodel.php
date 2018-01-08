<?php
class Practicalinfomodel extends CI_Model{

	var $table_name	= "";
	
	function __construct()
	{
		$this->product_table 	   = "practical_information";
		$this->banner_table  	   = "banner";
		$this->tags_table   	   = "tags";
		$this->productcat_table    = "practical_information_categories";
		$this->rel_table 		   = "rel_attribute";
		$this->destination_table   = "products_categories";
		$this->destination_proinfo_rel_table   = "destination_proinfo_rel";
		
	}	
	
	function getdestinationName($destinationid)
	{
		
		$query = $this->db->query("SELECT category_name FROM ".$this->destination_table." WHERE category_id = '".$destinationid."'");
		$destination = $query->row_array();
		return $destination['category_name'];
	
	}
	
	function getdestination()
	{
		$query = $this->db->query("SELECT category_id,category_name,slug FROM ".$this->destination_table." WHERE status IN('active')");
		$destination = $query->result_array();
		return $destination;
	
	}	
	
	function getrelattributes()
	{
		$query = $this->db->query("SELECT attribute_name  FROM ".$this->rel_table."");
		$attributes = $query->result_array();
		return $attributes;
	}
	
	function getpracticalinfodata()
	{
		$query = $this->db->query("select * from ".$this->product_table);
		return $query->result_array();
	}
	
	function getproductinfoname($id)
	{
		$query = $this->db->query("SELECT 	practical_information_id  FROM ".$this->product_table." WHERE id='".$id."'");
		$productinfoname = $query->result();
		return $productinfoname[0]->practical_information_id;
	}
	
	function getcatname($catid)
	{
		$query = $this->db->query("SELECT category_name FROM ".$this->productcat_table." WHERE category_id 	='".$catid."'");
		$productinfoname = $query->result();
		return $productinfoname[0]->category_name;
	}
	
	function single_practicalinfodata($id)
	{
		$query = $this->db->get_where($this->product_table,array('id'=>$id));
		return $query->row_array();
	}
	
	
	function getpracticalinfo()
	{
		$query = $this->db->query("select * from ".$this->product_table);
		return $query->result_array();
	}
	
	function getbannerid()
	{
		$query = $this->db->query("select * from ".$this->banner_table." WHERE status IN('active')");
		return $query->result_array();
	}
	
	function gettags()
	{
		$query = $this->db->query("select * from ".$this->tags_table." WHERE status IN('active') AND tag_page = 'practical_information'");
		return $query->result_array();
	}
	
	
	function getpracticalinfocatdata($parent = 0, $spacing = '', $user_tree_array = '') 
	{
		if (!is_array($user_tree_array))
		  $user_tree_array = array();
		  $query = $this->db->query("select * from ".$this->productcat_table." WHERE status IN('active') AND parent_id = '".$parent."' ORDER BY display_order ASC");
		  $result_cat =  $query->result();
		  $i = 1;
		  foreach($result_cat as $row) {
			$user_tree_array[] = array("category_id" =>$row->category_id, "category_name" =>$row->category_name,"status"=>$row->status,"spacing"=>$spacing);
			$user_tree_array = $this->getpracticalinfocatdata($row->category_id, $spacing.$i, $user_tree_array);
			
		 }
		  return $user_tree_array;
	}
	
	
	function gettagsids($tagsname)
	{
		$tagsidget1 = explode(',',$tagsname);
		$tagsidget = implode(",",$tagsidget1);
		return $tagsidget;
	}
	
	function insert_record()
	{ 
		/*$slug = $this->input->post("slug");
		if(isset($slug) && !empty($slug))
	    {
		  $slug = $this->toAscii($this->input->post("slug")); //strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post("slug")));
		}
	    else
	    {	
		  $slug = $this->toAscii($this->input->post("practical_information_title"));//strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post("category_name")));
	    }*/
		$createdate = date('Y-m-d H:i:s');
		$data= array(
			"practical_information_id" => $this->input->post("practical_information_id"),
			"destination_id" => $this->input->post("destination_id"),
			"content" => $this->input->post("content"),
			"short_description" => $this->input->post("short_description"),
			"tags"=> $this->input->post("tags"),
			"categories"=> $categoryids = $this->input->post("category"),
			"status"=> $this->input->post("status"),
			"is_display_on_sitemap"=> $this->input->post("is_display_on_sitemap"),
			"is_seo"=> $this->input->post("is_seo"),
			"display_order"=> $this->input->post("display_order"),
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
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '0';
		$config['remove_spaces'] = true;
		$config['encrypt_name'] = true;
		$config['max_width']  = '';
		$config['max_height']  = '';
		
		
		if($_FILES['featured_image']['name'] != "")
		{
			$uploaddir = FCPATH.'application/uploads/productinfo/featuredimage/';
			
			$config['upload_path'] = $uploaddir.'original/';
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);	
			
			if (!$this->upload->do_upload('featured_image'))
			{
				$error =  $this->upload->display_errors();
				$this->session->set_userdata('error_image', $error);
				redirect('admin/practicalinfo');
			}
			else
			{
				$featured_image = $this->upload->data();
				$this->db->query("update ".$this->product_table." set featured_image='".$featured_image['file_name']."' where id=".$id);
				$upload_name = $featured_image['file_name'];
				$image_sizes = array(
				'thumb200' => array(200, 200),
				'thumb100' => array(100, 100),
				'thumb50' => array(50, 50)
				);
				foreach ($image_sizes as $key => $resize) {
					$config["source_image"] = $featured_image['full_path'];
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
	
	function update_record($id)
	{
	
	   /* $slug = $this->input->post("slug");
		if(isset($slug) && !empty($slug))
	   {
		 $slug = $this->toAscii($this->input->post("slug")); //strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post("slug")));
	   }
	   else
	   {	
		 $slug = $this->toAscii($this->input->post("practical_information_title"));//strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post("category_name")));
	   }*/
	  $createdate = date('Y-m-d H:i:s');
	  $data= array(
			"practical_information_id" => $this->input->post("practical_information_id"),
			"destination_id" => $this->input->post("destination_id"),
			"content" => $this->input->post("content"),
			"short_description" => $this->input->post("short_description"),
			"tags"=> $this->input->post("tags"),
			"categories"=> $this->input->post("category"),
			"status"=> $this->input->post("status"),
			"is_display_on_sitemap"=> $this->input->post("is_display_on_sitemap"),
			"is_seo"=> $this->input->post("is_seo"),
			"display_order"=> $this->input->post("display_order"),
			"rewrite_url"=> $this->input->post("rewrite_url"),
			"meta_title"=> $this->input->post("meta_title"),
			"meta_keyword"=> $this->input->post("meta_keyword"),
			"meta_description"=> $this->input->post("meta_description"),
			"robots" => $this->input->post("robots"),
			"rel"=> $this->input->post("rel"),
			"canonical_url"=> $this->input->post("canonical_url"),
			"modified_date"=> $createdate
		);
		
		
		$this->db->where('id', $id);
		$this->db->update($this->product_table, $data);
		
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '0';
		$config['remove_spaces'] = true;
		$config['encrypt_name'] = true;
		$config['max_width']  = '';
		$config['max_height']  = '';
		
		
		if($_FILES['featured_image']['name'] != "")
		{
			$uploaddir = FCPATH.'application/uploads/productinfo/featuredimage/';
			
			$config['upload_path'] = $uploaddir.'original/';
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);	
			
			if (!$this->upload->do_upload('featured_image'))
			{
				$error =  $this->upload->display_errors();
				$this->session->set_userdata('error_image', $error);
				redirect('admin/practicalinfo');
			}
			else
			{
				$featured_image = $this->upload->data();
				$this->db->query("update ".$this->product_table." set featured_image='".$featured_image['file_name']."' where id=".$id);
				$upload_name = $featured_image['file_name'];
				$image_sizes = array(
				'thumb200' => array(200, 200),
				'thumb100' => array(100, 100),
				'thumb50' => array(50, 50)
				);
				foreach ($image_sizes as $key => $resize) {
					$config["source_image"] = $featured_image['full_path'];
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