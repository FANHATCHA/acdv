<?php 
class Countdown extends CI_controller{
	
	function Countdown()
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
		
		
		$this->load->model("admin/countdownmodel");
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');

	}

	function index()
	{	
		
		$this->data["page_title"] = $this->lang->line('COUNTDOWN_TITLES');
		$this->data["page_head"]= $this->lang->line('COUNTDOWN_TITLES');
		
		$this->data["tagsdata"] = $this->countdownmodel->getcountdowndata();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/countdown/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	
	function add()
	{	
		$this->data["page_head"]  =   $this->lang->line('ADD_TITLE_COUNTDOWN');
		$this->data["page_title"] =  $this->lang->line('COUNTDOWN_ADD_TITLE');
		$this->data["page_view"]  =  $this->lang->line('COUNTDOWN_ADD_TITLE');
		
		$this->data["formdata"] = array(
					"title" => "",
					"rating" => "",
					"promoting_offers" => "",
					"description" => "",
					"product_id" => "",
					"start_date" => "",
					"end_date" =>"",
					"type" => "",
					"ids" => "",
					"status" => "active"
				);

		if($this->input->post("title"))
		{
			
			$this->form_validation->set_rules("title","title","required");
			//$this->form_validation->set_rules("type","type","required");
			$this->form_validation->set_rules("start_date","start_date","required");
			$this->form_validation->set_rules("end_date","end_date","required");
			//$this->form_validation->set_rules('check_dups', 'title', 'callback_check_dups');
			
			if ($this->form_validation->run() == TRUE)
			{ 
				$id = $this->countdownmodel->insert_record();
				$this->session->set_userdata('success','1');
				redirect('admin/countdown');
			}
			
			$this->data["formdata"] = array(
					"title" => $this->input->post("title"),
					"rating" => $this->input->post("rating"),
					"promoting_offers" => $this->input->post("promoting_offers"),
					"description" => $this->input->post("description"),
					"product_id" => $this->input->post("product_id"),
					"start_date" => $this->input->post("start_date"),
					"end_date" =>$this->input->post("end_date"),
					"type" => $this->input->post("type"),
					"ids" => $this->input->post("ids"),
					"status" => $this->input->post("status")
				);
			
		}
		
		$this->data["destinationdata"] = $this->countdownmodel->fetchCategoryTree();
		$this->data["productdata"]     = $this->countdownmodel->getallProdcuct();
		$this->data["product"]    	   = $this->countdownmodel->getallProdcuct();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/common/header",$this->data);
		$this->load->view("admin/countdown/add",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function edit()
	{	
		$this->data["page_head"]  =   $this->lang->line('EDIT_TITLE_COUNTDOWN');
		$this->data["page_title"] =  $this->lang->line('COUNTDOWN_EDIT_TITLE');
		$this->data["page_view"]  =  $this->lang->line('COUNTDOWN_EDIT_TITLE');
		
		$this->data["formdata"] = $this->countdownmodel->single_countdownloaddata($this->input->get("id"));
		$this->data["countdownname"] = $this->countdownmodel->getcountdownname($this->input->get("id"));
		
		$this->data["destinationdata"] = $this->countdownmodel->fetchCategoryTree();
		$this->data["productdata"]     = $this->countdownmodel->getallProdcuct();
		$this->data["product"]    	   = $this->countdownmodel->getallProdcuct();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/countdown/edit",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function update($id='')
	{

		$this->form_validation->set_rules("title","title","required");
		$this->form_validation->set_rules("start_date","start_date","required");
		$this->form_validation->set_rules("end_date","end_date","required");
		//$this->form_validation->set_rules("type","type","required");
		//$this->form_validation->set_rules('check_dups', 'title', 'callback_check_dups');
		
			
		if ($this->form_validation->run() == TRUE)
		{ 
		
			$this->countdownmodel->update_record($this->input->post('coutdown_id'));
			$this->session->set_userdata('updatescc','1');
			redirect('admin/countdown');
		}
		
		
	}
	
	function update_status($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
		
			$this->countdownmodel->update_statusm($id);
			$this->session->set_flashdata('succ_update','1');
			redirect('admin/countdown');
		}
		else
		{
			redirect('admin/countdown');
		}
	}
	function update_status_activeall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg= $this->countdownmodel->update_statusactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_active','1');
			redirect('admin/countdown');
		}
		else
		{
			redirect('admin/countdown');
		}
	}
	function update_status_inactiveall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg= $this->countdownmodel->update_statusinactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_inactive','1');
			redirect('admin/countdown');
		}
		else
		{
			redirect('admin/countdown');
		}
	}
	
	function delete($id='')
	{
	
		$id =$this->input->get('id');
		
		if(!empty($id)){
			$msg =$this->countdownmodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/countdown');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->countdownmodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/countdown');
		}
		else
		{
			redirect('admin/countdown');
		}
	}
	
	function check_dups()
	{ 
	

		$this->db->where("title",$this->input->post("title"));

		if($this->input->post("coutdown_id")){
		
			$this->db->where('id !=',$this->input->post("coutdown_id"));
			
		}
		$query = $this->db->get("countdown");

		if($query->num_rows()==0) return true;

		else{
			$this->form_validation->set_message('check_dups',"Name already exists");
			return false;
		}

	}
	
}

?>