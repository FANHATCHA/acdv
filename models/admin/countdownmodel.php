<?php

class Countdownmodel extends CI_Model{
	
	function __construct()
	{	
		$this->countdown_table 	 = "countdown";
		$this->destination_table = "products_categories";
		$this->product_table 	 = "products";
	}
	
	function getcountdowndata()
	{
		$query = $this->db->query("select * from ".$this->countdown_table);
		return $query->result_array();
	}
	
	
	function getcountdownname($id)
	{
		$query = $this->db->query("SELECT title FROM ".$this->countdown_table." WHERE id='".$id."'");
		$countdownname = $query->result();
		return $countdownname[0]->title;
	}
	
	function single_countdownloaddata($id)
	{
		$query = $this->db->get_where($this->countdown_table,array('id'=>$id));
		return $query->row_array();
	}
	
	function getallProdcuct()
	{
		$query = $this->db->query("select * from ".$this->product_table." WHERE status IN('active')");
		return $query->result_array();
	}
	 
	function fetchCategoryTree($parent = 0, $spacing = ' ', $user_tree_array = '') 
	{
	  if (!is_array($user_tree_array))
	  $user_tree_array = array();
	  
	  $query = $this->db->query("select * from ".$this->destination_table." WHERE status IN('active') AND parent_id = '".$parent."' ORDER BY display_order ASC");
	  $result_cat =  $query->result();
	  foreach($result_cat as $row) {
	    $user_tree_array[] = array("id" =>$row->category_id, "name" => $spacing . $row->category_name);
		$user_tree_array = $this->fetchCategoryTree($row->category_id, $spacing . '—&nbsp;', $user_tree_array);
	  }
	  return $user_tree_array;
	}


	function insert_record()
	{
		$currentdate = date('Y-m-d H:i:s');
		$type = $this->input->post("type");
		$ids  = '';
		if(isset($type) && !empty($type) && $type == 'destination')
		{
			$procat = $this->input->post("procat");
			if(isset($procat) && !empty($procat))
			{
				$ids = implode(',',$procat);
			}
			
		}
		if(isset($type) && !empty($type) && $type == 'product')
		{
			$product = $this->input->post("product");
			if(isset($product) && !empty($product))
			{
				$ids = implode(',',$product);
			}
		}
		$start_date = $this->input->post("start_date");
		$end_date   = $this->input->post("end_date");
		$start_date = explode('-',$start_date);
		$start_date = $start_date[0].$start_date[1];
		$end_date = explode('-',$end_date);
		$end_date = $end_date[0].$end_date[1];
		
		if(isset($start_date) && !empty($start_date))
		{
			$start_date = date('Y-m-d H:i', strtotime($start_date));
		}else{ $start_date='';}
		if(isset($end_date) && !empty($end_date))
		{
			$end_date = date('Y-m-d H:i', strtotime($end_date));
		}else{ $end_date='';}
		
		$data = array(
					"title" => $this->input->post("title"),
					"rating" => $this->input->post("rating"),
					"promoting_offers" => $this->input->post("promoting_offers"),
					"description" => $this->input->post("description"),
					"product_id" => $this->input->post("product_id"),
					"start_date" => $start_date,
					"end_date" => $end_date,
					"status" => $this->input->post("status"),
					"created_date" => $currentdate,
					"modified_date" => $currentdate
				);
		$this->db->insert($this->countdown_table,$data);
		$id = $this->db->insert_id();
		
		
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '0';
		$config['remove_spaces'] = true;
		$config['encrypt_name'] = true;
		$config['max_width']  = '';
		$config['max_height']  = '';
		
		if($_FILES['promoting_image']['name'] != "")
		{
			$uploaddir = FCPATH.'application/uploads/promoting_image/';
			$config['upload_path'] = $uploaddir;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);	
			if (!$this->upload->do_upload('promoting_image'))
			{
				$error =  $this->upload->display_errors();
				$this->session->set_userdata('error_image', $error);
				redirect('admin/countdown');
			}
			else
			{
				$promoting_image = $this->upload->data();
				$this->db->query("update ".$this->countdown_table." set promoting_image='".$promoting_image['file_name']."' where id=".$id);
			}
		} 
		return $id;
	}
	function update_record()
	{
		$currentdate = date('Y-m-d H:i:s');
		$type = $this->input->post("type");
		$ids  = '';
		if(isset($type) && !empty($type) && $type == 'destination')
		{
			$procat = $this->input->post("procat");
			if(isset($procat) && !empty($procat))
			{
				$ids = implode(',',$procat);
			}
			
		}
		if(isset($type) && !empty($type) && $type == 'product')
		{
			$product = $this->input->post("product");
			if(isset($product) && !empty($product))
			{
				$ids = implode(',',$product);
			}
		}
		$start_date = $this->input->post("start_date");
		$end_date   = $this->input->post("end_date");
		$start_date = explode('-',$start_date);
		$start_date = $start_date[0].$start_date[1];
		$end_date = explode('-',$end_date);
		$end_date = $end_date[0].$end_date[1];
		
		if(isset($start_date) && !empty($start_date))
		{
			$start_date = date('Y-m-d H:i', strtotime($start_date));
		}else{ $start_date='';}
		if(isset($end_date) && !empty($end_date))
		{
			$end_date = date('Y-m-d H:i', strtotime($end_date));
		}else{ $end_date='';}
		
		$data = array(
					"title" => $this->input->post("title"),
					"rating" => $this->input->post("rating"),
					"promoting_offers" => $this->input->post("promoting_offers"),
					"description" => $this->input->post("description"),
					"product_id" => $this->input->post("product_id"),
					"start_date" => $start_date,
					"end_date" => $end_date,
					"status" => $this->input->post("status"),
					"modified_date" => $currentdate
				);
				
		$this->db->where('id', $this->input->post('coutdown_id'));
		$this->db->update($this->countdown_table, $data);
		
		
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '0';
		$config['remove_spaces'] = true;
		$config['encrypt_name'] = true;
		$config['max_width']  = '';
		$config['max_height']  = '';
		
		if($_FILES['promoting_image']['name'] != "")
		{
			//print_R($_FILES['promoting_image']['name']);exit;
			$uploaddir = FCPATH.'application/uploads/promoting_image/';
			$config['upload_path'] = $uploaddir;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);	
			if (!$this->upload->do_upload('promoting_image'))
			{
				$error =  $this->upload->display_errors();
				$this->session->set_userdata('error_image', $error);
				redirect('admin/countdown');
			}
			else
			{
				$promoting_image = $this->upload->data();
				$this->db->query("update ".$this->countdown_table." set promoting_image='".$promoting_image['file_name']."' where id=".$this->input->post('coutdown_id'));
			}
		} 
	   
	}
	
	function delete_record($id)
	{
		$this->db->delete($this->countdown_table,array('id'=>$id));
	}
	
	function getproidtoproname($proid)
	{
		$query = $this->db->query("select product_name from ".$this->product_table." WHERE id = '".$proid."'");
		$productname =  $query->result_array();
		return $productname[0]['product_name'];
		
	}
	
	function update_statusm($id)
	{
		$this->db->query('update '.$this->countdown_table.' set status = case when status="active" then "inactive" else "active" end where id = "'.$id.'"');
	}
	function update_statusactive($id)
	{
		$this->db->query('update '.$this->countdown_table.' set status = "active"  where id = "'.$id.'"');
	}
	function update_statusinactive($id)
	{
		$this->db->query('update '.$this->countdown_table.' set status = "inactive"  where id = "'.$id.'"');
	}

}
?>