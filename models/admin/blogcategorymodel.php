<?php
class Blogcategorymodel  extends CI_Model{

	var $table_name	= "";
	
	function __construct()
	{
		$this->blogcat_table  = "blog_categories";
		$this->blog_table     = "blog";
		$this->banner_table   = "banner";
	}
	
	function getproductinfocatname($id)
	{
		$query = $this->db->query("SELECT category_name FROM ".$this->blogcat_table." WHERE category_id='".$id."'");
		$productinfocatname = $query->result();
		return $productinfocatname[0]->category_name;
	}
	
		
	function getsliderinfo()
	{
		$query = $this->db->query("SELECT title,id FROM ".$this->banner_table." WHERE status IN('active')");
		$sliderinfo = $query->result();
		return $sliderinfo;
	}
	
	
	
	function getblogcatlistdata($parent = 0, $spacing = ' ', $user_tree_array = '') 
	{
		 if (!is_array($user_tree_array))
		  $user_tree_array = array();
		  $query = $this->db->query("select * from ".$this->blogcat_table." WHERE parent_id = '".$parent."' ORDER BY display_order ASC");
		  $result_cat =  $query->result();
		  foreach($result_cat as $row) {
			$user_tree_array[] = array("category_id" =>$row->category_id, "name" => $spacing . $row->category_name,"status"=>$row->status);
			$user_tree_array = $this->getblogcatlistdata($row->category_id, $spacing . '—&nbsp;', $user_tree_array);
		  }
		  return $user_tree_array;
	}
	
	
	function getproductcat($parent = 0, $spacing = ' ', $user_tree_array = '') 
	{
		 if (!is_array($user_tree_array))
		 $user_tree_array = array();
		 $query = $this->db->query("select * from ".$this->blogcat_table." WHERE status IN('active') AND parent_id = '".$parent."' ORDER BY display_order ASC");
		 $result_cat =  $query->result();
		 foreach($result_cat as $row) {
			$user_tree_array[] = array("category_id" =>$row->category_id, "category_name" => $spacing . $row->category_name,"parent_id"=>$row->parent_id);
			$user_tree_array = $this->getproductcat($row->category_id, $spacing . '—&nbsp;', $user_tree_array);
		  }
		  return $user_tree_array;
	}
	
	function getparentid($id)
	{
		$query = $this->db->query("select parent_id from ".$this->blogcat_table." WHERE category_id	= '".$id."'");
		return $query->result_array();
		
	}
	
	
	
	function single_productcategorydata($id)
	{
		$query = $this->db->get_where($this->blogcat_table,array('category_id'=>$id));
		return $query->row_array();
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
		if($_FILES['image']['name']!="")
		{
			//Set the config
			$config['upload_path'] = FCPATH.'application/uploads/blogcatimg/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['remove_spaces'] = true;
			$config['encrypt_name'] = true;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('image'))
			{
				$error =  $this->upload->display_errors();
				$this->session->set_userdata('error_image', $error);
				redirect('admin/blogcategory');
			}
			else
			{
				$image = $this->upload->data();
				$data= array(
					"category_name" => $this->input->post("category_name"),
					"slug" => $slug,
					"parent_id" => $this->input->post("parent_id"),
					"image" => $image['file_name'],
					"category_description" => $this->input->post("category_description"),
					"status" => $this->input->post("status"),
					"slider"=> $this->input->post("slider"),
					"card"=> $this->input->post("card"),
					"display_order"=> $this->input->post("display_order"),
					"is_display_on_sitemap"=>$this->input->post("is_display_on_sitemap"),
					"created_date"=> $createdate,
					"modified_date"=> $createdate
				);
				$this->db->insert($this->blogcat_table,$data);
				$id = $this->db->insert_id();
			}
		
		}
		else
		{
			$data= array(
					"category_name" => $this->input->post("category_name"),
					"slug" => $slug,
					"parent_id" => $this->input->post("parent_id"),
					"slug" => $slug,
					"category_description" => $this->input->post("category_description"),
					"status" => $this->input->post("status"),
					"slider"=> $this->input->post("slider"),
					"card"=> $this->input->post("card"),
					"display_order"=> $this->input->post("display_order"),
					"is_display_on_sitemap"=>$this->input->post("is_display_on_sitemap"),
					"modified_date"=> $createdate
				);
			$this->db->insert($this->blogcat_table,$data);
			$id = $this->db->insert_id();	
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
	   if($_FILES['image']['name']!="")
		{
			//Set the config
			$config['upload_path'] = FCPATH.'application/uploads/blogcatimg/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['remove_spaces'] = true;
			$config['encrypt_name'] = true;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('image'))
			{
				$error =  $this->upload->display_errors();
				$this->session->set_userdata('error_image', $error);
				redirect('admin/blogcategory');
			}
			else
			{
				$image = $this->upload->data();
				$data= array(
					"category_name" => $this->input->post("category_name"),
					"slug" => $slug,
					"parent_id" => $this->input->post("parent_id"),
					"image" => $image['file_name'],
					"category_description" => $this->input->post("category_description"),
					"status" => $this->input->post("status"),
					"slider"=> $this->input->post("slider"),
					"card"=> $this->input->post("card"),
					"display_order"=> $this->input->post("display_order"),
					"is_display_on_sitemap"=>$this->input->post("is_display_on_sitemap"),
					"modified_date"=> $createdate
				);
				$this->db->where('category_id', $id);
				$this->db->update($this->blogcat_table, $data);
			}
		
		}
		else
		{
			$data= array(
					"category_name" => $this->input->post("category_name"),
					"slug" => $slug,
					"parent_id" => $this->input->post("parent_id"),
					"category_description" => $this->input->post("category_description"),
					"status" => $this->input->post("status"),
					"slider"=> $this->input->post("slider"),
					"card"=> $this->input->post("card"),
					"display_order"=> $this->input->post("display_order"),
					"is_display_on_sitemap"=>$this->input->post("is_display_on_sitemap"),
					"created_date"=> $createdate,
					"modified_date"=> $createdate
				);
			$this->db->where('category_id', $id);
		$this->db->update($this->blogcat_table, $data);
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
		$this->db->delete($this->blogcat_table,array('category_id'=>$id));
	}
	function update_statusm($id)
	{
		$this->db->query('update '.$this->blogcat_table.' set status = case when status="active" then "inactive" else "active" end where category_id = "'.$id.'"');
	}
	function update_statusactive($id)
	{
		$this->db->query('update '.$this->blogcat_table.' set status = "active"  where category_id = "'.$id.'"');
	}
	function update_statusinactive($id)
	{
		$this->db->query('update '.$this->blogcat_table.' set status = "inactive"  where category_id = "'.$id.'"');
	}
	function displayorder()
	{
		$query = $this->db->get_where($this->blogcat_table);
		return $query->num_rows();
	}

}
?>