<?php

class Slidermodel extends CI_Model{

	var $table_name	= "";
	var $insert_id 	= "";

	function __construct()
	{
		$this->slider_table = "slider";
		$this->slider_content_table = "slider_content";
	
	}

	function get_sliderlist()
	{
		$query = $this->db->query("SELECT * FROM ".$this->slider_table);
		return $query->result_array();
	}
	
	

	function single_slider($id)
	{
		$query = $this->db->get_where($this->slider_table,array('slider_id'=>$id));
		return $query->row_array();
	}
	function single_slider_content($id)
	{
		$query = $this->db->get_where($this->slider_content_table,array('slider_id'=>$id));
		return $query->result_array();
	}
	
	function getslidercontent($id)
	{
		$query = $this->db->query("SELECT * FROM ".$this->slider_content_table." WHERE slider_id = '".$id."'");
		return $query->result_array();
	}
	
	function getslidername($id)
	{
		$query = $this->db->query("SELECT title FROM ".$this->slider_table." WHERE slider_id='".$id."'");
		$bannername = $query->result();
		return $bannername[0]->title;
	}

	function insert_record()
	{ 
	
		$createdate = date('Y-m-d H:i:s');
		$data =  array(
			"title" => $this->input->post("title"),
			"status" => $this->input->post("status"),
			"created_date" => $createdate,
			"modified_date" => $createdate
			);
		$this->db->insert($this->slider_table,$data);
		$slider_id = $this->db->insert_id();
		
		$maxlength = $this->input->post("maxlength");
		$output_dir = FCPATH.'application/uploads/sliderimages/';
		
		$config['upload_path']   = $output_dir.'original/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '0';
		$config['remove_spaces'] = true;
		$config['encrypt_name'] = true;
		$config['max_width']  = '';
		$config['max_height']  = '';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		for($i=0;$i<$maxlength;$i++)
		{
			$slider_title = $this->input->post('slider_title');
			$short_description = $this->input->post('short_description');
			$description =  $this->input->post('description');
			$social_fb = $this->input->post('social_fb');
			$social_tw = $this->input->post('social_tw');
			$social_g = $this->input->post('social_g');
			$social_rss = $this->input->post('social_rss');
			$url = $this->input->post('url');
			$images =  $_FILES['image']['name'];
			
				for ($i = 0; $i < count($_FILES['image']['name']); $i++) 
				{
					$validextensions = array("jpeg", "jpg", "png","gif");  
					$ext = explode('.', basename($_FILES['image']['name'][$i]));
					$file_extension = end($ext); 
					$filename = md5($_FILES['image']['name'][$i]).'.'.$file_extension;
					$target_path = $output_dir.$filename;
					
					if (!move_uploaded_file($_FILES['image']['tmp_name'][$i], $target_path))
					{
						$data =  array(
						"slider_title" => $slider_title[$i],
						"slider_id" => $slider_id,
						"short_description" => $short_description[$i],
						"description" => $description[$i],
						"social_fb" => $social_fb[$i],
						"social_tw" =>$social_tw[$i],
						"social_g" => $social_g[$i],
						"social_rss" => $social_rss[$i],
						"url" => $url[$i]
						);
						$this->db->insert($this->slider_content_table,$data);
						$slider_content_id = $this->db->insert_id();
					}
					else
					{
						$upload_data = $this->upload->data($config);
						$data =  array(
							"slider_title" => $slider_title[$i],
							"slider_id" => $slider_id,
							"short_description" => $short_description[$i],
							"description" => $description[$i],
							"social_fb" => $social_fb[$i],
							"social_tw" =>$social_tw[$i],
							"social_g" => $social_g[$i],
							"social_rss" => $social_rss[$i],
							"url" => $url[$i],
							"image" =>  $filename
						);
						$this->db->insert($this->slider_content_table,$data);
						$slider_content_id = $this->db->insert_id();
					}
				
				}
		
		}
		return $slider_id;
	}

