<?php 
class Myprofile extends CI_controller{
	
	function Myprofile()
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
		
		$this->load->model("admin/myprofilemodel");
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
	}

	function index()
	{	
		$this->data["page_head"]= $this->lang->line('PROFILE_TITLE');
		$success = 0;
		$this->form_validation->set_rules("username","username","required");
		$this->form_validation->set_rules("email","email","required");
		if ($this->form_validation->run() == TRUE)
		{ 
		$update_record = $this->myprofilemodel->update_record();
		$success = 1;
		}
		$this->data["success"] = $success;
		$this->data["profiledata"] = $this->myprofilemodel->getsprofiledata('1');
		$this->data["page_title"] = $this->lang->line('PROFILE_TITLE');
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/myprofile/edit",$this->data);
		$this->load->view("admin/common/footer");
	}
}

?>