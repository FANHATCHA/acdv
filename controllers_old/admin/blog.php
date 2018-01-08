<?php 
class Blog extends CI_controller{
	
	function Blog()
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
		
		
		$this->load->model("admin/blogmodel");
		$this->load->model("admin/productmodel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
		
	}

	function index()
	{	
		
		$this->data["page_title"] = $this->lang->line('BLOG_ARTICLE_TITLE');
		$this->data["page_head"]= $this->lang->line('BLOG_ARTICLE_TITLE');
		
		$this->data["blogdata"] = $this->blogmodel->getblogdata();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/blog/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	
	function add()
	{	
		$createddate = date('Y-m-d H:i:s');
		$this->data["page_head"]  =   $this->lang->line('BLOG_ARTICLE_ADD_TITLE');
		$this->data["page_title"] =  $this->lang->line('BLOG_ARTICLE_ADD_TITLE');
		$this->data["page_view"]  =  $this->lang->line('BLOG_ARTICLE_TITLE');
		
		$this->data["formdata"] = array(
					"id" => "",
					"slider_id" => "",
					"blog_date" => "",
					"blog_title" => "",
					"slug" =>"",
					"blog_content" => "",
					"categories"=> "",
					"status"=> "active",
					"is_display_on_sitemap"=> "yes",
					"is_seo"=> "active",
					"display_order"=> "",
					"rewrite_url"=> "",
					"meta_title"=> "",
					"meta_keyword"=> "",
					"robots" => "yes",
					"rel"=> "",
					"canonical_url"=> "",
					"meta_description"=> ""
				);
		
		$this->form_validation->set_rules("blog_title","blog_title","required");
		$this->form_validation->set_rules('check_dups', 'blog_title', 'callback_check_dups');
		if ($this->form_validation->run() == TRUE)
		{ 
			$id = $this->blogmodel->insert_record();
			$this->session->set_userdata('succe','1');
			redirect('admin/blog');
		}
		$proname = $this->input->post("blog_title");
		$categoryids = $this->input->post("category");
		  if(isset($categoryids) && !empty($categoryids))
		  {
			$categorysel = implode(',',$categoryids);
		  }
		  else
		  {
			$categorysel = '';
		  }	
		if(isset($proname) && !empty($proname))
		{
				$data= array(
					"blog_title" => $this->input->post("blog_title"),
					"blog_content" => $this->input->post("blog_content"),
					"blog_date" => $this->input->post("blog_date"),
					"slug" =>$this->input->post("slug"),
					"slider_id" => $this->input->post("slider_id"),
					"categories"=> $categorysel,
					"status"=> $this->input->post("status"),
					"is_display_on_sitemap"=> $this->input->post("is_display_on_sitemap"),
					"is_seo"=> $this->input->post("is_seo"),
					"display_order"=> $this->input->post("display_order"),
					"rewrite_url"=> $this->input->post("rewrite_url"),
					"meta_title"=> $this->input->post("meta_title"),
					"meta_keyword"=> $this->input->post("meta_keyword"),
					"meta_description"=> $this->input->post("meta_description"),
					"robots" => $this->input->post("robots"),
					"rel"=> $this->input->post("rel"),
					"created_date"=> $createddate,
					"modified_date"=> $createddate
				);
		
		}
		$this->data['displayorder']  		 = $this->blogmodel->displayorder();
		$this->data['blogcatdata'] 			 = $this->blogmodel->getblogcatdata();
		$this->data["relattributes"]     	= $this->blogmodel->getrelattributes();
		$this->data['bannerid'] 			 = $this->productmodel->getbannerid();
		
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/blog/add",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function edit()
	{	
		$this->data["page_head"]  =   $this->lang->line('BLOG_ARTICLE_EIDT_TITLE');
		$this->data["page_title"] =  $this->lang->line('BLOG_ARTICLE_EIDT_TITLE');
		$this->data["page_view"]  =  $this->lang->line('BLOG_ARTICLE_TITLE');
		
		$this->data["formdata"] 			 = $this->blogmodel->single_blogdata($this->input->get("id"));
		
		$this->data['displayorder']  			 	= $this->blogmodel->displayorder();
		$this->data['blogcatdata']  				= $this->blogmodel->getblogcatdata();
		$this->data['productinfoname']		 		= $this->blogmodel->getproductinfoname($this->input->get("id"));
		$this->data["relattributes"]    			 = $this->blogmodel->getrelattributes();
		$this->data['bannerid'] 			 		= $this->productmodel->getbannerid();
		
		
		$this->data['displayorder'] = $this->blogmodel->displayorder();
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/blog/edit",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function update($id='')
	{
		$this->form_validation->set_rules("blog_title","blog_title","required");
		$this->form_validation->set_rules('check_dups', 'blog_title', 'callback_check_dups');
		if ($this->form_validation->run() == TRUE)
		{ 
			$this->blogmodel->update_record($this->input->post('blog_id'));
			$this->session->set_flashdata('updatescc','1');
			redirect('admin/blog');
		}
	}
	
	function update_status($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
		
			$this->blogmodel->update_statusm($id);
			$this->session->set_flashdata('succ_update','1');
			redirect('admin/blog');
		}
		else
		{
			redirect('admin/blog');
		}
	}
	function update_status_activeall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg=$this->blogmodel->update_statusactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_active','1');
			redirect('admin/blog');
		}
		else
		{
			redirect('admin/blog');
		}
	}
	function update_status_inactiveall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg=$this->blogmodel->update_statusinactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_inactive','1');
			redirect('admin/blog');
		}
		else
		{
			redirect('admin/blog');
		}
	}
	
	function delete($id='')
	{
	
		$id =$this->input->get('id');
		
		if(!empty($id)){
			$msg =$this->blogmodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/blog');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->blogmodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/blog');
		}
		else
		{
			redirect('admin/blog');
		}
	}
	
	function check_dups()
	{ 
		
		$this->db->where("blog_title",$this->input->post("blog_title"));

		if($this->input->post("blog_id")){$this->db->where('id !=',$this->input->post("blog_id"));}

		$query = $this->db->get("blog");

		if($query->num_rows()==0) return true;

		else{
			$this->form_validation->set_message('check_dups',"Title already exists");
			return false;
		}

	}
	
}

?>