	function update_record($id)
	{
		$createdate = date('Y-m-d H:i:s');
		$slider_id = $this->input->post('slider_id');
		$data =  array(
			"title" => $this->input->post("title"),
			"status" => $this->input->post("status"),
			"modified_date" => $createdate
			);
		$this->db->where('slider_id', $this->input->post('slider_id'));
		$this->db->update($this->slider_table, $data);
		
		$this->db->delete($this->slider_content_table,array('slider_id'=>$slider_id));
		
		$maxlength = $this->input->post("maxlength");
		$output_dir = FCPATH.'application/uploads/sliderimages/';
		
		$config['upload_path']   = $output_dir.'original/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '0';
		$config['remove_spaces'] = true;
		$config['encrypt_name'] = true;
		$config['max_width']  = '';
		$config['max_height']  = '';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		for($i=0;$i<$maxlength;$i++)
		{
			$slider_title = $this->input->post('slider_title');
			$short_description = $this->input->post('short_description');
			$description =  $this->input->post('description');
			$social_fb = $this->input->post('social_fb');
			$social_tw = $this->input->post('social_tw');
			$social_g = $this->input->post('social_g');
			$social_rss = $this->input->post('social_rss');
			$url = $this->input->post('url');
			$imagehidden = $this->input->post('imagehidden');
			$images =  $_FILES['image']['name'];
			
				for ($i = 0; $i < count($_FILES['image']['name']); $i++) 
				{
					$validextensions = array("jpeg", "jpg", "png","gif");  
					$ext = explode('.', basename($_FILES['image']['name'][$i]));
					$file_extension = end($ext); 
					$filename = md5($_FILES['image']['name'][$i]).'.'.$file_extension;
					$target_path = $output_dir.$filename;
					
					if (!move_uploaded_file($_FILES['image']['tmp_name'][$i], $target_path))
					{
						$data =  array(
						"slider_title" => $slider_title[$i],
						"slider_id" => $slider_id,
						"short_description" => $short_description[$i],
						"description" => $description[$i],
						"social_fb" => $social_fb[$i],
						"social_tw" =>$social_tw[$i],
						"social_g" => $social_g[$i],
						"social_rss" => $social_rss[$i],
						"url" => $url[$i],
						"image" => $imagehidden[$i]
						);
						$this->db->insert($this->slider_content_table,$data);
						$slider_content_id = $this->db->insert_id();
					}
					else
					{
						
						$upload_data = $this->upload->data($config);
						$data =  array(
							"slider_title" => $slider_title[$i],
							"slider_id" => $slider_id,
							"short_description" => $short_description[$i],
							"description" => $description[$i],
							"social_fb" => $social_fb[$i],
							"social_tw" =>$social_tw[$i],
							"social_g" => $social_g[$i],
							"social_rss" => $social_rss[$i],
							"url" => $url[$i],
							"image" => $filename
						);
						$this->db->insert($this->slider_content_table,$data);
						$slider_content_id = $this->db->insert_id();
					}
				
				}
		
		}
		
	}

	function delete_slider_record($id)
	{
		$query = $this->db->query("SELECT image FROM ".$this->slider_content_table." WHERE slider_content_id = '".$id."'");
		$delrec = $query->result_array();

                $query = $this->db->query("DELETE FROM ".$this->slider_content_table." WHERE slider_content_id= '".$id."'");

                //$this->db->delete($this->slider_content_table,array('slider_content_id'=>$id));
		/*$uploaddir = FCPATH.'application/uploads/sliderimages/'; 
		foreach($delrec as $data)
		{
			@unlink($uploaddir.$data['image']);
		}*/
		
		
	}
	function delete_record($id)
	{
		$query = $this->db->query("SELECT image FROM ".$this->slider_content_table." WHERE slider_id = '".$id."'");
		$delrec = $query->result_array();
		$uploaddir = FCPATH.'application/uploads/sliderimages/'; 
		foreach($delrec as $data)
		{
			@unlink($uploaddir.$data['image']);
		}
		$this->db->delete($this->slider_content_table,array('slider_id'=>$id));
		$this->db->delete($this->slider_table,array('slider_id'=>$id));
	}
	function update_statusm($id)
	{
		$this->db->query('update '.$this->slider_table.' set status = case when status="active" then "inactive" else "active" end where slider_id = "'.$id.'"');
	}
	function update_statusactive($id)
	{
		$this->db->query('update '.$this->slider_table.' set status = "active"  where slider_id = "'.$id.'"');
	}
	function update_statusinactive($id)
	{
		$this->db->query('update '.$this->slider_table.' set status = "inactive"  where slider_id = "'.$id.'"');
	}
	

	
}

?>