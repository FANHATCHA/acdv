<?php
class Tags extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->model("tagsmodel");
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
		
		/* GET SLUG TO ID */
		$commodel = new Commonlibmodel();
		$slug = end($this->uri->segment_array());
		
		$slugtotagsname = $this->tagsmodel->gettagsdata($slug);
		if(isset($slugtotagsname) && !empty($slugtotagsname))
		{
			$slugtotagname  =  $slugtotagsname['tag_name'];
		}
		else
		{	
			$slugtotagname  =  '';
		}
		
		/* GET SLUG TO ID */
		
		$tagsdata 									= $this->tagsmodel->gettagsdata($slug);
		if(isset($tagsdata) && !empty($tagsdata))
		{
			$this->data['tagsdata'] 					= $this->tagsmodel->gettagsdata($slug);
			$this->data['tagslider_slider'] 			= $this->tagsmodel->gettagsslider($slug);
			$this->data['total_groups'] 				= $this->tagsmodel->gettotalproduct($slugtotagname,$this->lang->line('PRODUCT_LIMIT'));
			$this->data['companyinfo'] 					= $this->homemodel->getcmsblock(15);
		
			if(isset($tagsdata['meta_title']) && !empty($tagsdata['meta_title'])){ $tagstitle = $tagsdata['meta_title'];}else{ $tagstitle = $tagsdata['tag_name'];}
			
			$this->headerdata["page_title"] = $tagstitle;
			$this->headerdata["page_head"]  = $tagstitle;
			$this->headerdata["meta_desc"]  = $tagsdata['meta_description'];
			$this->headerdata["meta_key"]   = $tagsdata['meta_keyword'];
			$this->headerdata["robots"]     = $tagsdata['robots'];
			/*if(isset($tagsdata[0]['canonical_url']) && !empty($tagsdata[0]['canonical_url'])){
				$this->headerdata["canonical"]  = $tagsdata[0]['canonical_url'];
			}else{
				$this->headerdata["canonical"]  = $this->config->base_url().$this->uri->uri_string;
			}*/
			
			$this->load->view("common/header",$this->headerdata);
			$this->load->view('tags/view',$this->data);
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