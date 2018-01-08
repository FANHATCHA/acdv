<?php
class Myprofilemodel extends CI_Model{
	var $table_name	= "";
	function __construct()
	{
		$this->user_table = "users";
	}
	function getsprofiledata($id)
	{
		$query = $this->db->get_where($this->user_table,array('id'=>$id));
		return $query->row_array();
	}
	function update_record()
	{
		$currentdate = date('Y-m-d H:i:s');
		$password = $this->input->post("password");
		if(isset($password) && !empty($password))
		{
			$data = array(
				"username" => $this->input->post("username"),
				"firstname" => $this->input->post("firstname"),
				"lastname" => $this->input->post("lastname"),
				"password" => md5($this->input->post("password")),
				"email" => $this->input->post("email"),
				"created_date"=>$currentdate,
				"modified_date"=>$currentdate
				);
		}
		else
		{
			$data = array(
				"username" => $this->input->post("username"),
				"firstname" => $this->input->post("firstname"),
				"lastname" => $this->input->post("lastname"),
				"email" => $this->input->post("email"),
				"created_date"=>$currentdate,
				"modified_date"=>$currentdate
				);
		}
		$this->db->where('id', '1');
		$this->db->update($this->user_table, $data);
	}

}
?>