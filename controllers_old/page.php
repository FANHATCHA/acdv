<?php
class Page extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->model("pagemodel");
		$this->load->helper("url");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
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
		$commodel = new Commonlibmodel();
		$slug = end($this->uri->segment_array());
		$id = $commodel->getIdFromSlug('id','cmspage',$slug);
		
		$pagedetails = $this->pagemodel->getpagedetails($id);
		
		
		
		if(isset($pagedetails) && !empty($pagedetails))
		{
			if(!isset($_SERVER['HTTP_REFERER']) && empty($_SERVER['HTTP_REFERER']) && $pagedetails[0]['slug'] == 'confirmation-demande-de-devis')
			{
				$base_url = base_url();
				redirect($base_url);
			}
			
			if(isset($pagedetails[0]['meta_title']) && !empty($pagedetails[0]['meta_title'])){ $pagetitle = $pagedetails[0]['meta_title'];}else{ $pagetitle = $pagedetails[0]['cms_title'];}
			
			$this->headerdata["page_title"] = $pagetitle;
			$this->headerdata["page_head"]  = $pagetitle;
			$this->headerdata["meta_desc"]  = $pagedetails[0]['meta_description'];
			$this->headerdata["meta_key"]   = $pagedetails[0]['meta_keyword'];
			$this->headerdata["robots"]     = $pagedetails[0]['robots'];
			/*if(isset($pagedetails[0]['canonical_url']) && !empty($pagedetails[0]['canonical_url'])){
				//$this->headerdata["canonical"]  = $pagedetails[0]['canonical_url'];
			}else{
				//$this->headerdata["canonical"]  = $this->config->base_url().$this->uri->uri_string;
			}*/
			
			$this->data['pagedata'] = $this->pagemodel->getpagedata($id);
			$this->load->view("common/header",$this->headerdata);
			$this->load->view('page/view',$this->data);
			$this->load->view("common/footer",$this->footerdata);
		}
		else
		{
			$this->headerdata["page_title"] = $this->lang->line('404_PAGE_TITLE');
			$this->headerdata["page_head"]  = $this->lang->line('404_PAGE_HEADING');
			$this->footerdata = $this->commonlib->footerdata();
		
			$this->load->view("common/header",$this->headerdata);
			$this->load->view('errors/view');
			$this->load->view("common/footer",$this->footerdata);
		}
	}
	
	
}
?>