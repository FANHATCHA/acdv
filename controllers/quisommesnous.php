<?php
class Quisommesnous extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->model("quisommesnousmodel");
		$this->load->model("homemodel");
		$this->load->helper("url");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library("email");
		$this->load->model("commonlibmodel");
		/*======================= LOAD COMMON LIBRARY ===================*/
		$this->load->library('commonlib');
		/*======================= LOAD COMMON LIBRARY ===================*/
		
		
	}
	function view() 
	{
		$this->headerdata = $this->commonlib->headerdata();
		$this->footerdata = $this->commonlib->footerdata();
		
		$this->data['representativedata'] = $this->quisommesnousmodel->getrepresentative();
		$this->data["homeslider"]  		  = $this->homemodel->gethomeslider(37);
		
		$pagemetadesc = $this->commonlibmodel->getmetadetails(91);
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
		$this->load->view('quisommesnous/view',$this->data);
		$this->load->view("common/footer",$this->footerdata);
	}
	
}
?>