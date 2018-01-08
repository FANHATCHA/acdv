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
		/*======================= LOAD COMMON LIBRARY ===================*/
		
		
	}
	function view() 
	{
	
		$this->headerdata = $this->commonlib->headerdata();
		$this->footerdata = $this->commonlib->footerdata();
		
		$this->data['companyinfo'] 		= $this->homemodel->getcmsblock(15);
		$this->data['sidebarcontent'] 	= $this->homemodel->getcmsblock(17);
		$this->data['total_groups'] 	= $this->clientreviewmodel->gettotalclientreview($this->lang->line('CLIENT_REVIEW_LIMIT'));
		$this->data["homeslider"]  		= $this->homemodel->gethomeslider(35);
		
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
		//$this->headerdata["canonical"]  = $this->config->base_url().$this->uri->uri_string;
		
		
		$this->load->view("common/header",$this->headerdata);
		$this->load->view('clientreview/view',$this->data);
		$this->load->view("common/footer",$this->footerdata);
	}
	
}
?>