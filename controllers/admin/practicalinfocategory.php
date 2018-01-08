<?php 
class Practicalinfocategory extends CI_controller{
	
	function Practicalinfocategory()
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
		
		$this->load->model("admin/practicalinfocategorymodel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
	}

	function index()
	{	
		
		$this->data["page_title"] = $this->lang->line('PROINFO_CAT_TITLE');
		$this->data["page_head"]= $this->lang->line('PROINFO_CAT_TITLE');
		
		$this->data["productcategorydata"] = $this->practicalinfocategorymodel->getproductcatlistdata();
		
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/practicalinfocategory/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	
	function add()
	{	
		$createddate = date('Y-m-d H:i:s');
		$this->data["page_head"]  =   $this->lang->line('PROINFO_CAT_ADD_TITLE');
		$this->data["page_title"] =  $this->lang->line('PROINFO_CAT_ADD_TITLE');
		$this->data["page_view"]  =  $this->lang->line('PROINFO_CAT_TITLE');
		
		$this->data["formdata"] = array(
				"category_id" => "",
				"category_name" => "",
				"slug" => "",
				"rewrite_url" => "",
				"parent_id" => "",
				"category_description" => "",
				"status" => "active",
				"created_date"=>"",
				"modified_date"=>"",
				"is_display_on_sitemap"=> "yes",
				"display_order"=>"",
				"is_seo"=>"active",
				"meta_title"=>"",
				"meta_keyword"=>"",
				"robots" => "no",
				"rel"=> "",
				"canonical_url"=> "",
				"meta_description"=>""
				);

		$this->form_validation->set_rules("category_name","category_name","required");
		//$this->form_validation->set_rules("alias","alias","required");
		//$this->form_validation->set_rules('check_dups', 'alias', 'callback_check_dups');

		if ($this->form_validation->run() == TRUE)
		{ 
			$id = $this->practicalinfocategorymodel->insert_record();
			$this->session->set_userdata('succe','1');
			redirect('admin/practicalinfocategory');
			
			
		}
		$catname = $this->input->post("category_name");
		if(isset($catname) && !empty($catname))
		{
				$this->data["formdata"] = array(
					"category_id" => "",
					"category_name" => $this->input->post("category_name"),
					"slug" => $this->input->post("slug"),
					"parent_id" => $this->input->post("parent_id"),
					"category_description" => $this->input->post("category_description"),
					"status" => $this->input->post("status"),
					"created_date"=> $createddate,
					"modified_date"=> $createddate,
					"is_seo"=> $this->input->post("is_seo"),
					"rewrite_url" => $this->input->post("rewrite_url"),
					"meta_title"=> $this->input->post("meta_title"),
					"display_order"=> $this->input->post("display_order"),
					"is_display_on_sitemap"=>$this->input->post("is_display_on_sitemap"),
					"meta_keyword"=> $this->input->post("meta_keyword"),
					"robots" => $this->input->post("robots"),
					"rel"=> $this->input->post("rel"),
					"meta_description"=> $this->input->post("meta_description")
					);
		
		}
		
		
		$this->data['displayorder']  = $this->practicalinfocategorymodel->displayorder();
		$this->data['productcatdata'] = $this->practicalinfocategorymodel->getproductcat();
		$this->data["relattributes"]     = $this->practicalinfocategorymodel->getrelattributes();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/practicalinfocategory/add",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function edit()
	{	
		$this->data["page_head"]  =   $this->lang->line('PROINFO_CAT_EDIT_TITLE');
		$this->data["page_title"] =  $this->lang->line('PROINFO_CAT_EDIT_TITLE');
		$this->data["page_view"]  =  $this->lang->line('PROINFO_CAT_TITLE');
		
		$this->data["formdata"] = $this->practicalinfocategorymodel->single_productcategorydata($this->input->get("id"));
		$this->data['productcatdata'] = $this->practicalinfocategorymodel->getproductcat();
		$this->data['productinfocatname'] = $this->practicalinfocategorymodel->getproductinfocatname($this->input->get("id"));
		$this->data["relattributes"]     = $this->practicalinfocategorymodel->getrelattributes();
		$this->data['displayorder'] = $this->practicalinfocategorymodel->displayorder();
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/practicalinfocategory/edit",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function update($id='')
	{

		$this->form_validation->set_rules("category_name","category_name","required");
		//$this->form_validation->set_rules("alias","alias","required");
		//$this->form_validation->set_rules('check_dups', 'alias', 'callback_check_dups');
		
		if ($this->form_validation->run() == TRUE)
		{ 
			
			$this->practicalinfocategorymodel->update_record($this->input->post('pro_cat_id'));
			$this->session->set_userdata('updatescc','1');
			redirect('admin/practicalinfocategory');
		}
		
		
	}
	
	function update_status($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
		
			$this->practicalinfocategorymodel->update_statusm($id);
			$this->session->set_flashdata('succ_update','1');
			redirect('admin/practicalinfocategory');
		}
		else
		{
			redirect('admin/practicalinfocategory');
		}
	}
	function update_status_activeall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg=$this->practicalinfocategorymodel->update_statusactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_active','1');
			redirect('admin/practicalinfocategory');
		}
		else
		{
			redirect('admin/practicalinfocategory');
		}
	}
	function update_status_inactiveall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg=$this->practicalinfocategorymodel->update_statusinactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_inactive','1');
			redirect('admin/practicalinfocategory');
		}
		else
		{
			redirect('admin/practicalinfocategory');
		}
	}
	
	function delete($id='')
	{
	
		$id =$this->input->get('id');
		
		if(!empty($id)){
			$msg =$this->practicalinfocategorymodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/practicalinfocategory');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->practicalinfocategorymodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/practicalinfocategory');
		}
		else
		{
			redirect('admin/practicalinfocategory');
		}
	}
	
	function check_dups()
	{ 

		$this->db->where("alias",$this->input->post("alias"));

		if($this->input->post("proinfo_cat_id")){$this->db->where('category_id !=',$this->input->post("proinfo_cat_id"));}

		$query = $this->db->get("practical_information_categories");

		if($query->num_rows()==0) return true;

		else{
			$this->form_validation->set_message('check_dups',"Alias already exists");
			return false;
		}

	}
	
}

?>