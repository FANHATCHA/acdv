<?php

class Tagsmodel extends CI_Model{
	
	function __construct()
	{
		$this->tags_table = "tags";
		$this->rel_table  = "rel_attribute";
		$this->banner_table      = "banner";
		$this->pro_rel_tag_table = "product_rel_tags";
	}
	
	function getbannerid()
	{
		$query = $this->db->query("select * from ".$this->banner_table." WHERE status IN('active')");
		return $query->result_array();
	}
	
	
	function getrelattributes()

	{
	
		$query = $this->db->query("SELECT attribute_name  FROM ".$this->rel_table."");
		
		$attributes = $query->result_array();
		
		return $attributes;

	}
	
	function gettagsdata()
	{
		$query = $this->db->query("select * from ".$this->tags_table);
		return $query->result_array();
	}
	
	function single_tagdata($id)
	{
		$query = $this->db->get_where($this->tags_table,array('id'=>$id));
		return $query->row_array();
	}
	
	function gettagsname($id)
	{
		$query = $this->db->query("SELECT tag_name FROM ".$this->tags_table." WHERE id='".$id."'");
		$tagname = $query->result();
		return $tagname[0]->tag_name;
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
	
	function insert_record()
	{
		$currentdate = date('Y-m-d H:i:s');
		$slug = $this->input->post("slug");
	     if(isset($slug) && !empty($slug))
	    {
		  $slug = $this->toAscii($this->input->post("slug")); //strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post("slug")));
	    }
	    else
	    {	
		  $slug = $this->toAscii($this->input->post("tag_name"));//strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post("category_name")));
	    }
		$data = array(
					"tag_name" => $this->input->post("tag_name"),
					"h1_title" => $this->input->post("h1_title"),
					"slug" => $slug,
					"tag_description" => $this->input->post("tag_description"),
					"slider_id" => $this->input->post("slider_id"),
					"tag_type" => $this->input->post("tag_type"),
					"tag_page" => $this->input->post("tag_page"),
					"status" => $this->input->post("status"),
					"created_date"=>$currentdate,
					"modified_date"=>$currentdate,
					"rewrite_url" => $this->input->post("rewrite_url"),
					"is_seo" => $this->input->post("is_seo"),
					"meta_title" => $this->input->post("meta_title"),
					"meta_keyword"=> $this->input->post("meta_keyword"),
					"robots" => $this->input->post("robots"),
					"rel"=> $this->input->post("rel"),
					"canonical_url"=> $this->input->post("canonical_url"),
					"meta_description"=> $this->input->post("meta_description")
				);
		$this->db->insert($this->tags_table,$data);
		$id = $this->db->insert_id();
		return $id;
	}
	function update_record()
	{
		$currentdate = date('Y-d-m H:i:s');
		$slug = $this->input->post("slug");
	    if(isset($slug) && !empty($slug))
	    {
		  $slug = $this->toAscii($this->input->post("slug")); //strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post("slug")));
	    }
	    else
	    {	
		  $slug = $this->toAscii($this->input->post("tag_name"));//strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post("category_name")));
	    }
		$data = array(
					"tag_name" => $this->input->post("tag_name"),
					"h1_title" => $this->input->post("h1_title"),
					"slug" => $slug,
					"tag_description" => $this->input->post("tag_description"),
					"tag_type" => $this->input->post("tag_type"),
					"tag_page" => $this->input->post("tag_page"),
					"slider_id" => $this->input->post("slider_id"),
					"status" => $this->input->post("status"),
					"modified_date"=>$currentdate,
					"rewrite_url" => $this->input->post("rewrite_url"),
					"is_seo" => $this->input->post("is_seo"),
					"meta_title" => $this->input->post("meta_title"),
					"meta_keyword"=> $this->input->post("meta_keyword"),
					"robots" => $this->input->post("robots"),
					"rel"=> $this->input->post("rel"),
					"canonical_url"=> $this->input->post("canonical_url"),
					"meta_description"=> $this->input->post("meta_description")
				);
		$this->db->where('id', $this->input->post('TagId'));
		$this->db->update($this->tags_table, $data);
	   
	}
	
	function delete_record($id)
	{
		$this->db->delete($this->tags_table,array('id'=>$id));
		$this->db->delete($this->pro_rel_tag_table,array('tag_id'=>$id));
	}
	
	function update_statusm($id)
	{
		$this->db->query('update '.$this->tags_table.' set status = case when status="active" then "inactive" else "active" end where id = "'.$id.'"');
	}
	function update_statusactive($id)
	{
		$this->db->query('update '.$this->tags_table.' set status = "active"  where id = "'.$id.'"');
	}
	function update_statusinactive($id)
	{
		$this->db->query('update '.$this->tags_table.' set status = "inactive"  where id = "'.$id.'"');
	}

}
?>