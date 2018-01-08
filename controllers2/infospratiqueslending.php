<?php
class Infospratiqueslending extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->model("infospratiqueslendingmodel");
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
		
		/* GET SLUG TO ID */
		$commodel = new Commonlibmodel();
		$slug = $this->uri->segment_array();
		$destslug  = array_slice($slug,0,1);
		$id = $commodel->getIdFromSlug('category_id','products_categories',$destslug[0]);
		
		/* GET SLUG TO ID */
		$this->data['slug'] 	= $destslug[0];
	
		$destinationdetails 				= $this->infospratiqueslendingmodel->getcountrycattodetailscat($id);
		
		if(isset($destinationdetails) && !empty($destinationdetails))
		{
		
			$this->data['praticalinfodata'] 	= $this->infospratiqueslendingmodel->getcountrycattodetailscat($id);
			
			$praticalinfodata					= $this->infospratiqueslendingmodel->getcountrycattodetailscat($id);
			if(isset($praticalinfodata['content']) && !empty($praticalinfodata['content']))
			{
				$this->data['praticalinfocontent']  = $this->shortcodes->do_shortcode($praticalinfodata['content']);
				
			}else{
			
				$this->data['praticalinfocontent']  = '';
			}
			$this->data['categoryimage'] 		= $this->infospratiqueslendingmodel->getcategoryimage($id);
			
			$this->data['pratical_info_pages'] 	= $this->infospratiqueslendingmodel->getpracticalinfopagesname($id);
			
			$detailscatslugandname 				=  $this->infospratiqueslendingmodel->getdetailscatidtoslug($destinationdetails['practical_information_id']);
			if(isset($destinationdetails['meta_title']) && !empty($destinationdetails['meta_title'])){ $praticalinfotitle = $destinationdetails['meta_title'];}else{ $praticalinfotitle = $detailscatslugandname['category_name'];}
			
			$this->headerdata["page_title"] = $praticalinfotitle;
			$this->headerdata["page_head"]  = $praticalinfotitle;
			$this->headerdata["meta_desc"]  = $destinationdetails['meta_description'];
			$this->headerdata["meta_key"]   = $destinationdetails['meta_keyword'];
			$this->headerdata["robots"]     = $destinationdetails['robots'];
			
			/*if(isset($destinationdetails['canonical_url']) && !empty($destinationdetails['canonical_url'])){
				//$this->headerdata["canonical"]  = $destinationdetails['canonical_url'];
			}else{
				//$this->headerdata["canonical"]  = $this->config->base_url().$this->uri->uri_string;
			}*/
			
			$this->load->view("common/header",$this->headerdata);
			$this->load->view('infospratiqueslending/view',$this->data);
			$this->load->view("common/footer",$this->footerdata);
		}
		else
		{
			$this->headerdata["page_title"] = $this->lang->line('404_PAGE_TITLE');
			$this->headerdata["page_head"]  = $this->lang->line('404_PAGE_HEADING');
			$this->load->view("common/header",$this->headerdata);
			$this->load->view('errors/view',$this->data);
			$this->load->view("common/footer",$this->footerdata);
		}
	}
	
}
?>