<?php

class Menumodel extends CI_Model{

	var $table_name	= "";
	
	function __construct()
	{
		$this->menu_table = "menu";
	}
	
	function getmenudata()
	{
		$query = $this->db->query("select * from ".$this->menu_table);
		return $query->result_array();
	}
	
	function getmenuname($id)
	{
		$query = $this->db->query("SELECT menu_title FROM ".$this->menu_table." WHERE id='".$id."'");
		$menuname = $query->result();
		return $menuname[0]->menu_title;
	}
	
	function single_menudata($id)
	{
		$query = $this->db->get_where($this->menu_table,array('id'=>$id));
		return $query->row_array();
	}
	
	function insert_record()
	{ 
		$createdate = date('Y-m-d H:i:s');
		$data= array(
			"menu_title" => $this->input->post("menu_title"),
			"status" => $this->input->post("status"),
			"created_date"=> $createdate,
			"modified_date"=> $createdate
			);
		$this->db->insert($this->menu_table,$data);
		$id = $this->db->insert_id();
		return $id;
	}
	
	
	function update_record()
	{
		$createdate = date('Y-d-m H:i:s');
		$data= array(
			"menu_title" => $this->input->post("menu_title"),
			"status" => $this->input->post("status"),
			"created_date"=> $createdate,
			"modified_date"=> $createdate
			);
	    $this->db->where('id', $this->input->post('menu_id'));
		$this->db->update($this->menu_table, $data);
	}
	
	function delete_record($id)
	{
		$this->db->delete($this->menu_table,array('id'=>$id));
	}
	
	function update_statusm($id)
	{
		$this->db->query('update '.$this->menu_table.' set status = case when status="active" then "inactive" else "active" end where id = "'.$id.'"');
	}
	function update_statusactive($id)
	{
		$this->db->query('update '.$this->menu_table.' set status = "active"  where id = "'.$id.'"');
	}
	function update_statusinactive($id)
	{
		$this->db->query('update '.$this->menu_table.' set status = "inactive"  where id = "'.$id.'"');
	}
}
?>