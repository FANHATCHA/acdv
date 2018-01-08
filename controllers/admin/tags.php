<?php 
class Tags extends CI_controller{
	
	function Tags()
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
		
		
		$this->load->model("admin/tagsmodel");
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');

	}

	function index()
	{	
		
		$this->data["page_title"] = $this->lang->line('TAG_TITLE');
		$this->data["page_head"]= $this->lang->line('TAG_TITLE');
		
		$this->data["tagsdata"] = $this->tagsmodel->gettagsdata();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/tags/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	
	function add()
	{	
		$this->data["page_head"]  =   $this->lang->line('ADD_TITLE_TAG');
		$this->data["page_title"] =  $this->lang->line('TAG_ADD_TITLE');
		$this->data["page_view"]  =  $this->lang->line('TAG_ADD_TITLE');
		
		$this->data["formdata"] = array(
					"tag_name" => "",
					"h1_title" => "",
					"slug" => "",
					"tag_description" => "",
					"tag_type" => "primary",
					"tag_page" => "",
					"slider_id" => "",
					"status" =>"active",
					"rewrite_url" => "",
					"is_seo" => "active",
					"meta_title" => "",
					"meta_keyword"=>"",
					"robots" => "no",
					"rel"=> "",
					"canonical_url"=> "",
					"meta_description"=>""
				);

		if($this->input->post("Tag_Save"))
		{
			
			$this->form_validation->set_rules("tag_name","tag_name","required");
			$this->form_validation->set_rules("tag_type","tag_type","required");
			//$this->form_validation->set_rules('check_dups', 'tag_name', 'callback_check_dups');
			
			if ($this->form_validation->run() == TRUE)
			{ 
				$id = $this->tagsmodel->insert_record();
				$this->session->set_userdata('success','1');
				redirect('admin/tags');
			}
			
			$this->data["formdata"] = array(
					"tag_name" => $this->input->post("tag_name"),
					"h1_title" => $this->input->post("h1_title"),
					"slug" => $this->input->post("slug"),
					"tag_description" => $this->input->post("tag_description"),
					"tag_type" => $this->input->post("tag_type"),
					"tag_page" => $this->input->post("tag_page"),
					"slider_id" => $this->input->post("slider_id"),
					"status" =>$this->input->post("status"),
					"rewrite_url" => $this->input->post("rewrite_url"),
					"is_seo" => $this->input->post("is_seo"),
					"meta_title" => $this->input->post("meta_title"),
					"meta_keyword"=>$this->input->post("meta_keyword"),
					"robots" => $this->input->post("robots"),
					"rel"=> $this->input->post("rel"),
					"meta_description"=>$this->input->post("meta_description")
				);
			
		}
		
		$this->data["relattributes"]     = $this->tagsmodel->getrelattributes();
		$this->data['bannerid'] 		= $this->tagsmodel->getbannerid();
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/common/header",$this->data);
		$this->load->view("admin/tags/add",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function edit()
	{	
		$this->data["page_head"]  =   $this->lang->line('EDIT_TITLE_TAG');
		$this->data["page_title"] =  $this->lang->line('TAG_EDIT_TITLE');
		$this->data["page_view"]  =  $this->lang->line('TAG_EDIT_TITLE');
		
		$this->data["formdata"] = $this->tagsmodel->single_tagdata($this->input->get("id"));
		$this->data["tagname"] = $this->tagsmodel->gettagsname($this->input->get("id"));
		$this->data['bannerid'] 		= $this->tagsmodel->getbannerid();
		$this->data["relattributes"]     = $this->tagsmodel->getrelattributes();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/tags/edit",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function update($id='')
	{

		$this->form_validation->set_rules("tag_name","tag_name","required");
		$this->form_validation->set_rules("tag_type","tag_type","required");
		//$this->form_validation->set_rules('check_dups', 'tag_name', 'callback_check_dups');
			
		if ($this->form_validation->run() == TRUE)
		{ 
			$this->tagsmodel->update_record($this->input->post('tag_id'));
			$this->session->set_userdata('updatescc','1');
			redirect('admin/tags');
		}
		
		
	}
	
	function update_status($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
		
			$this->tagsmodel->update_statusm($id);
			$this->session->set_flashdata('succ_update','1');
			redirect('admin/tags');
		}
		else
		{
			redirect('admin/tags');
		}
	}
	function update_status_activeall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg= $this->tagsmodel->update_statusactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_active','1');
			redirect('admin/tags');
		}
		else
		{
			redirect('admin/tags');
		}
	}
	function update_status_inactiveall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg= $this->tagsmodel->update_statusinactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_inactive','1');
			redirect('admin/tags');
		}
		else
		{
			redirect('admin/tags');
		}
	}
	
	function delete($id='')
	{
	
		$id =$this->input->get('id');
		
		if(!empty($id)){
			$msg =$this->tagsmodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/tags');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->tagsmodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/tags');
		}
		else
		{
			redirect('admin/tags');
		}
	}
	
	function check_dups()
	{ 

		$this->db->where("tag_name",$this->input->post("tag_name"));

		if($this->input->post("TagId")){$this->db->where('id !=', $this->input->post("TagId"));}

		$query = $this->db->get("tags");

		if($query->num_rows()==0) return true;

		else{
			$this->form_validation->set_message('check_dups',"Name already exists");
			return false;
		}

	}
	
}

?>