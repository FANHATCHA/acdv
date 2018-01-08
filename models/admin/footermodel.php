<?php
class Footermodel extends CI_Model{
	var $table_name	= "";
	function __construct()
	{
		$this->footer_table = "footer";
	}
	function getsprofiledata($id)
	{
		$query = $this->db->get_where($this->footer_table,array('id'=>$id));
		return $query->row_array();
	}
	function update_record()
	{
		$currentdate = date('Y-m-d H:i:s');
		
		$data = array(
			"footer_content" => $this->input->post("footer_content")
		);
		$this->db->where('id', '1');
		$this->db->update($this->footer_table, $data);
	
		
	}

}
?>