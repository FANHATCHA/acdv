<?php
class Clientreviewmodel extends CI_Model{

	var $table_name	= "";
	
	function __construct()
	{
		$this->clientreview_table  = "clientreview";
			$this->productcat_table  = "products_categories";
	}	
	
	function getcustomerreviewdata()
	{
		$query = $this->db->query("select * from ".$this->clientreview_table." ORDER BY review_date DESC");
		return $query->result_array();
	}
	
	function getcategoryname($categoryid)
	{
		$query = $this->db->query("select category_name from ".$this->productcat_table." WHERE category_id	= '".$categoryid."'");
		$categoryname = $query->result_array();
		return $categoryname[0]['category_name'];
	}
	
	function getproductcat($parent = 0, $spacing = '', $user_tree_array = '') 
	{
		if (!is_array($user_tree_array))
		  $user_tree_array = array();
		  $query = $this->db->query("select * from ".$this->productcat_table." WHERE status IN('active') AND parent_id = '".$parent."' ORDER BY display_order ASC");
		  $result_cat =  $query->result();
		  $i = 1;
		  foreach($result_cat as $row) {
			$user_tree_array[] = array("category_id" =>$row->category_id, "category_name" =>$row->category_name,"status"=>$row->status,"spacing"=>$spacing);
			$user_tree_array = $this->getproductcat($row->category_id, $spacing.'— ', $user_tree_array);
			
		 }
		  return $user_tree_array;
	}
	function getparentid($id)
	{
		$query = $this->db->query("select parent_id from ".$this->productcat_table." WHERE category_id	= '".$id."'");
		return $query->result_array();
		
	}
	
	function getclientreviewname($id)
	{
		$query = $this->db->query("SELECT name FROM ".$this->clientreview_table." WHERE id='".$id."'");
		$cmspagesname = $query->result();
		return $cmspagesname[0]->name;
	}
	
	function single_clientreview($id)
	{
		$query = $this->db->get_where($this->clientreview_table,array('id'=>$id));
		return $query->row_array();
	}
	
	function insert_record()
	{ 
		
		$createdate = date('Y-m-d h:i:s');
		$destination_ids = implode(',',$this->input->post("destination_id"));
		$data= array(
			"name" => $this->input->post("name"),
			"thems_name" => $this->input->post("thems_name"),
			"review_date" => $this->input->post("review_date"),
			"destination_id" => $destination_ids,
			"client_review" => $this->input->post("client_review"),
			"client_rating" => $this->input->post("client_rating"),
			"clientreview_clickble" => $this->input->post("clientreview_clickble"),
			"status" => $this->input->post("status"),
			"created_date"=> $createdate,
			"modified_date"=> $createdate
			);
		$this->db->insert($this->clientreview_table,$data);
		$id = $this->db->insert_id();
		
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '0';
		$config['remove_spaces'] = true;
		$config['encrypt_name'] = true;
		$config['max_width']  = '';
		$config['max_height']  = '';
			
		if($_FILES['client_review_image']['name'] != "")
		{
			
			$uploaddir = FCPATH.'application/uploads/clientreview/';
			$config['upload_path'] = $uploaddir.'original/';
			
			$this->load->library('upload');
			$this->upload->initialize($config);	
			
			if (!$this->upload->do_upload('client_review_image'))
			{
				$error =  $this->upload->display_errors();
				$this->session->set_userdata('error_image', $error);
				redirect('admin/clientreview');
			}
			else
			{
				$client_review_image = $this->upload->data();
				$this->db->query("update ".$this->clientreview_table." set client_review_image='".$client_review_image['file_name']."' where id=".$id);
				
				$upload_name = $client_review_image['file_name'];
				
				$image_sizes = array(
				'thumb200' => array(200, 200),
				'thumb100' => array(100, 100),
				'thumb50' => array(50, 50)
				);
				
				foreach ($image_sizes as $key => $resize) {
				
					$config["source_image"] = $client_review_image['full_path'];
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
	
	
	function update_record()
	{
		$destination_ids = implode(',',$this->input->post("destination_id"));
		$createdate = date('Y-m-d h:i:s');
		$data= array(
			"name" => $this->input->post("name"),
			"thems_name" => $this->input->post("thems_name"),
			"review_date" => $this->input->post("review_date"),
			"destination_id" => $destination_ids,
			"client_review" => $this->input->post("client_review"),
			"client_rating" => $this->input->post("client_rating"),
			"clientreview_clickble" => $this->input->post("clientreview_clickble"),
			"status" => $this->input->post("status"),
			"modified_date"=> $createdate
			);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update($this->clientreview_table, $data);
		
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '0';
		$config['remove_spaces'] = true;
		$config['encrypt_name'] = true;
		$config['max_width']  = '';
		$config['max_height']  = '';
			
		if($_FILES['client_review_image']['name'] != "")
		{
			
			$uploaddir = FCPATH.'application/uploads/clientreview/';
			$config['upload_path'] = $uploaddir.'original/';
			
			$this->load->library('upload');
			$this->upload->initialize($config);	
			
			if (!$this->upload->do_upload('client_review_image'))
			{
				$error =  $this->upload->display_errors();
				$this->session->set_userdata('error_image', $error);
				redirect('admin/clientreview');
			}
			else
			{
				$client_review_image = $this->upload->data();
				$this->db->query("update ".$this->clientreview_table." set client_review_image='".$client_review_image['file_name']."' where id=".$this->input->post('id'));
				
				$upload_name = $client_review_image['file_name'];
				
				$image_sizes = array(
				'thumb200' => array(200, 200),
				'thumb100' => array(100, 100),
				'thumb50' => array(50, 50)
				);
				
				foreach ($image_sizes as $key => $resize) {
				
					$config["source_image"] = $client_review_image['full_path'];
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
		$this->db->delete($this->clientreview_table,array('id'=>$id));
	}
	
	function update_statusm($id)
	{
		$this->db->query('update '.$this->clientreview_table.' set status = case when status="active" then "inactive" else "active" end where id = "'.$id.'"');
	}
	
	function updatereviewinhomepage($id)
	{
		$query = $this->db->query("select id from ".$this->clientreview_table." WHERE show_home = 'yes'");
		$homeactiveid =  $query->result_array();
		$this->db->query('update '.$this->clientreview_table.' set show_home = "no"  where id = "'.$homeactiveid[0]['id'].'"');
		$this->db->query('update '.$this->clientreview_table.' set show_home = "yes" where id = "'.$id.'"');
	}
	
	function update_statusactive($id)
	{
		$this->db->query('update '.$this->clientreview_table.' set status = "active"  where id = "'.$id.'"');
	}
	function update_statusinactive($id)
	{
		$this->db->query('update '.$this->clientreview_table.' set status = "inactive"  where id = "'.$id.'"');
	}
	

}
?>