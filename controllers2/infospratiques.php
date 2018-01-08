<?php
class Infospratiques extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->model("infospratiquesmodel");
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
		$destslug2  = array_slice($slug,1,2); 
		$id = $commodel->getIdFromSlug('category_id','products_categories',$destslug[0]);
		$detailscatid = $commodel->getIdFromSlug('category_id','practical_information_categories',$destslug2[0]);
		/* GET SLUG TO ID */
		$this->data['slug'] 	= $destslug[0];
		$praticalinfodata 		= $this->infospratiquesmodel->getpracticalinfodata($id,$detailscatid);
		
		if(isset($praticalinfodata) && !empty($praticalinfodata))
		{
			$this->data['praticalinfodata'] 	= $this->infospratiquesmodel->getpracticalinfodata($id,$detailscatid);
			if(isset($praticalinfodata['content']) && !empty($praticalinfodata['content']))
			{
				$this->data['praticalinfocontent']  = $this->shortcodes->do_shortcode($praticalinfodata['content']);
			}else{
				$this->data['praticalinfocontent']  = '';
			}
			$this->data['categoryimage'] 		= $this->infospratiquesmodel->getcategoryimage($id);
			$this->data['pratical_info_pages'] 	= $this->infospratiquesmodel->getpracticalinfopagesname($id);
			$detailscatslugandname 				=  $this->infospratiquesmodel->getdetailscatidtoslug($praticalinfodata['practical_information_id']);
			
			if(isset($praticalinfodata['meta_title']) && !empty($praticalinfodata['meta_title'])){ $praticalinfotitle = $praticalinfodata['meta_title'];}else{ $praticalinfotitle = $detailscatslugandname['category_name'];}
			
			
			$this->headerdata["page_title"] = $praticalinfotitle;
			$this->headerdata["page_head"]  = $praticalinfotitle;
			$this->headerdata["meta_desc"]  = $praticalinfodata['meta_description'];
			$this->headerdata["meta_key"]   = $praticalinfodata['meta_keyword'];
			$this->headerdata["robots"]     = $praticalinfodata['robots'];
			/*if(isset($praticalinfodata['canonical_url']) && !empty($praticalinfodata['canonical_url'])){
				$this->headerdata["canonical"]  = $praticalinfodata['canonical_url'];
			}else{
				$this->headerdata["canonical"]  = $this->config->base_url().$this->uri->uri_string;
			}*/
			
			$this->load->view("common/header",$this->headerdata);
			$this->load->view('infospratiques/view',$this->data);
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