<?php 
class Menu extends CI_controller{
	
	function Menu()
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
		
		$this->load->model("admin/menumodel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
	}

	function index()
	{	
		
		$this->data["page_title"] = $this->lang->line('MENU_TITLE');
		$this->data["page_head"]  = $this->lang->line('MENU_TITLE');
		
		$this->data["menudata"]  = $this->menumodel->getmenudata();
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/menu/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	
	function add()
	{	
		$this->data["page_head"]  =   $this->lang->line('ADD_TITLE_MENU');
		$this->data["page_title"] =  $this->lang->line('MENU_ADD_TITLE');
		$this->data["page_view"]  =  $this->lang->line('MENU_ADD_TITLE');
		
		
		$this->data["formdata"] = array(
				"id" => "",
				"menu_title" => "",
				"status" =>"active"
				);

		
			$this->form_validation->set_rules("menu_title","menu_title","required");
			$this->form_validation->set_rules('check_dups', 'menu_title', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 
				
				$id = $this->menumodel->insert_record();
				$this->session->set_userdata('succe','1');
				redirect('admin/menu');
			}
			$menu_title = $this->input->post("menu_title");
			if(isset($menu_title) && !empty($menu_title))
			{
				$this->data["formdata"] = array(
				"id" => "",
				"menu_title" => $this->input->post("menu_title"),
				"status" => $this->input->post("status")
				);
			}	
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/menu/add",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function edit()
	{	
		$this->data["page_head"]  =   $this->lang->line('EDIT_TITLE_MENU');
		$this->data["page_title"] =  $this->lang->line('MENU_EDIT_TITLE');
		$this->data["page_view"]  =  $this->lang->line('MENU_EDIT_TITLE');
		
		$this->data["formdata"] = $this->menumodel->single_menudata($this->input->get("id"));
		$this->data["menuname"] = $this->menumodel->getmenuname($this->input->get("id"));
				
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/menu/edit",$this->data);
		$this->load->view("admin/common/footer",$this->data);
	}
	
	function update($id='')
	{

		$this->form_validation->set_rules("menu_title","menu_title","required");
		$this->form_validation->set_rules('check_dups', 'menu_title', 'callback_check_dups');
			
		if ($this->form_validation->run() == TRUE)
		{ 
			$this->menumodel->update_record($this->input->post('menu_id'));
			$this->session->set_userdata('updatescc','1');
			redirect('admin/menu');
		}
		
		
	}
	
	function update_status($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
		
			$this->menumodel->update_statusm($id);
			$this->session->set_flashdata('succ_update','1');
			redirect('admin/menu');
		}
		else
		{
			redirect('admin/menu');
		}
	}
	function update_status_activeall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg= $this->menumodel->update_statusactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_active','1');
			redirect('admin/menu');
		}
		else
		{
			redirect('admin/menu');
		}
	}
	function update_status_inactiveall()
	{
		if(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg=$this->menumodel->update_statusinactive($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_inactive','1');
			redirect('admin/menu');
		}
		else
		{
			redirect('admin/menu');
		}
	}
	
	function delete($id='')
	{
	
		$id =$this->input->get('id');
		
		if(!empty($id)){
			$msg =$this->menumodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/menu');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->menumodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/menu');
		}
		else
		{
			redirect('admin/menu');
		}
	}
	
	function check_dups()
	{ 

		$this->db->where("menu_title",$this->input->post("menu_title"));

		if($this->input->post("menu_id")){$this->db->where('id !=',$this->input->post("menu_id"));}

		$query = $this->db->get("menu");

		if($query->num_rows()==0) return true;

		else{
			$this->form_validation->set_message('check_dups',"Title already exists");
			return false;
		}

	}
	
}

?>