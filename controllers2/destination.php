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
		
		$urlsegment = count($this->uri->segment_array());
		
		$slug = $this->uri->segment_array();
		
		$destslug  = array_slice($slug,-1,1);
		$destslug1 = array_slice($slug,-2,1);
		$destslug2 = array_slice($slug,-3,1);
		
		
		$this->data['tagactive'] = '';
		$this->data['destination_primery'] = '';
		$filterdata = '';
		/* GET SLUG TO ID */
		if(isset($urlsegment) && !empty($urlsegment) && $urlsegment == '3')
		{
			$commodel = new Commonlibmodel();
			$slug = $this->uri->segment_array();
			$id = $commodel->getIdFromSlug('category_id','products_categories',$destslug1[0]);
			$this->data['destinationslg'] = $destslug1[0];
			$destinationslg = $destslug[0];
			
			$this->data['currentdestinationid'] = $id;
			/* TAG DISPLAY FILE TAG */
			$tagsfilter2 		= $this->commonlibmodel->getslugtotag($destinationslg);
			//print_R($tagsfilter2);
			if(isset($tagsfilter2) && !empty($tagsfilter2))
			{
				$filterdata .= ' AND (FIND_IN_SET("'.$tagsfilter2.'",p.primary) OR FIND_IN_SET("'.$tagsfilter2.'",p.secondary))';
			}
			/* TAG DISPLAY FILE TAG */
			
			$primarytag = $this->destinationmodel->getprimetags($id,$filterdata);
			$primarytagname = $commodel->getslugtotag($destslug[0]);
			if(isset($primarytag) && !empty($primarytag) && isset($primarytagname) && !empty($primarytagname))
			{
				if(in_array($primarytagname,$primarytag))
				{
					$this->data['destination_primery']   =  $destslug[0];
				}
			}
			$this->data['tagactive']	 = $destslug;
			$canonicalurltagwise = $commodel->getcanonicalurl($destslug[0]);
			$destslug22  = array_slice($slug,-2,1);
			$this->headerdata["canonical"]  = $this->config->base_url().'destination/'.$destslug22[0];
			
			
			if(isset($canonicalurltagwise['robots']) && !empty($canonicalurltagwise['robots']))
			{
				$this->headerdata["robots"]     = $canonicalurltagwise['robots'];
			}
			/* RESET URL */
			$this->data['secoundryurl'] 					= $this->config->base_url().'destination/'.$destslug1[0];
			$this->data['primaryurl'] 						= $this->config->base_url().'destination/'.$destslug1[0];
			/* RESET URL */
			
			/* breadcrumbs */		
			$destinationname = $this->commonlibmodel->getcatslugtocatname($destslug1[0]);	
			$tagname 		 = $this->commonlibmodel->getslugtotag($destslug[0]);
			$this->data['breadcrumbs'] = "<a href=".$this->config->base_url()."><span>Accueil</span></a> > <a href=".$this->config->base_url().'destination/'.$destslug1[0]."><span>".ucfirst($destinationname)."</spna></a> > <span>".ucfirst($tagname)."</span>";
			/* breadcrumbs */
			
			
		}
		else if(isset($urlsegment) && !empty($urlsegment) && $urlsegment == '4')
		{
			$commodel = new Commonlibmodel();
			$slug = $this->uri->segment_array();
			$id = $commodel->getIdFromSlug('category_id','products_categories',$destslug2[0]);
			$this->data['destinationslg'] 		 =  $destslug2[0];
			$this->data['destination_primery']   =  $destslug1[0];
			$this->data['currentdestinationid'] = $id;
			
			$secoundrytagfilter		 =  $destslug[0];
			$primaryagfilter		 =  explode('.',$destslug1[0]);
			/* TAG DISPLAY FILE TAG */
			$secoundryfilter 		= $this->commonlibmodel->getslugtotag($secoundrytagfilter);
			$primaryfilter 		    = $this->commonlibmodel->getslugtotag($primaryagfilter[0]);
			if(isset($secoundryfilter) && !empty($secoundryfilter) && isset($primaryfilter))
			{
				$filterdata .= ' AND (FIND_IN_SET("'.$primaryfilter.'",p.primary) AND FIND_IN_SET("'.$secoundryfilter.'",p.secondary))';
			}
			$this->data['primaryactive']      = $primaryagfilter[0];
 			$this->data['secoundryactive']    = $secoundrytagfilter;
			/* TAG DISPLAY FILE TAG */
			
				
			$primarytag = $this->destinationmodel->getprimetags($id,$filterdata);
			
			/* RESET URL */
			$this->data['secoundryurl'] 					= $this->config->base_url().'destination/'.$destslug2[0].'/'.$destslug1[0];
			$this->data['primaryurl'] 						= $this->config->base_url().'destination/'.$destslug2[0].'/'.$destslug[0];
			/* RESET URL */
			
			/* breadcrumbs */			$destinationname 	 = $this->commonlibmodel->getcatslugtocatname($destslug2[0]);			$primaryname 		 = $this->commonlibmodel->getslugtotag($destslug1[0]);			$secoundryname 		 = $this->commonlibmodel->getslugtotag($destslug[0]);
			$this->data['breadcrumbs'] = "<a href=".$this->config->base_url()."><span>Accueil</span></a> > <a href=".$this->config->base_url().'destination/'.$destslug2[0]."><span>".ucfirst($destinationname)."</spna></a> > <a href=".$this->config->base_url().'destination/'.$destslug2[0].'/'.$destslug1[0]."><span>".ucfirst($primaryname)."</span></a> > <span>".ucfirst($secoundryname)."</span>";
			/* breadcrumbs */
			
			$canonicalurltagwise = $commodel->getcanonicalurl($destslug[0]);
			
			$destslug22  = array_slice($slug,-3,1);
			$this->headerdata["canonical"]  = $this->config->base_url().'destination/'.$destslug22[0];
			
			
			if(isset($canonicalurltagwise['robots']) && !empty($canonicalurltagwise['robots']))
			{
				$this->headerdata["robots"]     = $canonicalurltagwise['robots'];
			}
		}
		else
		{
			$commodel = new Commonlibmodel();
			$slug = end($this->uri->segment_array());
			$id = $commodel->getIdFromSlug('category_id','products_categories',$slug);
			$this->data['currentdestinationid'] = $id;
			$this->data['destinationslg'] = $slug;
			
			
				$destinationdata 							= $this->destinationmodel->getdestinationdata($id);
				$this->headerdata["robots"]     = '';
				/*if(isset($destinationdata[0]['canonical_url']) && !empty($destinationdata[0]['canonical_url'])){
					//$this->headerdata["canonical"]  = $destinationdata[0]['canonical_url'];
				}else{
					//$this->headerdata["canonical"]  = $this->config->base_url().$this->uri->uri_string;
				}*/
			
			/* RESET URL */
			$this->data['secoundryurl'] 					= $this->config->base_url().'destination/'.$destslug1[0];
			$this->data['primaryurl'] 						= $this->config->base_url().'destination/'.$destslug1[0];
			/* RESET URL */
			
		}
		/* GET SLUG TO ID */
		
		$destinationdata 							= $this->destinationmodel->getdestinationdata($id);
		if(isset($destinationdata) && !empty($destinationdata))
		{
			$this->data['destinationdata'] 				= $this->destinationmodel->getdestinationdata($id);
			$this->data['destination_slider'] 			= $this->destinationmodel->getdestinationslider($id);
			$this->data['total_groups'] 				= $this->destinationmodel->gettotalproduct($id,$this->lang->line('PRODUCT_LIMIT'));
			$this->data['companyinfo'] 					= $this->homemodel->getcmsblock(15);
			$this->data['primetag'] 					= $this->destinationmodel->getprimetags($id,$filterdata);
			$this->data['secoundrytag'] 			    = $this->destinationmodel->getsecoundrytags($id,$filterdata);
			
			if(isset($destinationdata[0]['meta_title']) && !empty($destinationdata[0]['meta_title'])){ $destinationtitle = $destinationdata[0]['meta_title'];}else{ $destinationtitle = $destinationdata[0]['category_name'];}
			
			$this->headerdata["page_title"] = $destinationtitle;
			$this->headerdata["page_head"]  = $destinationtitle;
			$this->headerdata["meta_desc"]  = $destinationdata[0]['meta_description'];
			$this->headerdata["meta_key"]   = $destinationdata[0]['meta_keyword'];
			$this->headerdata["robots"]     = $destinationdata[0]['robots'];
			
			$this->load->view("common/header",$this->headerdata);
			$this->load->view('destination/view',$this->data);
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