<?php 
class Product_category extends CI_controller{
	
	function Product_category()
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
		
		
		$this->load->model("admin/productcategorymodel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
	}

	function index()
	{	
		
		$this->data["page_title"] = $this->lang->line('PRO_CAT_TITLE');
		$this->data["page_head"]= $this->lang->line('PRO_CAT_TITLE');
		
		$this->data["productcategorydata"] = $this->productcategorymodel->getproductcatdata();
		
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/product_category/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	
	function add()
	{	
		$createddate = date('Y-m-d H:i:s');
		$this->data["page_head"]  =   $this->lang->line('PRO_CAT_ADD_TITLE');
		$this->data["page_title"] =  $this->lang->line('PRO_CAT_ADD_TITLE');
		$this->data["page_view"]  =  $this->lang->line('PRO_CAT_TITLE');
		
		$this->data["formdata"] = array(
				"category_id" => "",
				"category_name" => "",
				"h1_name" => "",
				"slug" => "",
				"user_details_id" => "",
				"rewrite_url" => "",
				"parent_id" => "",
				"category_description" => "",
				"slider_id" => "",
				"info_usefull" => "",
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
		$this->form_validation->set_rules('check_dups', 'category_name', 'callback_check_dups');

		if ($this->form_validation->run() == TRUE)
		{ 
			$id = $this->productcategorymodel->insert_record();
			$this->session->set_userdata('succe','1');
			redirect('admin/product_category');
			
			
		}
		$catname = $this->input->post("category_name");
		if(isset($catname) && !empty($catname))
		{
				$this->data["formdata"] = array(
					"category_id" => "",
					"category_name" => $this->input->post("category_name"),
					"h1_name" => $this->input->post("h1_name"),
					"slug" => $this->input->post("slug"),
					"user_details_id" => $this->input->post("user_details_id"),
					"parent_id" => $this->input->post("parent_id"),
					"category_description" => $this->input->post("category_description"),
					"slider_id" => $this->input->post("slider_id"),
					"status" => $this->input->post("status"),
					"info_usefull" => $this->input->post("info_usefull"),
					"created_date"=> $createddate,
					"modified_date"=> $createddate,
					"is_seo"=> $this->input->post("is_seo"),
					"rewrite_url" => $this->input->post("rewrite_url"),
					"meta_title"=> $this->input->post("meta_title"),
					"robots" => $this->input->post("robots"),
					"rel"=> $this->input->post("rel"),
					"display_order"=> $this->input->post("display_order"),
					"is_display_on_sitemap"=>$this->input->post("is_display_on_sitemap"),
					"meta_keyword"=> $this->input->post("meta_keyword"),
					"meta_description"=> $this->input->post("meta_description")
					);
		
		}
		
		
		$this->data['displayorder']  = $this->productcategorymodel->displayorder();
		$this->data['productcatdata'] = $this->productcategorymodel->getproductcat();
		$this->data['bannerid'] = $this->productcategorymodel->getbannerid();
		$this->data["productdata"]     = $this->productcategorymodel->getallProdcuct();
		$this->data["usefull_links"]     = $this->productcategorymodel->getusefullLink();
		$this->data["userdetailsdata"]     = $this->productcategorymodel->getuserdetails();
		$this->data["relattributes"]     = $this->productcategorymodel->getrelattributes();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/product_category/add",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function edit()
	{	
		$this->data["page_head"]  =   $this->lang->line('PRO_CAT_TITLE');
		$this->data["page_title"] =  $this->lang->line('PRO_CAT_EDIT_TITLE');
		$this->data["page_view"]  =  $this->lang->line('PRO_CAT_EDIT_TITLE');
		
		$this->data["formdata"] = $this->productcategorymodel->single_productcategorydata($this->input->get("id"));
		$this->data['productcatdata'] = $this->productcategorymodel->getproductcat();
		$this->data['bannerid'] = $this->productcategorymodel->getbannerid();
		$this->data['productcatname'] = $this->productcategorymodel->getproductcatname($this->input->get("id"));
		$this->data["productdata"]     = $this->productcategorymodel->getallProdcuct();
		$this->data["usefull_links"]     = $this->productcategorymodel->getusefullLink();
		$this->data["relattributes"]     = $this->productcategorymodel->getrelattributes();
		$this->data["userdetailsdata"]     = $this->productcategorymodel->getuserdetails();
		
		$this->data['displayorder'] = $this->productcategorymodel->displayorder();
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/product_category/edit",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function update($id='')
	{

		$this->form_validation->set_rules("category_name","category_name","required");
		$this->form_validation->set_rules('check_dups', 'category_name', 'callback_check_dups');
		
		if ($this->form_validation->run() == TRUE)
		{ 
			
			$this->productcategorymodel->update_record($this->input->post('pro_cat_id'));
			$this->productcategorymodel->updateproductcat($this->input->post('product'));
			$this->session->set_userdata('updatescc','1');
			redirect('admin/product_category');
		}
		
		
	}
	
	function update_status($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
		
			$this->productcategorymodel->update_statusm($id);
			$this->session->set_flashdata('succ_update','1');
			redirect('admin/product_category');
		}
		else
		{
			redirect('admin/product_category');
		}
	}
	function update_status_activeall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg=$this->productcategorymodel->update_statusactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_active','1');
			redirect('admin/product_category');
		}
		else
		{
			redirect('admin/product_category');
		}
	}
	function update_status_inactiveall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg=$this->productcategorymodel->update_statusinactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_inactive','1');
			redirect('admin/product_category');
		}
		else
		{
			redirect('admin/product_category');
		}
	}
	
	function delete($id='')
	{
	
		$id =$this->input->get('id');
		
		if(!empty($id)){
			$msg =$this->productcategorymodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/product_category');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->productcategorymodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/product_category');
		}
		else
		{
			redirect('admin/product_category');
		}
	}
	
	function check_dups()
	{ 

		$this->db->where("category_name",$this->input->post("category_name"));

		if($this->input->post("pro_cat_id")){$this->db->where('category_id !=',$this->input->post("pro_cat_id"));}

		$query = $this->db->get("products_categories");

		if($query->num_rows()==0) return true;

		else{
			$this->form_validation->set_message('check_dups',"Title already exists");
			return false;
		}

	}
	
}

?>