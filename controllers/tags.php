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
			
			
			$current_url_desti 				= $_SERVER['REQUEST_URI'];
			if(isset($_GET['page']) && !empty($_GET['page']))
			{
				$current_url_desti =strtok($_SERVER["REQUEST_URI"],'?');
				
			}
			$total_row						= $this->tagsmodel->gettotalproductALL($slugtotagname,$this->lang->line('PRODUCT_LIMIT'));
			$config['base_url']		    	= $current_url_desti.'?page=';
			$config['total_rows']	    	= $total_row;
			$config['per_page'] 			= $this->lang->line('PRODUCT_LIMIT');
			$config['use_page_numbers'] 	= TRUE;
			$config['num_links'] 			= $total_row;
			$config['cur_tag_open'] 		= '&nbsp;<a class="current">';
			$config['cur_tag_close'] 		= '</a>';
			$config['next_link']			= 'Next';
			$config['prev_link'] 			= 'Previous';
			$this->pagination->initialize($config);
			
			$pages = $this->input->get('page', TRUE);
			if (isset($pages) && !empty($pages)) { $page  = $pages; } else { $page=1; }; 
			$start_from = ($page-1) * $this->lang->line('PRODUCT_LIMIT'); 
			
			$nextpage = $page + 1;
			$prevpage = $page - 1;
			
			$pricefilter 		= $this->input->get("price");
			$hitsfilter 		= $this->input->get("hits");
			$filterdata_order   = '';
			
			if(isset($pricefilter) && !empty($pricefilter) &&  empty($hitsfilter))
			{
				$filterdata_order .= ' ORDER BY p.price '.$pricefilter.'';
			}
			if(isset($hitsfilter) && !empty($hitsfilter) && empty($pricefilter))
			{
				$filterdata_order .= ' ORDER BY p.hits '.$hitsfilter.'';
			}
			if(empty($hitsfilter) && empty($pricefilter))
			{
				$filterdata_order .= ' ORDER BY p.display_order DESC';
			}
			
			$this->data['result'] 		= $this->tagsmodel->gettagsproductdataALL($slugtotagname,$config["per_page"],$start_from,$filterdata_order);
			$str_links 			  		= $this->pagination->create_links();
			$this->data["links"]   		= explode('&nbsp;',$str_links );
			$this->data['current_page'] = $page;
			
			if($page < $total_row){
			 $this->data["next_data_url"] = $this->config->site_url().'ajaxcall/autoload_tagproductdata?page='.$nextpage.'&slugtotagname='.$slugtotagname.'&currenturl='.$current_url_desti.'&price='.$pricefilter.'&hits='.$hitsfilter;
			}else{
				 $this->data["next_data_url"] = '';
			}
			if($page != 1){
				 $this->data["prev_data_url"] = $this->config->site_url().'ajaxcall/autoload_tagproductdata?page='.$prevpage.'&slugtotagname='.$slugtotagname.'&currenturl='.$current_url_desti.'&price='.$pricefilter.'&hits='.$hitsfilter;
			}else{
				 $this->data["prev_data_url"] ='';
			}
			$this->data['current_url']					 = $current_url_desti.'?page='.$page.'&slugtotagname='.$slugtotagname.'&currenturl='.$current_url_desti.'&price='.$pricefilter.'&hits='.$hitsfilter;
			
			if(isset($prevpage) && !empty($prevpage)){
			$this->headerdata['prev_url']   			 = $current_url_desti.'?page='.$prevpage;
			}
			$this->headerdata['next_url']   			 = $current_url_desti.'?page='.$nextpage;
			$this->headerdata['current_url']			 = $current_url_desti.'?page='.$page;
		
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