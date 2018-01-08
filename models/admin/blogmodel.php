<?php
class Blogmodel extends CI_Model{

	var $table_name	= "";
	
	function __construct()
	{
		$this->blog_table 	    = "blog";
		$this->blogcat_table    = "blog_categories";
		$this->rel_table  = "rel_attribute";
		
	}	
	
	
	function getrelattributes()

	{
	
		$query = $this->db->query("SELECT attribute_name  FROM ".$this->rel_table."");
		
		$attributes = $query->result_array();
		
		return $attributes;

	}
	
	function getblogdata()
	{
		$query = $this->db->query("select * from ".$this->blog_table);
		return $query->result_array();
	}
	
	function getcategoryname($id)
	{
		$query = $this->db->query("SELECT category_name FROM ".$this->blogcat_table." WHERE category_id='".$id."'");
		$cataname = $query->result();
		return $cataname[0]->category_name;
	}
	
	function getproductinfoname($id)
	{
		$query = $this->db->query("SELECT blog_title FROM ".$this->blog_table." WHERE id='".$id."'");
		$productinfoname = $query->result();
		return $productinfoname[0]->blog_title;
	}
	
	function single_blogdata($id)
	{
		$query = $this->db->get_where($this->blog_table,array('id'=>$id));
		return $query->row_array();
	}
	
	
	function getblogcatdata($parent = 0, $spacing = '', $user_tree_array = '') 
	{
		if (!is_array($user_tree_array))
		  $user_tree_array = array();
		  $query = $this->db->query("select * from ".$this->blogcat_table." WHERE status IN('active') AND parent_id = '".$parent."' ORDER BY display_order ASC");
		  $result_cat =  $query->result();
		  $i = 1;
		  foreach($result_cat as $row) {
			$user_tree_array[] = array("category_id" =>$row->category_id, "category_name" =>$row->category_name,"status"=>$row->status,"spacing"=>$spacing);
			$user_tree_array = $this->getblogcatdata($row->category_id, $spacing.$i, $user_tree_array);
			
		 }
		  return $user_tree_array;
	}
	
	
	function insert_record()
	{ 
		$categoryids = $this->input->post("category");
		if(isset($categoryids) && !empty($categoryids))
		{
			$categorysel = implode(',',$categoryids);
		}
		else
		{
			$categorysel = '';
		}	
		$blogdate = $this->input->post("blog_date");
		
		if(isset($blogdate) && !empty($blogdate))
		{
			$createddate = date('Y-m-d H:i:s',strtotime($blogdate));
		}
		else
		{
		   $createddate = date('Y-m-d H:i:s');
		}
	
		$slug = $this->input->post("slug");
		if(isset($slug) && !empty($slug))
		{
			$slug = $this->toAscii($this->input->post("slug")); //strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post("slug")));
		}
		else
		{	
			$slug = $this->toAscii($this->input->post("blog_title"));//strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post("category_name")));
		}
		$data= array(
			"blog_title" => $this->input->post("blog_title"),
			"slug" => $slug,
			"blog_date" => $createddate,
			"slider_id" => $this->input->post("slider_id"),
			"blog_content" => $this->input->post("blog_content"),
			"categories"=> $categorysel,
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
			"created_date"=> $createddate,
			"modified_date"=> $createddate
		);
		
		$this->db->insert($this->blog_table,$data);
		$id = $this->db->insert_id();
		
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '0';
		$config['remove_spaces'] = true;
		$config['encrypt_name'] = true;
		$config['max_width']  = '';
		$config['max_height']  = '';
		
		
		if($_FILES['featured_image']['name'] != "")
		{
			$uploaddir = FCPATH.'application/uploads/blog/featuredimage/';
			
			$config['upload_path'] = $uploaddir.'original/';
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);	
			
			if (!$this->upload->do_upload('featured_image'))
			{
				$error =  $this->upload->display_errors();
				$this->session->set_userdata('error_image', $error);
				redirect('admin/practicalinfo/add');
			}
			else
			{
				$featured_image = $this->upload->data();
				$this->db->query("update ".$this->blog_table." set featured_image='".$featured_image['file_name']."' where id=".$id);
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
	
	
	function update_record($id)
	{
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
		$slug = $this->toAscii($this->input->post("slug")); //strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post("slug")));
	}
	else
	{	
		$slug = $this->toAscii($this->input->post("blog_title"));//strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post("category_name")));
	}
	$blogdate = $this->input->post("blog_date");
	if(isset($blogdate) && !empty($blogdate))
	{
		$createdate = date('Y-m-d H:i:s',strtotime($blogdate));
	}
	else
	{
	   $createdate = date('Y-m-d H:i:s');
	}
	 $data= array(
		"blog_title" => $this->input->post("blog_title"),
		"slug" => $slug,
		"blog_date" => $createdate,
		"slider_id" => $this->input->post("slider_id"),
		"blog_content" => $this->input->post("blog_content"),
		"categories"=> $categorysel,
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
		
		
		$this->db->where('id', $id);
		$this->db->update($this->blog_table, $data);
		
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '0';
		$config['remove_spaces'] = true;
		$config['encrypt_name'] = true;
		$config['max_width']  = '';
		$config['max_height']  = '';
		
		
		if($_FILES['featured_image']['name'] != "")
		{
			$uploaddir = FCPATH.'application/uploads/blog/featuredimage/';
			
			$config['upload_path'] = $uploaddir.'original/';
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);	
			
			if (!$this->upload->do_upload('featured_image'))
			{
				$error =  $this->upload->display_errors();
				$this->session->set_userdata('error_image', $error);
				redirect('admin/practicalinfo/add');
			}
			else
			{
				$featured_image = $this->upload->data();
				$this->db->query("update ".$this->blog_table." set featured_image='".$featured_image['file_name']."' where id=".$id);
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
		$this->db->delete($this->blog_table,array('id'=>$id));
	}
	function update_statusm($id)
	{
		$this->db->query('update '.$this->blog_table.' set status = case when status="active" then "inactive" else "active" end where id = "'.$id.'"');
	}
	function update_statusactive($id)
	{
		$this->db->query('update '.$this->blog_table.' set status = "active"  where id = "'.$id.'"');
	}
	function update_statusinactive($id)
	{
		$this->db->query('update '.$this->blog_table.' set status = "inactive"  where id = "'.$id.'"');
	}
	function displayorder()
	{
		$query = $this->db->get_where($this->blog_table);
		return $query->num_rows();
	}

}
?>