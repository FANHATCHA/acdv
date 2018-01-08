<?php
class Userdetailsmodel extends CI_Model{
	var $table_name	= "";
	function __construct()
	{
		$this->userdetails_table = "user_details";
	}
	function getuserdetailsdata()
	{
		$query = $this->db->query("select * from ".$this->userdetails_table);
		return $query->result_array();
	}
	
	function getuserdetailsname($id)
	{
		$query = $this->db->query("SELECT user_name FROM ".$this->userdetails_table." WHERE id='".$id."'");
		$cmspagesname = $query->result();
		return $cmspagesname[0]->user_name;
	}
	
	function single_userdetailsdata($id)
	{
		$query = $this->db->get_where($this->userdetails_table,array('id'=>$id));
		return $query->row_array();
	}
	
	function insert_record()
	{ 
		$createdate = date('Y-m-d H:i:s');
		$data= array(
			"user_name" => $this->input->post("user_name"),
			"position" => $this->input->post("position"),
			"description_destination" => $this->input->post("description_destination"),			"cms_page_description" => $this->input->post("cms_page_description"),
			"description_product" => $this->input->post("description_product"),
			"show_home" =>$this->input->post("show_home"),
			"show_home_position" =>$this->input->post("show_home_position"),
			"userblock_clickble" =>$this->input->post("userblock_clickble"),
			"clickble_link" =>$this->input->post("clickble_link"),
			"phoneno" => $this->input->post("phoneno"),
			"email" => $this->input->post("email"),
			"status"=> $this->input->post("status"),
			"created_date"=> $createdate,
			"modified_date"=> $createdate
		);
		
		$this->db->insert($this->userdetails_table,$data);
		$id = $this->db->insert_id();
		
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '0';
		$config['remove_spaces'] = true;
		$config['encrypt_name'] = true;
		$config['max_width']  = '';
		$config['max_height']  = '';
		
		
		if($_FILES['image']['name'] != "")
		{
			$uploaddir = FCPATH.'application/uploads/userimages/';
			
			$config['upload_path'] = $uploaddir.'original/';
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);	
			
			if (!$this->upload->do_upload('image'))
			{
				$error =  $this->upload->display_errors();
				$this->session->set_userdata('error_image', $error);
				redirect('admin/userdetails');
			}
			else
			{
				$image = $this->upload->data();
				$this->db->query("update ".$this->userdetails_table." set image='".$image['file_name']."' where id=".$id);
				$upload_name = $image['file_name'];
				$image_sizes = array(
				'thumb200' => array(200, 200),
				'thumb100' => array(100, 100),
				'thumb50' => array(50, 50)
				);
				foreach ($image_sizes as $key => $resize) {
				
					$config["source_image"] = $image['full_path'];
					$config['new_image'] = $uploaddir.$key.'/'.$upload_name;
					$config['width'] =  $resize[0];
					$config['height'] = $resize[1];
					$this->load->library('image_lib');
					$this->image_lib->initialize($config);
					if ( ! $this->image_lib->resize())
					{
						 $this->image_lib->display_errors();
					}
				}
				$this->image_lib->clear();
			}
		} 
			
		return $id;
	}
	
	
	function update_record($id)
	{
		$createdate = date('Y-m-d H:i:s');
	    $data= array(
			"user_name" => $this->input->post("user_name"),
			"position" => $this->input->post("position"),
			"description_destination" => $this->input->post("description_destination"),			"cms_page_description" => $this->input->post("cms_page_description"),
			"description_product" => $this->input->post("description_product"),
			"show_home" =>$this->input->post("show_home"),
			"show_home_position" =>$this->input->post("show_home_position"),
			"userblock_clickble" =>$this->input->post("userblock_clickble"),
			"clickble_link" =>$this->input->post("clickble_link"),
			"phoneno" => $this->input->post("phoneno"),
			"email" => $this->input->post("email"),
			"status"=> $this->input->post("status"),
			"modified_date"=> $createdate
		);
		$this->db->where('id', $this->input->post('user_id'));
		$this->db->update($this->userdetails_table,$data);
		
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '0';
		$config['remove_spaces'] = true;
		$config['encrypt_name'] = true;
		$config['max_width']  = '';
		$config['max_height']  = '';
		
		if($_FILES['image']['name'] != "")
		{
			$uploaddir = FCPATH.'application/uploads/userimages/';
			$config['upload_path'] = $uploaddir.'original/';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);	
			if (!$this->upload->do_upload('image'))
			{
				$error =  $this->upload->display_errors();
				$this->session->set_userdata('error_image', $error);
				redirect('admin/userdetails');
			}
			else
			{
				$image = $this->upload->data();
				$this->db->query("update ".$this->userdetails_table." set image='".$image['file_name']."' where id=".$id);
				$upload_name = $image['file_name'];
				$image_sizes = array(
				'thumb200' => array(200, 200),
				'thumb100' => array(100, 100),
				'thumb50' => array(50, 50)
				);
				foreach ($image_sizes as $key => $resize) {
					$config["source_image"] = $image['full_path'];
					$config['new_image'] = $uploaddir.$key.'/'.$upload_name;
					$config['width'] =  $resize[0];
					$config['height'] = $resize[1];
					$this->load->library('image_lib');
					$this->image_lib->initialize($config);
					if ( ! $this->image_lib->resize())
					{
						 $this->image_lib->display_errors();
					}
				}
				$this->image_lib->clear();
			}
		}
	 
	}
	
	function delete_record($id)
	{
		$this->db->delete($this->userdetails_table,array('id'=>$id));
	}
	
	function update_statusm($id)
	{
		$this->db->query('update '.$this->userdetails_table.' set status = case when status="active" then "inactive" else "active" end where id = "'.$id.'"');
	}
	function update_statusactive($id)
	{
		$this->db->query('update '.$this->userdetails_table.' set status = "active"  where id = "'.$id.'"');
	}
	function update_statusinactive($id)
	{
		$this->db->query('update '.$this->userdetails_table.' set status = "inactive"  where id = "'.$id.'"');
	}
}
?>