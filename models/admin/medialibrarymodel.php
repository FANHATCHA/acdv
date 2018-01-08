<?php
class Medialibrarymodel extends CI_Model{
	var $table_name	= "";
	var $insert_id 	= "";
	function __construct()
	{
		$this->media_table = "media_library";
	}

	function get_medialibrarylist()
	{
		$query = $this->db->query("SELECT * FROM ".$this->media_table);
		return $query->result_array();
	}
	
	function single_banner($id)
	{
		$query = $this->db->query("SELECT * FROM ".$this->media_table." WHERE id = '".$id."'");
		$single_rec = $query->result_array();
		return $single_rec[0];
	}
	
	function getmedianame($id)
	{
		$query = $this->db->query("SELECT title FROM ".$this->media_table ." WHERE id = '".$id."'");
		$mediatitle = $query->result();
		return $mediatitle[0]->title;
	}
	function update_record($id)
	{
		$createdate = date('Y-m-d H:i:s');
		$data =  array(
			"title" => $this->input->post("title"),
			"alternate_text" => $this->input->post("alternate_text"),
			"caption" => $this->input->post("caption"),
			"description" => $this->input->post("description"),
			"modified_date" => $createdate
		);
		$this->db->where('id', $this->input->post('media_id'));
		$this->db->update($this->media_table, $data);
	}

	function delete_record($id)
	{
		$query = $this->db->query("SELECT title FROM ".$this->media_table." WHERE id = '".$id."'");
		$delrec = $query->row_array();
		$uploaddir = FCPATH.'application/uploads/medialibrary/'; 
		foreach($delrec as $data)
		{
			@unlink($uploaddir.'original/'.$data['title']);
			@unlink($uploaddir.'thumb200/'.$data['title']);
			@unlink($uploaddir.'thumb100/'.$data['title']);
			@unlink($uploaddir.'thumb50/'.$data['title']);
		}
		$this->db->delete($this->media_table,array('id'=>$id));
	}
}
?>