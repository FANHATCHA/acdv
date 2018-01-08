<?php 
class newsletter extends CI_controller{
	
	function newsletter()
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
		
		$this->load->model("admin/newslettermodel");
		$this->load->helper(array('form', 'url'));
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
	}

	function index()
	{
		
		$this->data["page_title"] = $this->lang->line('NEWSLETTER_TITLE');
		$this->data["page_head"]= $this->lang->line('NEWSLETTER_TITLE');
		
		$this->data["newsletterdata"] = $this->newslettermodel->getnewsletterdata();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/newsletter/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	
	function update_status($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
		
			$this->newslettermodel->update_newsletter_status($id);
			$this->session->set_flashdata('succ_update','1');
			redirect('admin/newsletter');
		}
		else
		{
			redirect('admin/newsletter');
		}
	}
	function update_status_activeall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg= $this->newslettermodel->update_status_subscribed($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_active','1');
			redirect('admin/newsletter');
		}
		else
		{
			redirect('admin/newsletter');
		}
	}
	function update_status_inactiveall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg= $this->newslettermodel->update_status_unsubscribed($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_inactive','1');
			redirect('admin/newsletter');
		}
		else
		{
			redirect('admin/newsletter');
		}
	}
	
	function delete($id='')
	{
	
		$id =$this->input->get('id');
		
		if(!empty($id)){
			$msg =$this->newslettermodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/newsletter');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->newslettermodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/newsletter');
		}
		else
		{
			redirect('admin/newsletter');
		}
	}
	
}

?>