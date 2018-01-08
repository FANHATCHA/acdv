<?php
class Voyages extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->model("voyagesmodel");
		$this->load->model("homemodel");
		$this->load->helper("url");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library("email");
		$this->load->model("commonlibmodel");
		$this->load->library('shortcodes');
       
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
		$id = $commodel->getIdFromSlug('id','products',$slug);
		/* GET SLUG TO ID */
		
		$productdata = $this->voyagesmodel->getproductdata($id);
		if(isset($productdata) && !empty($productdata))
		{
			$this->data['productdata']			   = $this->voyagesmodel->getproductdata($id);
			$productdata			 			   = $this->voyagesmodel->getproductdata($id);
			$this->data['presentation']			   = $this->shortcodes->do_shortcode($productdata[0]['presentation']);
			$this->data['hotel']				   = $this->shortcodes->do_shortcode($productdata[0]['hotel']);
			$this->data['product_budget']		   = $this->shortcodes->do_shortcode($productdata[0]['budget']);
			$this->data['special_offers']		   = $this->shortcodes->do_shortcode($productdata[0]['special_offers']);
			$this->data['route']		   		   = $this->shortcodes->do_shortcode($productdata[0]['route']);
			$this->data['companyinfo']			   = $this->homemodel->getcmsblock(15);
			
			/*==== HITS COUNT IN PRODUCT =====*/
			$this->voyagesmodel->counthits($id);
			/*==== HITS COUNT IN PRODUCT =====*/
			
			if(isset($productdata[0]['meta_title']) && !empty($productdata[0]['meta_title'])){ $producttitle = $productdata[0]['meta_title'];}else{ $producttitle = $productdata[0]['product_name'];}
			
			$this->headerdata["page_title"] = $producttitle;
			$this->headerdata["page_head"]  = $producttitle;
			$this->headerdata["meta_desc"]  = $productdata[0]['meta_description'];
			$this->headerdata["meta_key"]   = $productdata[0]['meta_keyword'];
			$this->headerdata["robots"]     = $productdata[0]['robots'];
			/*if(isset($productdata[0]['canonical_url']) && !empty($productdata[0]['canonical_url'])){
				$this->headerdata["canonical"]  = $productdata[0]['canonical_url'];
			}else{
				$this->headerdata["canonical"]  = $this->config->base_url().$this->uri->uri_string;
			}*/
			$this->load->view("common/header",$this->headerdata);
			$this->load->view('voyages/view',$this->data);
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