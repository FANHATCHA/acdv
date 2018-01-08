<?php 
class Product extends CI_controller{
	
	function Product()
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
		
		$this->load->model("admin/productmodel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
		
	}

	function index()
	{	
		
		$this->data["page_title"] = $this->lang->line('PRO_TITLE_MAIN');
		$this->data["page_head"]= $this->lang->line('PRO_TITLE_MAIN');
		
		$this->data["productdata"] = $this->productmodel->getproductdata();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/product/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	
	function add()
	{	
		$createddate = date('Y-m-d H:i:s');
		$this->data["page_head"]  =   $this->lang->line('PRO_ADD_TITLE');
		$this->data["page_title"] =  $this->lang->line('PRO_ADD_TITLE');
		$this->data["page_view"]  =  $this->lang->line('PRO_TITLE');
		
		$this->data["formdata"] = array(
					"id" => "",
					"product_name" => "",
					"slug" => "",
					"short_point" => "",
					"content" => "",
					"map_link" => "",
					"presentation" => "",
					"route" => "",
					"hotel" => "",
					"budget" => "",
					"special_offers"=> "",
					"reviews" => "",
					"short_description" => "",
					"price"=> "",
					"number_of_nights"=> "",
					"type"=> "",
					"subtitle"=> "",
					"slider_id"=> "",
					"you_will_appreciate"=> "",
					"authentic_experience"=> "",
					"golf"=> "",
					"link_travel_notebook"=> "",
					"image_title_sidebar"=> "",
					"tags"=> "",
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
		
		$this->form_validation->set_rules("product_name","product_name","required");
		$this->form_validation->set_rules('check_dups', 'product_name', 'callback_check_dups');

		if ($this->form_validation->run() == TRUE)
		{ 
			$id = $this->productmodel->insert_record();
			$this->session->set_userdata('succe','1');
			redirect('admin/product');
			
			
		}
		$proname = $this->input->post("product_name");
		if(isset($proname) && !empty($proname))
		{
			
				$data= array(
					"product_name" => $this->input->post("product_name"),
					"slug" => $this->input->post("slug"),
					"content" => $this->input->post("content"),
					"short_point" => $this->input->post("short_point"),
					"map_link" => $this->input->post("map_link"),
					"presentation" => $this->input->post("presentation"),
					"route" => $this->input->post("route"),
					"hotel" => $this->input->post("hotel"),
					"budget" => $this->input->post("budget"),
					"special_offers"=> $this->input->post("special_offers"),
					"reviews" => $this->input->post("reviews"),
					"short_description" => $this->input->post("short_description"),
					"price"=> $this->input->post("price"),
					"number_of_nights"=> $this->input->post("number_of_nights"),
					"type"=> $this->input->post("type"),
					"subtitle"=> $this->input->post("subtitle"),
					"slider_id"=> $this->input->post("slider_id"),
					"you_will_appreciate"=> $this->input->post("you_will_appreciate"),
					"authentic_experience"=> $this->input->post("authentic_experience"),
					"golf"=> $this->input->post("golf"),
					"link_travel_notebook"=> $this->input->post("link_travel_notebook"),
					"image_title_sidebar"=> $this->input->post("image_title_sidebar"),
					"tags"=> $this->input->post("tags"),
					"categories"=> $this->input->post("categories"),
					"status"=> $this->input->post("status"),
					"is_display_on_sitemap"=> $this->input->post("is_display_on_sitemap"),
					"is_seo"=> $this->input->post("is_seo"),
					"display_order"=> $this->input->post("display_order"),
					"rewrite_url"=> $this->input->post("rewrite_url"),
					"meta_title"=> $this->input->post("meta_title"),
					"robots" => $this->input->post("robots"),
					"rel"=> $this->input->post("rel"),
					"meta_keyword"=> $this->input->post("meta_keyword"),
					"meta_description"=> $this->input->post("meta_description")
				);
		
		}
		
		
		$this->data['displayorder']  = $this->productmodel->displayorder();
		$this->data['productdata']   = $this->productmodel->getproduct();
		
		$this->data['productcatdata']  = $this->productmodel->getproductcatdata();
		$this->data["relattributes"]     = $this->productmodel->getrelattributes();
		
		
		//$this->data['tagsdata']		 = $this->productmodel->gettags();
		$this->data['tagsprimarydata']		 = $this->productmodel->getprimarytags();
		$this->data['tagssecondarydata']	 = $this->productmodel->getsecondarytags();
		
		
		
		$this->data["userdetailsdata"]     = $this->productmodel->getuserdetails();
		$this->data['bannerid'] 	 = $this->productmodel->getbannerid();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/product/add",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function edit()
	{	
		$this->data["page_head"]  =   $this->lang->line('PROEDIT_TITLE');
		$this->data["page_title"] =  $this->lang->line('PROEDIT_TITLE');
		$this->data["page_view"]  =  $this->lang->line('PRO_TITLE');
		
		$this->data["formdata"] = $this->productmodel->single_productdata($this->input->get("id"));
		
		$this->data['displayorder']  = $this->productmodel->displayorder();
		$this->data['productdata']   = $this->productmodel->getproduct();
		$this->data['productcatdata']  = $this->productmodel->getproductcatdata();
		
		//$this->data['tagsdata']		 = $this->productmodel->gettags();
		$this->data['tagsprimarydata']		 = $this->productmodel->getprimarytags();
		$this->data['tagssecondarydata']	 = $this->productmodel->getsecondarytags();
		
		$this->data['selected_primary_tag']		 = $this->productmodel->getselectedprimarytags($this->input->get("id"));
		$this->data['selected_secoundry_tag']	 = $this->productmodel->getselectedsecondarytags($this->input->get("id"));
		
		$this->data['bannerid'] 	 = $this->productmodel->getbannerid();
		$this->data['productnames'] 	 = $this->productmodel->getproductname($this->input->get("id"));
		$this->data["relattributes"]     = $this->productmodel->getrelattributes();
		$this->data["userdetailsdata"]     = $this->productmodel->getuserdetails();
		
		$this->data['displayorder'] = $this->productmodel->displayorder();
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/product/edit",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function update($id='')
	{
		$this->form_validation->set_rules("product_name","product_name","required");
		$this->form_validation->set_rules('check_dups', 'product_name', 'callback_check_dups');
		
		 
		if ($this->form_validation->run() == TRUE)
		{ 
			$this->productmodel->update_record($this->input->post('pro_id'));
			$this->session->set_userdata('updatescc','1');
			redirect('admin/product');
		}
		
		
	}
	
	function update_status($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
		
			$this->productmodel->update_statusm($id);
			$this->session->set_flashdata('succ_update','1');
			redirect('admin/product');
		}
		else
		{
			redirect('admin/product');
		}
	}
	function update_status_activeall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg=$this->productmodel->update_statusactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_active','1');
			redirect('admin/product');
		}
		else
		{
			redirect('admin/product');
		}
	}
	function update_status_inactiveall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg=$this->productmodel->update_statusinactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_inactive','1');
			redirect('admin/product');
		}
		else
		{
			redirect('admin/product');
		}
	}
	
	function delete($id='')
	{
	
		$id =$this->input->get('id');
		
		if(!empty($id)){
			$msg =$this->productmodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/product');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->productmodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/product');
		}
		else
		{
			redirect('admin/product');
		}
	}
	
	
	
	function check_dups()
	{ 
		
		$this->db->where("product_name",$this->input->post("product_name"));

		if($this->input->post("pro_id")){$this->db->where('id !=',$this->input->post("pro_id"));}

		$query = $this->db->get("products");

		if($query->num_rows()==0) return true;

		else{
			$this->form_validation->set_message('check_dups',"Title already exists");
			return false;
		}

	}
	
}

?>