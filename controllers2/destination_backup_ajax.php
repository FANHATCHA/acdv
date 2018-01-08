<?php
class Destination extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->model("destinationmodel");
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
		
		//$id = $this->input->get("id");
		
		/* GET SLUG TO ID */
		$commodel = new Commonlibmodel();
		$slug = end($this->uri->segment_array());
		$id = $commodel->getIdFromSlug('category_id','products_categories',$slug);
		/* GET SLUG TO ID */

		$destinationdata 					= $this->destinationmodel->getdestinationdata($id);
		$this->data['destinationdata'] 		= $this->destinationmodel->getdestinationdata($id);
		$this->data['destination_slider'] 	= $this->destinationmodel->getdestinationslider($id);
		$this->data['total_groups'] 		= $this->destinationmodel->gettotalproduct($id,$this->lang->line('PRODUCT_LIMIT'));
		$this->data['companyinfo'] 			= $this->homemodel->getcmsblock(15);
		
		$this->data['primetag'] 					= $this->destinationmodel->getprimetags();
		$this->data['secoundrytag'] 			    = $this->destinationmodel->getsecoundrytags();
		
		if(isset($destinationdata[0]['meta_title']) && !empty($destinationdata[0]['meta_title'])){ $destinationtitle = $destinationdata[0]['meta_title'];}else{ $destinationtitle = $destinationdata[0]['category_name'];}
		
		$this->headerdata["page_title"] = $destinationtitle;
		$this->headerdata["page_head"]  = $destinationtitle;
		$this->headerdata["meta_desc"]  = $destinationdata[0]['meta_description'];
		$this->headerdata["meta_key"]   = $destinationdata[0]['meta_keyword'];
		
		$this->load->view("common/header",$this->headerdata);
		$this->load->view('destination/view',$this->data);
		$this->load->view("common/footer",$this->footerdata);
	}
	
}
?>