<?php
class Clientreview extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->model("clientreviewmodel");
		$this->load->model("homemodel");
		$this->load->helper("url");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library("email");
		//$this->lang->load('defines_front', 'english');
		$this->load->model("commonlibmodel");
		/*======================= LOAD COMMON LIBRARY ===================*/
		$this->load->library('commonlib');
		$this->load->library('pagination');
		/*======================= LOAD COMMON LIBRARY ===================*/
	}
	function view() 
	{
	
		$this->headerdata = $this->commonlib->headerdata();
		$this->footerdata = $this->commonlib->footerdata();
		
		$this->data['companyinfo'] 				= $this->homemodel->getcmsblock(15);
		$this->data['sidebarcontent'] 			= $this->homemodel->getcmsblock(17);
		$this->data["homeslider"]  				= $this->homemodel->gethomeslider(35);
		$this->data["reviewdate"]  				= $this->clientreviewmodel->getreviewdate();
		$this->data["reviewdestination"]  		= $this->clientreviewmodel->getclientreviewdestination();
		$pagemetadesc = $this->commonlibmodel->getmetadetails(93);
		if(isset($pagemetadesc['meta_title']) && !empty($pagemetadesc['meta_title']))
		{
			$pagetitle = $pagemetadesc['meta_title'] ;
		}
		else
		{
			$pagetitle = $pagemetadesc['cms_title'] ;
		}
		$this->headerdata["page_title"] = $pagetitle;
		$this->headerdata["page_head"]  = $pagetitle;
		$this->headerdata["meta_desc"]  = $pagemetadesc['meta_description'];
		$this->headerdata["meta_key"]   = $pagemetadesc['meta_keyword'];
		$this->headerdata["robots"]     = $pagemetadesc['robots'];
		
		
		$total_row						= $this->clientreviewmodel->gettotalclientreview($this->lang->line('CLIENT_REVIEW_LIMIT'));
		$config['base_url']		    	= $this->config->site_url().'lavis-de-nos-clients?page=';
		$config['total_rows']	    	= $total_row;
		$config['per_page'] 			= $this->lang->line('CLIENT_REVIEW_LIMIT');
		$config['num_links']			= $total_row;
		$config['cur_tag_open'] 		= '&nbsp;<a class="current">';
        $config['cur_tag_close'] 		= '</a>';
        $config['next_link']			= 'Next';
        $config['prev_link'] 			= 'Previous';
		$this->pagination->initialize($config);
		
		$pages = $this->input->get('page', TRUE);
		if (isset($pages) && !empty($pages)) { $page  = $pages; } else { $page=1; };  
		$start_from = ($page-1) * $this->lang->line('CLIENT_REVIEW_LIMIT'); 
		
		$nextpage = $page + 1;
		$prevpage = $page - 1;
		
		$filterbydate  = $this->input->get("date");
		$filterbydesti = $this->input->get("destination");
		$filtercondition = '';
		$this->data["filteroption"] = '';
		if(isset($filterbydate) && !empty($filterbydate) && empty($filterbydesti))
		{
			$explodemonthyear 	 = explode('-',$filterbydate);
			$filterbydatemonth 	= $explodemonthyear[0];
			$filterbydateyear  	= $explodemonthyear[1];
			$filtercondition   	= " AND MONTH(review_date) = '".$filterbydatemonth."' AND YEAR(review_date)= '".$filterbydateyear."'";
			$nextpage          .= "&date=".$filterbydate;
			$prevpage          .= "&date=".$filterbydate;
			$this->data["filteroption"] = "&date=".$filterbydate;
		}
		else if(isset($filterbydesti) && !empty($filterbydesti) && empty($filterbydate))
		{
			$filtercondition 	= " AND destination_id LIKE '%".$filterbydesti."%'";
			$nextpage          .="&destination=".$filterbydesti;
			$prevpage          .= "&destination=".$filterbydesti;
			$this->data["filteroption"]  = "&destination=".$filterbydesti;
		}
		else if(isset($filterbydesti) && !empty($filterbydesti) && isset($filterbydate) && !empty($filterbydate))
		{
			$explodemonthyear  = explode('-',$filterbydate);
			$filterbydatemonth = $explodemonthyear[0];
			$filterbydateyear  = $explodemonthyear[1];
			$filtercondition = " AND MONTH(review_date) = '".$filterbydatemonth."' AND YEAR(review_date)= '".$filterbydateyear."' AND destination_id LIKE '%".$filterbydesti."%'";
			$nextpage          .= "&date=".$filterbydate."&destination=".$filterbydesti;
			$prevpage          .= "&date=".$filterbydate."&destination=".$filterbydesti;
			$this->data["filteroption"]  = "&date=".$filterbydate."&destination=".$filterbydesti;
		}
		
		$this->data["results"] = $this->clientreviewmodel->clientreviewAlldata($config["per_page"], $start_from,$filtercondition);
		$str_links 			   = $this->pagination->create_links();
		
        $this->data["links"]   = explode('&nbsp;',$str_links );
		$this->data["current_page"] = $page;
		
		
		if($page < $total_row){
			 $this->data["next_data_url"] = $this->config->site_url().'ajaxcall/autoload_clientreview?page='.$nextpage.'';
		}else{
			 $this->data["next_data_url"] = '';
		}
		if($page != 1){
			 $this->data["prev_data_url"] = $this->config->site_url().'ajaxcall/autoload_clientreview?page='.$prevpage.'';
		}else{
			 $this->data["prev_data_url"] ='';
		}
		if(isset($prevpage) && !empty($prevpage)){
			$this->headerdata['prev_url']   = $this->config->site_url().'lavis-de-nos-clients?page='.$prevpage;
		}
		$this->headerdata['next_url']   	= $this->config->site_url().'lavis-de-nos-clients?page='.$nextpage;
		$this->headerdata['current_url']	= $this->config->site_url().'lavis-de-nos-clients?page='.$page;
		
		$this->load->view("common/header",$this->headerdata);
		$this->load->view('clientreview/view',$this->data);
		$this->load->view("common/footer",$this->footerdata);
	}
	
}
?>