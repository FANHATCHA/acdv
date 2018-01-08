<?php 
class Practicalinfo extends CI_controller{
	
	function Practicalinfo()
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
		
		$this->load->model("admin/practicalinfomodel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
		
	}

	function index()
	{	
		
		$this->data["page_title"] = $this->lang->line('PROINFO_TITLE');
		$this->data["page_head"]= $this->lang->line('PROINFO_TITLE');
		
		$this->data["practicalinfodata"] = $this->practicalinfomodel->getpracticalinfodata();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/practicalinfo/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	
	function add()
	{	
		$createddate = date('Y-m-d H:i:s');
		$this->data["page_head"]  =   $this->lang->line('PROINFO_ADD_TITLE');
		$this->data["page_title"] =  $this->lang->line('PROINFO_ADD_TITLE');
		$this->data["page_view"]  =  $this->lang->line('PROINFO_TITLE');
		
		$this->data["formdata"] = array(
					"id" => "",
					"practical_information_id" => "",
					"destination_id" => "",
					"content" => "",
					"short_description" => "",
					"tags"=> "",
					"categories"=> "",
					"status"=> "active",
					"is_display_on_sitemap"=> "yes",
					"is_seo"=> "active",
					"display_order"=> "",
					"rewrite_url"=> "",
					"meta_title"=> "",
					"meta_keyword"=> "",
					"robots" => "no",
					"rel"=> "",
					"canonical_url"=> "",
					"meta_description"=> ""
				);
		
		$this->form_validation->set_rules("practical_information_id","practical_information_id","required");
		$this->form_validation->set_rules('check_dups', 'practical_information_id', 'callback_check_dups');
		if ($this->form_validation->run() == TRUE)
		{ 
			$id = $this->practicalinfomodel->insert_record();
			$this->session->set_userdata('succe','1');
			redirect('admin/practicalinfo');
		}
		$proname = $this->input->post("practical_information_id");
		
		
		if(isset($proname) && !empty($proname))
		{
				$data= array(
					"practical_information_id" => $this->input->post("practical_information_id"),
					"destination_id" => $this->input->post("destination_id"),
					"content" => $this->input->post("content"),
					"short_description" => $this->input->post("short_description"),
					"tags"=> $this->input->post("tags"),
					"categories"=> $this->input->post("category"),
					"status"=> $this->input->post("status"),
					"is_display_on_sitemap"=> $this->input->post("is_display_on_sitemap"),
					"is_seo"=> $this->input->post("is_seo"),
					"display_order"=> $this->input->post("display_order"),
					"rewrite_url"=> $this->input->post("rewrite_url"),
					"meta_title"=> $this->input->post("meta_title"),
					"meta_keyword"=> $this->input->post("meta_keyword"),
					"robots" => $this->input->post("robots"),
					"rel"=> $this->input->post("rel"),
					"meta_description"=> $this->input->post("meta_description")
				);
		
		}
		$this->data['displayorder']  		 = $this->practicalinfomodel->displayorder();
		$this->data['practicalinfocatdata']  = $this->practicalinfomodel->getpracticalinfocatdata();
		$this->data['destinationdata']  = $this->practicalinfomodel->getdestination();
		$this->data['tagsdata']		 		 = $this->practicalinfomodel->gettags();
		$this->data["relattributes"]     = $this->practicalinfomodel->getrelattributes();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/practicalinfo/add",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function edit()
	{	
		$this->data["page_head"]  =   $this->lang->line('PROEDITINFO_TITLE');
		$this->data["page_title"] =  $this->lang->line('PROEDITINFO_TITLE');
		$this->data["page_view"]  =  $this->lang->line('PROINFO_TITLE');
		
		$this->data["formdata"] 			 = $this->practicalinfomodel->single_practicalinfodata($this->input->get("id"));
		
		$this->data['displayorder']  		 = $this->practicalinfomodel->displayorder();
		$this->data['practicalinfocatdata']  = $this->practicalinfomodel->getpracticalinfocatdata();
		$this->data['tagsdata']		 		 = $this->practicalinfomodel->gettags();
		$this->data['productinfoname']		 		 = $this->practicalinfomodel->getproductinfoname($this->input->get("id"));
		$this->data["relattributes"]     = $this->practicalinfomodel->getrelattributes();
		$this->data['destinationdata']  = $this->practicalinfomodel->getdestination();
		
		$this->data['displayorder'] = $this->practicalinfomodel->displayorder();
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/practicalinfo/edit",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function update($id='')
	{
				
		
		$this->form_validation->set_rules("practical_information_id","practical_information_id","required");
		$this->form_validation->set_rules('check_dups', 'practical_information_id', 'callback_check_dups');
		
		if ($this->form_validation->run() == TRUE)
		{ 
			$this->practicalinfomodel->update_record($this->input->post('proinfo_id'));
			$this->session->set_flashdata('updatescc','1');
			redirect('admin/practicalinfo');
		}
	}
	
	function update_status($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
		
			$this->practicalinfomodel->update_statusm($id);
			$this->session->set_flashdata('succ_update','1');
			redirect('admin/practicalinfo');
		}
		else
		{
			redirect('admin/practicalinfo');
		}
	}
	function update_status_activeall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg=$this->practicalinfomodel->update_statusactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_active','1');
			redirect('admin/practicalinfo');
		}
		else
		{
			redirect('admin/practicalinfo');
		}
	}
	function update_status_inactiveall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg=$this->practicalinfomodel->update_statusinactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_inactive','1');
			redirect('admin/practicalinfo');
		}
		else
		{
			redirect('admin/practicalinfo');
		}
	}
	
	function delete($id='')
	{
	
		$id =$this->input->get('id');
		
		if(!empty($id)){
			$msg =$this->practicalinfomodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/practicalinfo');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->practicalinfomodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/practicalinfo');
		}
		else
		{
			redirect('admin/practicalinfo');
		}
	}
	
	function check_dups()
	{ 
		$destinationid 	  = $this->input->post('destination_id');
		$partical_page_id = $this->input->post('practical_information_id');
		$proinfo_id = $this->input->post('proinfo_id');
		
		
		if(isset($proinfo_id) && !empty($proinfo_id))
		{
			$query = $this->db->query("SELECT * FROM practical_information WHERE destination_id  = '".$destinationid."' AND (practical_information_id = '".$partical_page_id."' AND id != '".$proinfo_id."')");
			if($query->num_rows()==0) 
			{
				return true;
			}
			else
			{
				$this->session->set_userdata('check_dups','This destination detailed category already exists');
				$this->form_validation->set_message('check_dups',"This destination detailed category already exists");
				redirect('admin/practicalinfo/edit?id='.$proinfo_id);
			}
		}
		else
		{
			$query = $this->db->query("SELECT * FROM practical_information WHERE destination_id  = '".$destinationid."' AND practical_information_id = '".$partical_page_id."'");
			if($query->num_rows()==0) 
			{
				return true;
			}
			else
			{
				$this->session->set_userdata('check_dups','This destination detailed category already exists');
				$this->form_validation->set_message('check_dups',"This destination detailed category already exists");
				redirect('admin/practicalinfo/add');
			}
		}
		

	}
	
	
	
}

?>