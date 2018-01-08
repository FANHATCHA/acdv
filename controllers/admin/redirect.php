<?php 
class Redirect extends CI_controller{
	
	function Redirect()
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
		
		$this->load->model("admin/redirectmodel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
	}

	function index()
	{	
		
		$this->data["page_title"] = $this->lang->line('REDIRECT_TITLE');
		$this->data["page_head"]= $this->lang->line('REDIRECT_TITLE');
		
		$this->data["redirectdata"] = $this->redirectmodel->geturldata();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/redirect/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	
	function add()
	{	
		$this->data["page_head"]  =   $this->lang->line('ADD_TITLE_URl');
		$this->data["page_title"] =  $this->lang->line('ADD_TITLE_URl');
		$this->data["page_view"]  =  $this->lang->line('URl_ADD_TITLE');
		
		
		$this->data["formdata"] = array(
				"id" => "",
				"old_url" => "",
				"new_url" => "",
				"is_seo" => "active",
				"is_display_on_sitemap" => "yes",
				"status" =>"active",
				"meta_title" => "",
				"robots" => "no",
				"rel"=> "",
				"canonical_url"=> "",
				"meta_keyword"=>"",
				"meta_description"=>""
				);

		
			$this->form_validation->set_rules("old_url","old_url","required");
			$this->form_validation->set_rules("new_url","new_url","required");
			
			if ($this->form_validation->run() == TRUE)
			{ 
				
				$id = $this->redirectmodel->insert_record();
				$this->session->set_userdata('succe','1');
				redirect('admin/redirect');
			}
			$old_url = $this->input->post("old_url");
			if(isset($old_url) && !empty($old_url))
			{
				$this->data["formdata"] = array(
				"id" => "",
				"old_url" => $this->input->post("old_url"),
				"new_url" => $this->input->post("new_url"),
				"is_seo" => $this->input->post("is_seo"),
				"is_display_on_sitemap" => $this->input->post("is_display_on_sitemap"),
				"status" =>$this->input->post("status"),
				"robots" => $this->input->post("robots"),
				"rel"=> $this->input->post("rel"),
				"meta_title" => $this->input->post("meta_title"),
				"meta_keyword"=>$this->input->post("meta_keyword"),
				"meta_description"=>$this->input->post("meta_description")
				);
			}	
		$this->load->view("admin/common/header",$this->data);
		$this->data["relattributes"]     = $this->redirectmodel->getrelattributes();
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/redirect/add",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function edit()
	{	
		
		$this->data["page_head"]  =   $this->lang->line('EDIT_TITLE_URl');
		$this->data["page_title"] =  $this->lang->line('EDIT_TITLE_URl');
		$this->data["page_view"]  =  $this->lang->line('URl_EDIT_TITLE');
		
		$this->data["formdata"] = $this->redirectmodel->single_urldata($this->input->get("id"));
		$this->data["urlname"] = $this->redirectmodel->geturlsname($this->input->get("id"));
		
		$this->data["relattributes"]     = $this->redirectmodel->getrelattributes();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/redirect/edit",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function update($id='')
	{

		$this->form_validation->set_rules("old_url","old_url","required");
		$this->form_validation->set_rules("new_url","new_url","required");
			
		if ($this->form_validation->run() == TRUE)
		{ 
			$this->redirectmodel->update_record($this->input->post('url_id'));
			$this->session->set_userdata('updatescc','1');
			redirect('admin/redirect');
		}
		
		
	}
	
	function update_status($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
		
			$this->redirectmodel->update_statusm($id);
			$this->session->set_flashdata('succ_update','1');
			redirect('admin/redirect');
		}
		else
		{
			redirect('admin/redirect');
		}
	}
	function update_status_activeall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg= $this->redirectmodel->update_statusactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_active','1');
			redirect('admin/redirect');
		}
		else
		{
			redirect('admin/redirect');
		}
	}
	function update_status_inactiveall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg=$this->redirectmodel->update_statusinactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_inactive','1');
			redirect('admin/redirect');
		}
		else
		{
			redirect('admin/redirect');
		}
	}
	
	function delete($id='')
	{
	
		$id =$this->input->get('id');
		
		if(!empty($id)){
			$msg =$this->redirectmodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/redirect');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->redirectmodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/redirect');
		}
		else
		{
			redirect('admin/redirect');
		}
	}
	
}

?>