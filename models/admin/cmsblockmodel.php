<?php

class Cmsblockmodel extends CI_Model{

	var $table_name	= "";
	
	function __construct()
	{
		$this->cmsblock_table = "cms_block";
	}
	
	function getcmsbockdata()
	{
		$query = $this->db->query("select * from ".$this->cmsblock_table);
		return $query->result_array();
	}
	
	function getcmsblocksname($id)
	{
		$query = $this->db->query("SELECT title FROM ".$this->cmsblock_table." WHERE id='".$id."'");
		$cmspagesname = $query->result();
		return $cmspagesname[0]->title;
	}
	
	function single_cmsblockdata($id)
	{
		$query = $this->db->get_where($this->cmsblock_table,array('id'=>$id));
		return $query->row_array();
	}
	
	function insert_record()
	{ 
		$createdate = date('Y-m-d h:i:s');
		$data= array(
			"title" => $this->input->post("title"),
			"description" => $this->input->post("description"),
			"status" => $this->input->post("status"),
			"created_date"=> $createdate,
			"modified_date"=> $createdate
			);
		$this->db->insert($this->cmsblock_table,$data);
		$id = $this->db->insert_id();
		return $id;
	}
	
	
	function update_record()
	{
		$createdate = date('Y-m-d h:i:s');
		$data= array(
			"title" => $this->input->post("title"),
			"description" => $this->input->post("description"),
			"status" => $this->input->post("status"),
			"modified_date"=> $createdate
			);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update($this->cmsblock_table, $data);
				
	 
	}
	
	function delete_record($id)
	{
		$this->db->delete($this->cmsblock_table,array('id'=>$id));
	}
	
	function update_statusm($id)
	{
		$this->db->query('update '.$this->cmsblock_table.' set status = case when status="active" then "inactive" else "active" end where id = "'.$id.'"');
	}
	function update_statusactive($id)
	{
		$this->db->query('update '.$this->cmsblock_table.' set status = "active"  where id = "'.$id.'"');
	}
	function update_statusinactive($id)
	{
		$this->db->query('update '.$this->cmsblock_table.' set status = "inactive"  where id = "'.$id.'"');
	}
	

}
?>