<?php

class Settingmodel extends CI_Model{
	var $table_name	= "";
	function __construct()
	{
		$this->setting_table = "general_settings";
	}
	function getsettingdata($id)
	{
		$query = $this->db->get_where($this->setting_table,array('id'=>$id));
		return $query->row_array();
	}
	function update_record()
	{
		$currentdate = date('Y-m-d H:i:s');
		$data = array(
				"company_name" => $this->input->post("companyName"),
				"email_id" => $this->input->post("emailId"),
				"address" => $this->input->post("address"),
				"fax_no" => $this->input->post("faxNo"),
				"phone_no" =>$this->input->post("phoneNo"),
				"language_code" => $this->input->post("language_code"),
				"created_date"=>$currentdate,
				"modified_date"=>$currentdate
				);
	  
	   $this->db->where('id', '1');
	   $this->db->update($this->setting_table, $data);
	   
	   
	   /*$this->load->library('upload');	
	   if(is_uploaded_file($_FILES['logoImage']['tmp_name'])) 
	   {         
			$photo['upload_path'] = '../uploads/upload_logo/';
			$photo['allowed_types'] = 'png|jpg|jpeg|gif';
			$photo['max_size']	= '0';
			$photo['logoImage'] = md5(uniqid(mt_rand()));
			$this->upload->initialize($photo);
			if ($this->upload->do_upload('logoImage'))
			{
				$this->upload_file_name='';
				$data =  $this->upload->data();									
				$this->upload_file_name=$data['logoImage'];	
				$query = $this->db->query("select logoImage from ".$this->setting_table." where settingId='1'");
				if ($query->num_rows() > 0)
				{
					$row = $query->row_array();
					if(file_exists('../uploads/upload_logo/'.$row['logoImage']) && $row['logoImage']!='')
					unlink('../uploads/upload_logo/'.$row['logoImage']);
				}
				$this->db->query("update ".$this->setting_table." set logoImage='".$this->upload_file_name."' where settingId='1'");
			}
		}*/	
	}

}
?>