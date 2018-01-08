<?php 
class Import extends CI_controller{
	
	function Import()
	{
		parent::__construct();	
		
		/* CLEAR CATCH CODE */
		header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header("Connection: close");
		set_time_limit(0);
		/* CLEAR CATCH CODE */
		
		$this->load->model("admin/importmodel");
		$this->load->library('csvimport');
		//if(!isset($session_data) || empty($session_data))redirect('admin/login');
	}
	function index() 
	{
		$this->data["page_head"]  =   $this->lang->line('IMPORT_TITLE_URl');
		$this->data["page_title"] =  $this->lang->line('IMPORT_TITLE_URl');
		$this->data["page_view"]  =  $this->lang->line('IMPORT_TITLE_URl');
		
		//$data['addressbook'] = $this->importmodel->get_addressbook();
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/import/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	function importcsv()
	{
		$handle = fopen($_FILES['csv']['tmp_name'], "r");
		fgetcsv($handle,10000,",");
		$filename = $_FILES['csv']['name'];
		$expfilename = explode('.',$_FILES['csv']['name']);
		if(isset( $expfilename[1]) && !empty( $expfilename[1]) && $expfilename[1] == 'csv')
		{
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$data= array(
					"old_url" => $data[0],
					"new_url" => $data[1]
				);
				
				$this->db->insert('url_redirect', $data);
			}
			fclose($handle);
			$this->session->set_userdata('succe','1');
			redirect('admin/redirect');
		}
		else
		{
			
			$this->session->set_flashdata('import_valid_file','1');
			redirect('admin/import');
		}
			
   }
	
}

?>