<?php 
class Cmsblock extends CI_controller{
	
	function Cmsblock()
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
		
		$this->load->model("admin/cmsblockmodel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
	}

	function index()
	{	
		
		$this->data["page_title"] = $this->lang->line('CMS_BLOCK_TITLE');
		$this->data["page_head"]= $this->lang->line('CMS_BLOCK_TITLE');
		
		$this->data["cmspagedata"] = $this->cmsblockmodel->getcmsbockdata();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/cmsblock/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	
	function add()
	{	
		$this->data["page_head"]  =   $this->lang->line('ADD_BLOCK_TITLE_CMS');
		$this->data["page_title"] =  $this->lang->line('CMS_BLOCK_ADD_TITLE');
		$this->data["page_view"]  =  $this->lang->line('CMS_BLOCK_ADD_TITLE');
		
		
		$this->data["formdata"] = array(
		"id" => "",
		"title" => "",
		"description" => "",
		"status" => "active"
		);

		$this->form_validation->set_rules("title","title","required");
		$this->form_validation->set_rules("description","description","required");
		if ($this->form_validation->run() == TRUE)
		{ 
			$id = $this->cmsblockmodel->insert_record();
			$this->session->set_userdata('succe','1');
			redirect('admin/cmsblock');
		}
		$title = $this->input->post("title");
		if(isset($title) && !empty($title))
		{
			$this->data["formdata"] = array(
			"id" => "",
			"title" => $this->input->post("title"),
			"description" => $this->input->post("description"),
			"status" => $this->input->post("status")
			);
		}	
			
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/cmsblock/add",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function edit()
	{	
		$this->data["page_head"]  =   $this->lang->line('ADD_BLOCK_TITLE_CMS');
		$this->data["page_title"] =  $this->lang->line('CMS_BLOCK_EDIT_TITLE');
		$this->data["page_view"]  =  $this->lang->line('CMS_BLOCK_TITLE');
		
		$this->data["formdata"] = $this->cmsblockmodel->single_cmsblockdata($this->input->get("id"));
		$this->data["cmspagename"] = $this->cmsblockmodel->getcmsblocksname($this->input->get("id"));
	
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/cmsblock/edit",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function update($id='')
	{

		$this->form_validation->set_rules("title","title","required");
		$this->form_validation->set_rules("description","description","required");
			
		if ($this->form_validation->run() == TRUE)
		{ 
			$this->cmsblockmodel->update_record($this->input->post('id'));
			$this->session->set_userdata('updatescc','1');
			redirect('admin/cmsblock');
		}
		
		
	}
	
	function update_status($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
		
			$this->cmsblockmodel->update_statusm($id);
			$this->session->set_flashdata('succ_update','1');
			redirect('admin/cmsblock');
		}
		else
		{
			redirect('admin/cmsblock');
		}
	}
	function update_status_activeall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg= $this->cmsblockmodel->update_statusactive($val);
				if($msg==2) break;
			}
			$this->session->set_userdata('succ_active','1');
			redirect('admin/cmsblock');
		}
		else
		{
			redirect('admin/cmsblock');
		}
	}
	function update_status_inactiveall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg=$this->cmsblockmodel->update_statusinactive($val);
				if($msg==2) break;
			}
			$this->session->set_userdata('succ_inactive','1');
			redirect('admin/cmsblock');
		}
		else
		{
			redirect('admin/cmsblock');
		}
	}
	
	function delete($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
			$msg =$this->cmsblockmodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/cmsblock');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->cmsblockmodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/cmsblock');
		}
		else
		{
			redirect('admin/cmsblock');
		}
	}
	
}

?>