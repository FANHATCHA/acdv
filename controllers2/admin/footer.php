<?php 
class Footer extends CI_controller{
	
	function Footer()
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
		
		
		$this->load->model("admin/footermodel");
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
	}

	function index()
	{	
		$this->data["page_head"]= $this->lang->line('FOOTER');
		$success = 0;
		$this->form_validation->set_rules("footer_content","footer_content","required");
		
		if ($this->form_validation->run() == TRUE)
		{ 
			$update_record = $this->footermodel->update_record();
			$success = 1;
			//$this->session->set_userdata('succ_edit','1');
		}
		$this->data["success"] = $success;
		$this->data["profiledata"] = $this->footermodel->getsprofiledata('1');
		$this->data["page_title"] = $this->lang->line('FOOTER');
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/footer/edit",$this->data);
		$this->load->view("admin/common/footer");
	}
}

?>