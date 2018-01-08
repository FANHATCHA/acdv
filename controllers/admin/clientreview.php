<?php 
class Clientreview extends CI_controller{
	
	function Clientreview()
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
		
		
		$this->load->model("admin/clientreviewmodel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
	}

	function index()
	{	
		
		$this->data["page_title"] = $this->lang->line('CLIENT_REVIEW_TITLE');
		$this->data["page_head"]= $this->lang->line('CLIENT_REVIEW_TITLE');
		
		$this->data["clientreviewdata"] = $this->clientreviewmodel->getcustomerreviewdata();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/clientreview/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	
	function add()
	{	
		$this->data["page_head"]  =   $this->lang->line('CLIENT_REVIEW_ADD_TITLE');
		$this->data["page_title"] =  $this->lang->line('CLIENT_REVIEW_ADD_TITLE');
		$this->data["page_view"]  =  $this->lang->line('CLIENT_REVIEW_ADD_TITLE');
		
			$this->data["formdata"] = array(
				"id" => "",
				"name" => "",
				"thems_name" => "",
				"review_date" => "",
				"destination_id" => "",
				"client_review" => "",
				"client_rating" => "",
				"clientreview_clickble" => "no",
				"status" => "active"
				);

		
			$this->form_validation->set_rules("name","name","required");
			$this->form_validation->set_rules("client_review","client_review","required");
			if ($this->form_validation->run() == TRUE)
			{ 
				
				$id = $this->clientreviewmodel->insert_record();
				$this->session->set_userdata('succe','1');
				redirect('admin/clientreview');
			}
			$name = $this->input->post("name");
			if(isset($name) && !empty($name))
			{
				$this->data["formdata"] = array(
				"id" => "",
				"name" => $this->input->post("name"),
				"thems_name" => $this->input->post("thems_name"),
				"review_date" => $this->input->post("review_date"),
				"destination_id" => $this->input->post("destination_id"),
				"client_review" => $this->input->post("client_review"),
				"client_rating" => $this->input->post("client_rating"),
				"clientreview_clickble" => $this->input->post("clientreview_clickble"),
				"status" =>$this->input->post("status")
				);
			}	
		$this->data['productcatdata'] = $this->clientreviewmodel->getproductcat();	
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/clientreview/add",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function edit()
	{	
		$this->data["page_head"]  =   $this->lang->line('CLIENT_REVIEW_ADD_TITLE');
		$this->data["page_title"] =  $this->lang->line('CLIENT_REVIEW_EDIT_TITLE');
		$this->data["page_view"]  =  $this->lang->line('CLIENT_REVIEW_TITLE');
		
		$this->data["formdata"] = $this->clientreviewmodel->single_clientreview($this->input->get("id"));
		$this->data["cmspagename"] = $this->clientreviewmodel->getclientreviewname($this->input->get("id"));
		$this->data['productcatdata'] = $this->clientreviewmodel->getproductcat();	
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/clientreview/edit",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function update($id='')
	{

		$this->form_validation->set_rules("name","name","required");
		$this->form_validation->set_rules("client_review","client_review","required");
			
		if ($this->form_validation->run() == TRUE)
		{ 
			$this->clientreviewmodel->update_record($this->input->post('id'));
			$this->session->set_userdata('updatescc','1');
			redirect('admin/clientreview');
		}
		
		
	}
	
	function update_status($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
		
			$this->clientreviewmodel->update_statusm($id);
			$this->session->set_flashdata('succ_update','1');
			redirect('admin/clientreview');
		}
		else
		{
			redirect('admin/clientreview');
		}
	}
	function update_status_activeall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg= $this->clientreviewmodel->update_statusactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_active','1');
			redirect('admin/clientreview');
		}
		else
		{
			redirect('admin/clientreview');
		}
	}
	function update_status_inactiveall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg=$this->clientreviewmodel->update_statusinactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_inactive','1');
			redirect('admin/clientreview');
		}
		else
		{
			redirect('admin/clientreview');
		}
	}
	
	function delete($id='')
	{
	
		$id =$this->input->get('id');
		
		if(!empty($id)){
			$msg =$this->clientreviewmodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/clientreview');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->clientreviewmodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/clientreview');
		}
		else
		{
			redirect('admin/clientreview');
		}
	}
	
	function check_dups()
	{ 
		$this->db->where("name",$this->input->post("name"));
		if($this->input->post("id")){$this->db->where('id !=',$this->input->post("id"));}
		$query = $this->db->get("clientreview");
		if($query->num_rows()==0) return true;
		else{
			$this->form_validation->set_message('check_dups',"Title already exists");
			return false;
		}
	}
	
	function updatereviewinhomepage()
	{
		$id =$this->input->get('id');
		$this->clientreviewmodel->updatereviewinhomepage($id);
		redirect('admin/clientreview');
	}
	
}

?>