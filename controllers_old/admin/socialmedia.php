<?php 
class Socialmedia extends CI_controller{
	function Socialmedia()
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
		
		$this->load->model("admin/socialmediamodel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
	}

	function index($offset = 0)
	{	
		
		$this->data["page_title"] = $this->lang->line('SOCIAL_MEDIA_MENU');
		$this->data["page_head"]= $this->lang->line('SOCIAL_MEDIA_MENU');
		
		$this->data["socialicon_list"] = $this->socialmediamodel->get_socialmedialist();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/socialmedia/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	
	function add()
	{
		$this->data["page_head"]  =   $this->lang->line('SOCIAL_ADD_TITLE');
		$this->data["page_title"] =  $this->lang->line('SOCIAL_MEDIA_MENU');
		$this->data["page_view"]  =  $this->lang->line('SOCIAL_ADD_TITLE');
		
		//GET DISPLAY ORDER COUNT
		$this->data['display_order'] = $this->socialmediamodel->displayorder();
		
		$this->data["formdata"] = array(
			"name" => "",
			"image" => "",
			"url" => "",
			"iDisplayOrder" =>"",
			"eStatus" => "active"
		);

		$this->form_validation->set_rules("name","name","required");
		$this->form_validation->set_rules("url","url","required");
			
		if ($this->form_validation->run() == TRUE)
		{ 
			$id = $this->socialmediamodel->insert_record();
			$this->session->set_userdata('succe','1');
			redirect('admin/socialmedia');
		}
		$this->data["formdata"] = array(
			"name" => $this->input->post("name"),
			"email" => $this->input->post("email"),
			"url" => $this->input->post("url"),
			"iDisplayOrder" => $this->input->post("iDisplayOrder"),
			"eStatus" => $this->input->post("eStatus")
		);
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/socialmedia/add",$this->data);
		$this->load->view("admin/common/footer");
	}

	function edit($id='')
	{
		$this->data["page_head"]  =   $this->lang->line('SOCIAL_EDIT_TITLE');
		$this->data["page_title"] =  $this->lang->line('SOCIAL_MEDIA_MENU');
		$this->data["page_view"]  =  $this->lang->line('SOCIAL_EDIT_TITLE');
		
		$id =$this->input->get('id');
		
		if(!empty($id))
		{
			$this->data["formdata"] = $this->socialmediamodel->single_socialmedia($id);
		}$this->data['display_order'] = $this->socialmediamodel->displayorder();
		$this->data["getsocialmedia"] = $this->socialmediamodel->getsocialmedianame($id);
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/socialmedia/edit",$this->data);
		$this->load->view("admin/common/footer");
	}

	function update($id='')
	{

		$this->form_validation->set_rules("name","name","required");
		$this->form_validation->set_rules("url","url","required");
			
		if ($this->form_validation->run() == TRUE)
		{ 
			
			$id = $this->socialmediamodel->update_record($this->input->post('social_id'));
			$this->session->set_userdata('updatescc','1');
			redirect('admin/socialmedia');
		}
		
		
	}

	function update_status($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
		
			$this->socialmediamodel->update_statusm($id);
			$this->session->set_flashdata('succ_update','1');
			redirect('admin/socialmedia');
		}
		else
		{
			redirect('admin/socialmedia');
		}
	}
	function update_status_activeall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg = $this->socialmediamodel->update_statusactive($val);
				if($msg==2)
				break;
			}
			$this->session->set_flashdata('succ_active','1');
			redirect('admin/socialmedia');
		}
		else
		{
			redirect('admin/socialmedia');
		}
	}
	function update_status_inactiveall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg = $this->socialmediamodel->update_statusinactive($val);
				if($msg==2)
				break;
			}
			$this->session->set_flashdata('succ_inactive','1');
			redirect('admin/socialmedia');
		}
		else
		{
			redirect('admin/socialmedia');
		}
	}
	
	function delete($id='')
	{
	
		$id =$this->input->get('id');
		
		if(!empty($id)){
			$msg =$this->socialmediamodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/socialmedia');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->socialmediamodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/socialmedia');
		}
		else
		{
			redirect('admin/socialmedia');
		}
	}

}

?>