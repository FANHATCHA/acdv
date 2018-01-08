<?php

class Socialmediamodel extends CI_Model{

	var $table_name	= "";
	var $insert_id 	= "";

	function __construct()
	{
		$this->socialmedia_table = "socialmedia";
	}

	function get_socialmedialist()
	{
		$query = $this->db->query("SELECT * FROM ".$this->socialmedia_table);
		return $query->result_array();
	}

	function single_socialmedia($id)
	{
		$query = $this->db->get_where($this->socialmedia_table,array('id'=>$id));
		return $query->row_array();
	}
	
	function getsocialmedianame($id)
	{
		$query = $this->db->query("SELECT name FROM ".$this->socialmedia_table." WHERE id='".$id."'");
		$socialname = $query->result();
		return $socialname[0]->name;
	}

	function insert_record()
	{ 
		$createdate = date('Y-m-d H:i:s');
		if($_FILES['socicon_img']['name']!="")
		{
			//Set the config
			$config['upload_path'] = FCPATH.'application/uploads/socialicon/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['remove_spaces'] = true;
			$config['encrypt_name'] = true;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('socicon_img'))
			{
				$error =  $this->upload->display_errors();
				$this->session->set_userdata('error_image', $error);
				redirect('admin/socialmedia/add');
			}
			else
			{
				$image = $this->upload->data();
				$data =  array(
						"name" => $this->input->post("name"),
						"url" => $this->input->post("url"),
						"image" => $image['file_name'],
						"display_order" => $this->input->post("iDisplayOrder"),
						"status" => $this->input->post("eStatus"),
						"created_date" => $createdate,
						"modified_date" => $createdate
				);
				$this->db->insert($this->socialmedia_table,$data);
				$id = $this->db->insert_id();
			}
		
		}
		else
		{
			$data =  array(
				"name" => $this->input->post("name"),
				"url" => $this->input->post("url"),
				"display_order" => $this->input->post("iDisplayOrder"),
				"status" => $this->input->post("eStatus"),
				"created_date" => $createdate,
				"modified_date" => $createdate
				);
			$this->db->insert($this->socialmedia_table,$data);
			$id = $this->db->insert_id();	
		}
		return $id;
	}

	function update_record($id)
	{
		$createdate = date('Y-m-d H:i:s');
		
		if($_FILES['socicon_img']['name']!="")
		{
			//Set the config
			$config['upload_path'] = FCPATH.'application/uploads/socialicon/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['remove_spaces'] = true;
			$config['encrypt_name'] = true;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('socicon_img'))
			{
				$error =  $this->upload->display_errors();
				$this->session->set_userdata('error_image', $error);
				redirect('admin/socialmedia/edit');
			}
			else
			{
				$image = $this->upload->data();
				$data =  array(
					"name" => $this->input->post("name"),
					"image" => $image['file_name'],
					"url" => $this->input->post("url"),
					"display_order" => $this->input->post("iDisplayOrder"),
					"status" => $this->input->post("eStatus"),
					"modified_date" => $createdate
				);
				$this->db->where('id', $this->input->post('social_id'));
				$this->db->update($this->socialmedia_table, $data);
			}
		
		}
		else
		{
			$data =  array(
				"name" => $this->input->post("name"),
				"url" => $this->input->post("url"),
				"display_order" => $this->input->post("iDisplayOrder"),
				"status" => $this->input->post("eStatus"),
				"created_date" => $createdate,
				"modified_date" => $createdate
				);
			$this->db->where('id', $this->input->post('social_id'));
			$this->db->update($this->socialmedia_table, $data);
		}
		return $id;
	}

	function delete_record($id)
	{
		$this->db->delete($this->socialmedia_table,array('id'=>$id));
	}
	
	function update_statusm($id)
	{
		$this->db->query('update '.$this->socialmedia_table.' set status = case when status="active" then "inactive" else "active" end where id = "'.$id.'"');
	}
	function update_statusactive($id)
	{
		
		$this->db->query('update '.$this->socialmedia_table.' set status = "active"  where id = "'.$id.'"');
	}
	function update_statusinactive($id)
	{
		$this->db->query('update '.$this->socialmedia_table.' set status = "inactive"  where id = "'.$id.'"');
	}
	
	function displayorder()
	{
		$query = $this->db->query("SELECT id FROM ".$this->socialmedia_table);
		return $query->num_rows();
	}

}

?>