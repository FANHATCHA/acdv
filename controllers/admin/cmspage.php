<?php 
class Cmspage extends CI_controller{
	
	function Cmspage()
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
		
		
		$this->load->model("admin/cmspagemodel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
	}

	function index()
	{	
		
		$this->data["page_title"] = $this->lang->line('CMS_TITLE');
		$this->data["page_head"]= $this->lang->line('CMS_TITLE');
		
		$this->data["cmspagedata"] = $this->cmspagemodel->getcmspagedata();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/cmspage/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	
	function add()
	{	
		$this->data["page_head"]  =   $this->lang->line('ADD_TITLE_CMS');
		$this->data["page_title"] =  $this->lang->line('CMS_ADD_TITLE');
		$this->data["page_view"]  =  $this->lang->line('CMS_ADD_TITLE');
		
		
		$this->data["formdata"] = array(
				"id" => "",
				"cms_title" => "",
				"slug" => "",
				"cms_content" => "",
				"cms_image" => "",
				"is_seo" => "active",
				"is_display_on_sitemap" => "yes",
				"status" =>"active",
				"display_order" => "",
				"rewrite_url" => "",
				"meta_title" => "",
				"meta_keyword"=>"",
				"robots" => "no",
				"rel"=> "",
				"canonical_url"=> "",
				"meta_description"=>""
				);

		
			$this->form_validation->set_rules("cms_title","cms_title","required");
			$this->form_validation->set_rules("cms_content","cms_content","required");
			$this->form_validation->set_rules('check_dups', 'cms_title', 'callback_check_dups');
			//print_r($this->form_validation->run());exit;
			if ($this->form_validation->run() == TRUE)
			{ 
				
				$id = $this->cmspagemodel->insert_record();
				$this->session->set_userdata('succe','1');
				redirect('admin/cmspage');
			}
			$cmstitle = $this->input->post("cms_title");
			if(isset($cmstitle) && !empty($cmstitle))
			{
				$this->data["formdata"] = array(
				"id" => "",
				"cms_title" => $this->input->post("cms_title"),
				"slug" => $this->input->post("slug"),
				"cms_content" => $this->input->post("cms_content"),
				"is_seo" => $this->input->post("is_seo"),
				"is_display_on_sitemap" => $this->input->post("is_display_on_sitemap"),
				"status" =>$this->input->post("status"),
				"display_order" => $this->input->post("display_order"),
				"rewrite_url" => $this->input->post("rewrite_url"),
				"meta_title" => $this->input->post("meta_title"),
				"meta_keyword"=>$this->input->post("meta_keyword"),
				"robots" => $this->input->post("robots"),
				"rel"=> $this->input->post("rel"),
				"meta_description"=>$this->input->post("meta_description")
				);
			}	
			
			$this->data["relattributes"]     = $this->cmspagemodel->getrelattributes();
		$this->data['displayorder'] = $this->cmspagemodel->displayorder();
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/cmspage/add",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function edit()
	{	
		$this->data["page_head"]  =   $this->lang->line('ADD_TITLE_CMS');
		$this->data["page_title"] =  $this->lang->line('CMS_EDIT_TITLE');
		$this->data["page_view"]  =  $this->lang->line('CMS_TITLE');
		
		$this->data["formdata"] = $this->cmspagemodel->single_cmspagedata($this->input->get("id"));
		$this->data["cmspagename"] = $this->cmspagemodel->getcmspagesname($this->input->get("id"));
		$this->data["relattributes"]     = $this->cmspagemodel->getrelattributes();
				
		$this->data['displayorder'] = $this->cmspagemodel->displayorder();
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/cmspage/edit",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function update($id='')
	{

		$this->form_validation->set_rules("cms_title","cms_title","required");
		$this->form_validation->set_rules("cms_content","cms_content","required");
		$this->form_validation->set_rules('check_dups', 'cms_title', 'callback_check_dups');
			
		if ($this->form_validation->run() == TRUE)
		{ 
			$this->cmspagemodel->update_record($this->input->post('cms_id'));
			$this->session->set_userdata('updatescc','1');
			redirect('admin/cmspage');
		}
		
		
	}
	
	function update_status($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
		
			$this->cmspagemodel->update_statusm($id);
			$this->session->set_flashdata('succ_update','1');
			redirect('admin/cmspage');
		}
		else
		{
			redirect('admin/cmspage');
		}
	}
	function update_status_activeall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg= $this->cmspagemodel->update_statusactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_active','1');
			redirect('admin/cmspage');
		}
		else
		{
			redirect('admin/cmspage');
		}
	}
	function update_status_inactiveall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg=$this->cmspagemodel->update_statusinactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_inactive','1');
			redirect('admin/cmspage');
		}
		else
		{
			redirect('admin/cmspage');
		}
	}
	
	function delete($id='')
	{
	
		$id =$this->input->get('id');
		
		if(!empty($id)){
			$msg =$this->cmspagemodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/cmspage');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->cmspagemodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/cmspage');
		}
		else
		{
			redirect('admin/cmspage');
		}
	}
	
	function check_dups()
	{ 

		$this->db->where("cms_title",$this->input->post("cms_title"));

		if($this->input->post("cms_id")){$this->db->where('id !=',$this->input->post("cms_id"));}

		$query = $this->db->get("cmspage");

		if($query->num_rows()==0) return true;

		else{
			$this->form_validation->set_message('check_dups',"Title already exists");
			return false;
		}

	}
	
}

?>