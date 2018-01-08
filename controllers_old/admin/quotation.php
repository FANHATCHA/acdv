<?php 
class quotation extends CI_controller{
	
	function quotation()
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
		
		$this->load->model("admin/quotationmodel");
		$this->load->helper(array('form', 'url'));
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
	}

	function index()
	{
		
		$this->data["page_title"] = $this->lang->line('QUOTATION_TITLE');
		$this->data["page_head"]= $this->lang->line('QUOTATION_TITLE');
		
		$this->data["quotationdata"] = $this->quotationmodel->getquotationdata();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/quotation/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	function view_from($id='')
	{
		$this->data["page_title"] = $this->lang->line('QUOTATION_TITLE');
		$this->data["page_head"]= $this->lang->line('QUOTATION_TITLE');
		
		$id =$this->input->get('id');
		$this->data["formdata"] = $this->quotationmodel->getsingleformdata($id);
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/quotation/view_form.php",$this->data);
		$this->load->view("admin/common/footer");
	}
	function delete($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
			$msg =$this->quotationmodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/quotation');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->quotationmodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/quotation');
		}
		else
		{
			redirect('admin/quotation');
		}
	}
	
}

?>