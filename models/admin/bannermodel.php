<?php

class Bannermodel extends CI_Model{

	var $table_name	= "";
	var $insert_id 	= "";

	function __construct()
	{
		$this->banner_table = "banner";
		$this->banner_image_table = "banner_images";
	}

	function get_bannerlist()
	{
		$query = $this->db->query("SELECT * FROM ".$this->banner_table);
		return $query->result_array();
	}

	function single_banner($id)
	{
		$query = $this->db->get_where($this->banner_table,array('id'=>$id));
		return $query->row_array();
	}
	
	function getimages($id)
	{
		$query = $this->db->query("SELECT banner_image FROM ".$this->banner_image_table." WHERE banner_id = '".$id."'");
		return $query->result_array();
	}
	
	function getbannername($id)
	{
		$query = $this->db->query("SELECT title FROM ".$this->banner_table." WHERE id='".$id."'");
		$bannername = $query->result();
		return $bannername[0]->title;
	}

	function insert_record()
	{ 
		$createdate = date('Y-m-d H:i:s');
		$data =  array(
			"title" => $this->input->post("title"),
			"display_order" => $this->input->post("display_order"),
			"status" => $this->input->post("status"),
			"created_date" => $createdate,
			"modified_date" => $createdate
			);
		$this->db->insert($this->banner_table,$data);
		$banner_id = $this->db->insert_id();
		
		$bannerimages = $this->input->post("banner_images");
		if(isset($bannerimages) && !empty($bannerimages))
		{
			foreach($bannerimages as $banner_image)
			{
				$data =  array(
					"banner_id" => $banner_id,
					"banner_image" => $banner_image
					);
				$this->db->insert($this->banner_image_table, $data);
			}
		}
		return $banner_id;
	}

	function update_record($id)
	{
		$createdate = date('Y-m-d H:i:s');
			
			
			
			$bannerimages = $this->input->post("banner_images");
			//print_r($bannerimages);exit;
			if(isset($bannerimages) && !empty($bannerimages))
			{
				
				foreach($bannerimages as $banner_image)
				{
					$data =  array(
						"banner_id" => $this->input->post('banner_id'),
						"banner_image" => $banner_image
						);
					$this->db->insert($this->banner_image_table, $data);
				}
			}
			
			$data =  array(
				"title" => $this->input->post("title"),
				"display_order" => $this->input->post("display_order"),
				"status" => $this->input->post("status"),
				"modified_date" => $createdate
				);
				
			$this->db->where('id', $this->input->post('banner_id'));
			$this->db->update($this->banner_table, $data);
			
			
		
		
	}

	function delete_record($id)
	{
		$query = $this->db->query("SELECT banner_image FROM ".$this->banner_image_table." WHERE banner_id = '".$id."'");
		$delrec = $query->row_array();
		
		$uploaddir = FCPATH.'application/uploads/bannerimages/'; 
		foreach($delrec as $data)
		{
		
			@unlink($uploaddir.'original/'.$data['banner_image']);
			@unlink($uploaddir.'thumb200/'.$data['banner_image']);
			@unlink($uploaddir.'thumb100/'.$data['banner_image']);
			@unlink($uploaddir.'thumb50/'.$data['banner_image']);
		}
		$this->db->delete($this->banner_image_table,array('banner_id'=>$id));
		$this->db->delete($this->banner_table,array('id'=>$id));
	}
	
	function delete_images($image)
	{
		$uploaddir = FCPATH.'application/uploads/bannerimages/'; 
		@unlink($uploaddir.'original/'.$image);
		@unlink($uploaddir.'thumb200/'.$image);
		@unlink($uploaddir.'thumb100/'.$image);
		@unlink($uploaddir.'thumb50/'.$image);
		$this->db->delete($this->banner_image_table,array('banner_image'=>$image));
	}

	function update_statusm($id)
	{
		$this->db->query('update '.$this->banner_table.' set status = case when status="active" then "inactive" else "active" end where id = "'.$id.'"');
	}
	
	function update_statusactive($id)
	{
	//print_r($id);exit;
		$this->db->query('update '.$this->banner_table.' set status = "active"  where id = "'.$id.'"');
	}
	
	function update_statusinactive($id)
	{
		$this->db->query('update '.$this->banner_table.' set status = "inactive"  where id = "'.$id.'"');
	}
	
	function displayorder()
	{
		$query = $this->db->query("SELECT id FROM ".$this->banner_table);
		return $query->num_rows();
	}
	
}

?>