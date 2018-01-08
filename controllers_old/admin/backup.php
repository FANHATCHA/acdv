<?php
class Backup extends CI_controller{
 
	function Backup()
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
		
		
		$this->load->model("admin/backupmodel");
		$this->load->database();
		$this->load->helper(array('form', 'url'));
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
	}
 
	function index()
	{
 		$this->data["page_title"] = $this->lang->line('BACKUP_TITLE');
		$this->data["page_head"]= $this->lang->line('BACKUP_TITLE');
		$this->data["backupdata"] = $this->backupmodel->getbackupdata();
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);
		$this->load->view("admin/backup/list",$this->data);
		$this->load->view("admin/common/footer");
	}
 
	function export_backup()
	{
		$succbackup = $this->backupmodel->create_backup();
		$this->session->set_userdata('succbackup',$succbackup);
		redirect('admin/backup');		
	}

	function delete_backup()
	{
		$deletebackup = $this->backupmodel->delete_backup($this->input->get("db_file"));
		$this->session->set_userdata('deletebackup',$deletebackup);
		redirect('admin/backup');	
		
	}
 
}
 
?>