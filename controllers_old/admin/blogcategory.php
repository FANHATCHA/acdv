<?php 
class Blogcategory extends CI_controller{
	
	function Blogcategory()
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
		
		
		$this->load->model("admin/blogcategorymodel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
	}

	function index()
	{	
		
		$this->data["page_title"] = $this->lang->line('BLOG_CAT_TITLE');
		$this->data["page_head"]= $this->lang->line('BLOG_CAT_TITLE');
		
		$this->data["blogdata"] = $this->blogcategorymodel->getblogcatlistdata();
				
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/blogcategory/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	
	function add()
	{	
		$createddate = date('Y-m-d H:i:s');
		$this->data["page_head"]  =   $this->lang->line('BLOG_CAT_ADD_TITLE');
		$this->data["page_title"] =  $this->lang->line('BLOG_CAT_ADD_TITLE');
		$this->data["page_view"]  =  $this->lang->line('BLOG_CAT_TITLE');
		
		$this->data["formdata"] = array(
				"category_id" => "",
				"category_name" => "",
				"slug" => "",
				"parent_id" => "",
				"category_description" => "",
				"status" => "active",
				"created_date"=>"",
				"modified_date"=>"",
				"slider"=> '',
				"card"=> '',
				"is_display_on_sitemap"=> "yes",
				"display_order"=>"",
				
				);

		$this->form_validation->set_rules("category_name","category_name","required");
		$this->form_validation->set_rules('check_dups', 'category_name', 'callback_check_dups');

		if ($this->form_validation->run() == TRUE)
		{ 
			$id = $this->blogcategorymodel->insert_record();
			$this->session->set_userdata('succe','1');
			redirect('admin/blogcategory');
			
			
		}
		$catname = $this->input->post("category_name");
		if(isset($catname) && !empty($catname))
		{
				$this->data["formdata"] = array(
					"category_id" => "",
					"slug" =>$this->input->post("slug"),
					"category_name" => $this->input->post("category_name"),
					"parent_id" => $this->input->post("parent_id"),
					"category_description" => $this->input->post("category_description"),
					"status" => $this->input->post("status"),
					"slider"=> $this->input->post("slider"),
					"card"=> $this->input->post("card"),
					"display_order"=> $this->input->post("display_order"),
					"is_display_on_sitemap"=>$this->input->post("is_display_on_sitemap"),
					"created_date"=> $createddate,
					"modified_date"=> $createddate
					);
		
		}
		$this->data['displayorder']  = $this->blogcategorymodel->displayorder();
		$this->data['productcatdata'] = $this->blogcategorymodel->getproductcat();
		$this->data['sliderinfo'] = $this->blogcategorymodel->getsliderinfo();
		$this->data['sliderinfo'] = $this->blogcategorymodel->getsliderinfo();
	
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/blogcategory/add",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function edit()
	{	
		$this->data["page_head"]  =   $this->lang->line('BLOG_CAT_EDIT_TITLE');
		$this->data["page_title"] =  $this->lang->line('BLOG_CAT_EDIT_TITLE');
		$this->data["page_view"]  =  $this->lang->line('BLOG_CAT_TITLE');
		
		$this->data["formdata"] = $this->blogcategorymodel->single_productcategorydata($this->input->get("id"));
		$this->data['productcatdata'] = $this->blogcategorymodel->getproductcat();
		$this->data['productinfocatname'] = $this->blogcategorymodel->getproductinfocatname($this->input->get("id"));
		$this->data['sliderinfo'] = $this->blogcategorymodel->getsliderinfo();
		
		$this->data['displayorder'] = $this->blogcategorymodel->displayorder();
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/blogcategory/edit",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function update($id='')
	{

		$this->form_validation->set_rules("category_name","category_name","required");
		$this->form_validation->set_rules('check_dups', 'category_name', 'callback_check_dups');
		$this->data['sliderinfo'] = $this->blogcategorymodel->getsliderinfo();
		if ($this->form_validation->run() == TRUE)
		{ 
			
			$this->blogcategorymodel->update_record($this->input->post('blog_cat_id'));
			$this->session->set_userdata('updatescc','1');
			redirect('admin/blogcategory');
		}
		
		
	}
	
	function update_status($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
		
			$this->blogcategorymodel->update_statusm($id);
			$this->session->set_flashdata('succ_update','1');
			redirect('admin/blogcategory');
		}
		else
		{
			redirect('admin/blogcategory');
		}
	}
	function update_status_activeall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg=$this->blogcategorymodel->update_statusactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_active','1');
			redirect('admin/blogcategory');
		}
		else
		{
			redirect('admin/blogcategory');
		}
	}
	function update_status_inactiveall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg=$this->blogcategorymodel->update_statusinactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_inactive','1');
			redirect('admin/blogcategory');
		}
		else
		{
			redirect('admin/blogcategory');
		}
	}
	
	function delete($id='')
	{
	
		$id =$this->input->get('id');
		
		if(!empty($id)){
			$msg =$this->blogcategorymodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/blogcategory');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->blogcategorymodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/blogcategory');
		}
		else
		{
			redirect('admin/blogcategory');
		}
	}
	
	function check_dups()
	{ 

		$this->db->where("category_name",$this->input->post("category_name"));

		if($this->input->post("blog_cat_id")){$this->db->where('category_id !=',$this->input->post("blog_cat_id"));}

		$query = $this->db->get("blog_categories");

		if($query->num_rows()==0) return true;

		else{
			$this->form_validation->set_message('check_dups',"Alias already exists");
			return false;
		}

	}
	
}

?>