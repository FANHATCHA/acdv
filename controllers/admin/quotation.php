<?php 
class quotation extends CI_controller{
	
	function quotation()
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
		
		$this->load->model("admin/quotationmodel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('pagination');
		$session_data = $this->session->userdata('admin_session');
		if(!isset($session_data) || empty($session_data))redirect('admin/login');
	}

	function index()
	{
		
		$this->data["page_title"] = $this->lang->line('QUOTATION_TITLE');
		$this->data["page_head"]= $this->lang->line('QUOTATION_TITLE');
		
		$search = '';
		$search = $this->input->get('search');
		
		
		$total_row						= $this->quotationmodel->gettotalquotationdata($search);
		$config['use_page_numbers'] 	= TRUE;
		$config['base_url']		    	= $this->config->site_url().'/admin/quotation?search=';
		$config['total_rows']	    	= $total_row;
		$config['per_page'] 			= $this->lang->line('QUOTATION_LIMIT');
		$config['num_links']			= 5;
		$config['num_tag_open'] 		= '<li>';
		$config['num_tag_close'] 		= '</li>';
		$config['cur_tag_open'] 		= '&nbsp;<li class="active"><a >';
        $config['cur_tag_close'] 		= '</a></li>';
		$config['first_tag_open'] 		= '<li>';
		$config['first_tag_close']		= '</li>';
		$config['last_tag_open'] 		= '<li>';
		$config['last_tag_close']		= '</li>';
		$config['prev_tag_open'] 		= '<li>';
		$config['prev_tag_close']		= '</li>';
		$config['next_tag_open'] 		= '<li>';
		$config['next_tag_close']		= '</li>';
        $config['next_link']			= '<i class="fa fa-angle-right"></i>';
        $config['prev_link'] 			= '<i class="fa fa-angle-left"></i>';
		$this->pagination->initialize($config);
		
		$pages = $this->input->get('page', TRUE);
		if (isset($pages) && !empty($pages)) { $page  = $pages; } else { $page=1; };  
		$start_from = ($page-1) * $this->lang->line('QUOTATION_LIMIT'); 
		
		$nextpage = $page + 1;
		$prevpage = $page - 1;
		
		$this->data["quotationdata"] = $this->quotationmodel->getquotationdata($config["per_page"],$start_from,$search);
		$str_links 			  	    = $this->pagination->create_links();
		$this->data["links"]   	    = explode('&nbsp;',$str_links );
		$this->data["current_page"] = $page;
		$this->data["search_val"]   = $search;
		
		$cur_page_p = $this->pagination->cur_page;
		
		$start_p 				= $cur_page_p * $this->pagination->per_page;
		$this->data["p_start"]  = $cur_page_p * $this->pagination->per_page;
		$this->data["p_end"] 	= $start_p + $this->pagination->per_page;
		$this->data["p_total"]  = $this->pagination->total_rows;
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/quotation/list",$this->data);
		$this->load->view("admin/common/footer");
	}
	function view_from($id='')
	{
		$this->data["page_title"] = $this->lang->line('QUOTATION_TITLE');
		$this->data["page_head"]= $this->lang->line('QUOTATION_TITLE');
		
		$id =$this->input->get('id');
		$this->data["formdata"] = $this->quotationmodel->getsingleformdata($id);
		
		$this->load->view("admin/common/header",$this->data);
		$this->data['left_nav']=$this->load->view('admin/common/leftmenu',$this->data,true);	
		$this->load->view("admin/quotation/view_form.php",$this->data);
		$this->load->view("admin/common/footer");
	}
	function delete($id='')
	{
		$id =$this->input->get('id');
		if(!empty($id)){
			$msg =$this->quotationmodel->delete_record($id);
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/quotation');
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				$msg =$this->quotationmodel->delete_record($val);
				if($msg==2) break;
			}
			$this->session->set_flashdata('succ_delete','1');
			redirect('admin/quotation');
		}
		else
		{
			redirect('admin/quotation');
		}
	}
	
}

?>