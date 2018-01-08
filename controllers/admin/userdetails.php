<?php 
class Userdetails extends CI_controller{
	
	function Userdetails()
	{
		parent::__construct();	
		
		/* CLEAR CATCH CODE */
		header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header("Connection: close");
		/* CLEAR CATCH CODE */
	
		$this->load->model("admin/userdetailsmodel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
	}

	function index()
	{	
		
		$this->data["page_title"] = $this->lang->line('USERDETAILS_TITLE');
		$this->data["page_head"]= $this->lang->line('USERDETAILS_TITLE');
		
		$this->data["userdetailsdata"] = $this->userdetailsmodel->getuserdetailsdata();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/userdetails/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	
	function add()
	{	
		$this->data["page_head"]  =   $this->lang->line('USERDETAILS_ADD_TREVING');
		$this->data["page_title"] =  $this->lang->line('USERDETAILS_ADD');
		$this->data["page_view"]  =  $this->lang->line('USERDETAILS_ADD');
		$this->data["formdata"] = array(
				"id" => "",
				"user_name"=>"",
				"position"=>"",
				"description_destination" => "",
				"cms_page_description" => "",
				"description_product" =>"",
				"show_home" =>"",
				"show_home_position" =>"",
				"userblock_clickble" =>"no",
				"clickble_link" =>"",
				"phoneno"=>"",
				"email"=>"",
				"status"=>"active"
			);
			$this->form_validation->set_rules("user_name","user_name","required");
			$this->form_validation->set_rules('check_dups', 'user_name', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{ 
				$id = $this->userdetailsmodel->insert_record();
				$this->session->set_userdata('succe','1');
				redirect('admin/userdetails');
			}
			$user_name = $this->input->post("user_name");
			if(isset($user_name) && !empty($user_name))
			{
				$this->data["formdata"] = array(
				"id" => "",
				"user_name"=>$this->input->post("user_name"),
				"position"=>$this->input->post("position"),
				"description_destination" => $this->input->post("description_destination"),
				"cms_page_description" => $this->input->post("cms_page_description"),
				"description_product" => $this->input->post("description_product"),
				"show_home" =>$this->input->post("show_home"),
				"show_home_position" =>$this->input->post("show_home_position"),
				"userblock_clickble" =>$this->input->post("userblock_clickble"),
				"clickble_link" =>$this->input->post("clickble_link"),
				"phoneno"=>$this->input->post("phoneno"),
				"email"=>$this->input->post("email"),
				"status"=>$this->input->post("status"),
				);
			}	
			
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/userdetails/add",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function edit()
	{	
		$this->data["page_head"]  =   $this->lang->line('USERDETAILS_EDIT_TREVING');
		$this->data["page_title"] =  $this->lang->line('USERDETAILS_EDIT');
		$this->data["page_view"]  =  $this->lang->line('USERDETAILS_EDIT');
		
		$this->data["formdata"] = $this->userdetailsmodel->single_userdetailsdata($this->input->get("id"));
		$this->data["userdetailspagename"] = $this->userdetailsmodel->getuserdetailsname($this->input->get("id"));
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/userdetails/edit",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function update($id='')
	{

		$this->form_validation->set_rules("user_name","user_name","required");
		$this->form_validation->set_rules('check_dups', 'user_name', 'callback_check_dups');
			
		if ($this->form_validation->run() == TRUE)
		{ 
		
			$this->userdetailsmodel->update_record($this->input->post('user_id'));
			$this->session->set_userdata('updatescc','1');
			redirect('admin/userdetails');
		}
		
		
	}
	
	function update_status($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
		
			$this->userdetailsmodel->update_statusm($id);
			$this->session->set_userdata('succ_update','1');
			redirect('admin/userdetails');
		}
		else
		{
			redirect('admin/userdetails');
		}
	}
	function update_status_activeall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg= $this->userdetailsmodel->update_statusactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_active','1');
			redirect('admin/userdetails');
		}
		else
		{
			redirect('admin/userdetails');
		}
	}
	function update_status_inactiveall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg=$this->userdetailsmodel->update_statusinactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_inactive','1');
			redirect('admin/userdetails');
		}
		else
		{
			redirect('admin/userdetails');
		}
	}
	
	function delete($id='')
	{
	
		$id =$this->input->get('id');
		
		if(!empty($id)){
			$msg =$this->userdetailsmodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/userdetails');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->userdetailsmodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/userdetails');
		}
		else
		{
			redirect('admin/userdetails');
		}
	}
	
	function check_dups()
	{ 

		$this->db->where("user_name",$this->input->post("user_name"));
		if($this->input->post("user_id")){$this->db->where('id !=',$this->input->post("user_id"));}
		$query = $this->db->get("user_details");
		if($query->num_rows()==0) return true;
		else{
			$this->form_validation->set_message('check_dups',"User Name already exists");
			return false;
		}

	}
	
}

?>