<?php
class Frontblog extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->model("frontblogmodel");
		$this->load->model("homemodel");
		$this->load->helper("url");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
	//	$this->lang->load('defines_front', 'english');
		$this->load->model("commonlibmodel");
		
		/*======================= LOAD COMMON LIBRARY ===================*/
		$this->load->library('commonlib');
		/*======================= LOAD COMMON LIBRARY ===================*/
	}
	function index() 
	{
		$this->headerdata = $this->commonlib->headerdata();
		$this->footerdata = $this->commonlib->footerdata();
		
		$current_url_desti 				= $_SERVER['REQUEST_URI'];
		if(isset($_GET['page']) && !empty($_GET['page']))
		{
			$current_url_desti =strtok($_SERVER["REQUEST_URI"],'?');
			
		}
		$total_row						= $this->frontblogmodel->gettotalblogALL($this->lang->line('CLIENT_BLOG_LIMIT'));
		$config['base_url']		    	= $current_url_desti.'?page=';
		$config['total_rows']	    	= $total_row;
		$config['per_page'] 			= $this->lang->line('CLIENT_BLOG_LIMIT');
		$config['num_links']			= $total_row;
		$config['cur_tag_open'] 		= '&nbsp;<a class="current">';
		$config['cur_tag_close'] 		= '</a>';
		$config['next_link']			= 'Next';
		$config['prev_link'] 			= 'Previous';
		$this->pagination->initialize($config);
		$pages = $this->input->get('page', TRUE);
		if (isset($pages) && !empty($pages)) { $page  = $pages; } else { $page=1; };  
		$start_from = ($page-1) * $this->lang->line('CLIENT_BLOG_LIMIT'); 
		$nextpage = $page + 1;
		$prevpage = $page - 1;
		
		$this->data['result'] 			= $this->frontblogmodel->getallblogsALL($config['per_page'],$start_from);
		$this->data["category"]  		= $this->frontblogmodel->getcategory();
		$str_links 			  			= $this->pagination->create_links();
		$this->data["links"]   			= explode('&nbsp;',$str_links );
		$this->data['current_page']		 = $page;
		
		if($page < $total_row){
		 $this->data["next_data_url"] = $this->config->site_url().'ajaxcall/autoload_blogdata?page='.$nextpage;
		}else{
			 $this->data["next_data_url"] = '';
		}
		if($page != 1){
			 $this->data["prev_data_url"] = $this->config->site_url().'ajaxcall/autoload_blogdata?page='.$prevpage;
		}else{
			 $this->data["prev_data_url"] ='';
		}
		$this->data['current_url']					 = $current_url_desti.'?page='.$page;
		if(isset($prevpage) && !empty($prevpage)){
		$this->headerdata['prev_url']   			 = $current_url_desti.'?page='.$prevpage;
		}
		$this->headerdata['next_url']   			 = $current_url_desti.'?page='.$nextpage;
		$this->headerdata['current_url']			 = $current_url_desti.'?page='.$page;
		
		$this->data['total_groups'] 	= $this->frontblogmodel->gettotalblog($this->lang->line('CLIENT_BLOG_LIMIT'));
		$pagemetadesc = $this->commonlibmodel->getmetadetails(95);
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
		
		$this->data["homeslider"]  		= $this->homemodel->gethomeslider(36);
		$this->data["category"]  		= $this->frontblogmodel->getcategory();
		$this->data["recentarticle"]  	= $this->frontblogmodel->getrecentarticles();
		$this->data["mostview"]  		= $this->frontblogmodel->getmostview();
		$this->data["archive"]  		= $this->frontblogmodel->getarchive();
		$this->data["blogslidelink"]  	= $this->homemodel->getcmsblock(18);
		
		$this->load->view("common/header",$this->headerdata);
		$this->load->view('frontblog/index',$this->data);
		$this->load->view("common/footer",$this->footerdata);
		
		
	}
	
	
	function categoryview() 
	{
		$this->headerdata = $this->commonlib->headerdata();
		$this->footerdata = $this->commonlib->footerdata();
		
		
		$this->headerdata["page_title"] = 'Le Blog de l’Océan Indien et de la Polynésie';
		$this->headerdata["page_head"]  = 'Le Blog de l’Océan Indien et de la Polynésie';
		$this->data["homeslider"]  		= $this->homemodel->gethomeslider(36);
		//$this->headerdata["canonical"]  = $this->config->base_url().$this->uri->uri_string;
		$this->headerdata["meta_desc"]  = 'Vous arrivez sur notre blog! Espace d’échange d’idées et de débat. N’hésitez pas à réagir. L’Equipe Au Coeur du Voyage';
		$this->headerdata["meta_key"]   = 'Vous arrivez sur notre blog! Espace d’échange d’idées et de débat. N’hésitez pas à réagir. L’Equipe Au Coeur du Voyage';
		
		
		/* GET SLUG TO ID */
		$commodel = new Commonlibmodel();
		$slug = end($this->uri->segment_array());
		$id = $commodel->getIdFromSlug('category_id','blog_categories',$slug);
		/* GET SLUG TO ID */
		
		
		
		
	
		if(isset($id) && !empty($id))
		{
			$current_url_desti 				= $_SERVER['REQUEST_URI'];
			if(isset($_GET['page']) && !empty($_GET['page']))
			{
				$current_url_desti =strtok($_SERVER["REQUEST_URI"],'?');
				
			}
			$total_row						= $this->frontblogmodel->gettotalcategoryblogALL($this->lang->line('CLIENT_BLOG_LIMIT'),$id);
			$config['base_url']		    	= $current_url_desti.'?page=';
			$config['total_rows']	    	= $total_row;
			$config['per_page'] 			= $this->lang->line('CLIENT_BLOG_LIMIT');
			$config['num_links']			= $total_row;
			$config['cur_tag_open'] 		= '&nbsp;<a class="current">';
			$config['cur_tag_close'] 		= '</a>';
			$config['next_link']			= 'Next';
			$config['prev_link'] 			= 'Previous';
			$this->pagination->initialize($config);
			$pages = $this->input->get('page', TRUE);
			if (isset($pages) && !empty($pages)) { $page  = $pages; } else { $page=1; };  
			$start_from = ($page-1) * $this->lang->line('CLIENT_BLOG_LIMIT'); 
			$nextpage = $page + 1;
			$prevpage = $page - 1;
		
			$this->data['result'] 			= $this->frontblogmodel->getcategoryblogsALL($config["per_page"],$start_from,$id);
			
			$this->data['total_groups'] 	= $this->frontblogmodel->gettotalcategoryblog($this->lang->line('CLIENT_BLOG_LIMIT'),$id);
			$this->data["category"]  		= $this->frontblogmodel->getcategory();
			
			
			$str_links 			  		= $this->pagination->create_links();
			$this->data["links"]   		= explode('&nbsp;',$str_links );
			$this->data['current_page'] = $page;
			
			if($page < $total_row){
			 $this->data["next_data_url"] = $this->config->site_url().'ajaxcall/autoload_categoryblogdata?page='.$nextpage.'&id='.$id;
			}else{
				 $this->data["next_data_url"] = '';
			}
			if($page != 1){
				 $this->data["prev_data_url"] = $this->config->site_url().'ajaxcall/autoload_categoryblogdata?page='.$prevpage.'&id='.$id;
			}else{
				 $this->data["prev_data_url"] ='';
			}
			$this->data['current_url']					 = $current_url_desti.'?page='.$page.'&id='.$id;
			if(isset($prevpage) && !empty($prevpage)){
			$this->headerdata['prev_url']   			 = $current_url_desti.'?page='.$prevpage;
			}
			$this->headerdata['next_url']   			 = $current_url_desti.'?page='.$nextpage;
			$this->headerdata['current_url']			 = $current_url_desti.'?page='.$page;
			
			$this->data["recentarticle"]  	= $this->frontblogmodel->getrecentarticles();
			$this->data["mostview"]  		= $this->frontblogmodel->getmostview();
			$this->data["archive"]  		= $this->frontblogmodel->getarchive();
			$this->data["blogslidelink"]  	= $this->homemodel->getcmsblock(18);
			
			$this->load->view("common/header",$this->headerdata);
			$this->load->view('frontblog/categoryview',$this->data);
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
	
	function view() 
	{
		$this->headerdata = $this->commonlib->headerdata();
		$this->footerdata = $this->commonlib->footerdata();
		if(count($this->uri->segments) > 3)
		{
			/* GET SLUG TO ID */
			$commodel = new Commonlibmodel();
			$slug = end($this->uri->segment_array());
			$id = $commodel->getIdFromSlug('id','blog',$slug);
			/* GET SLUG TO ID */
			if(isset($id) && !empty($id))
			{
				/*==== HITS COUNT IN PRODUCT =====*/
				$this->frontblogmodel->counthits($id);
				/*==== HITS COUNT IN PRODUCT =====*/
				
				$blogdata = $this->frontblogmodel->getblogsdata($id);
				$this->data['blogdata'] = $this->frontblogmodel->getblogsdata($id);
				
				if(isset($blogdata[0]['meta_title']) && !empty($blogdata[0]['meta_title'])){ $blogtitle = $blogdata[0]['meta_title'];}else{ $blogtitle = $blogdata[0]['blog_title'];}
				
				$this->headerdata["page_title"] = $blogtitle;
				$this->headerdata["page_head"]  = $blogtitle;
				$this->headerdata["meta_desc"]  = $blogdata[0]['meta_description'];
				$this->headerdata["meta_key"]   = $blogdata[0]['meta_keyword'];
				$this->headerdata["robots"]     = $blogdata[0]['robots'];
				
				$this->data["category"]  					= $this->frontblogmodel->getcategory();
				$this->data["recentarticle"]  				= $this->frontblogmodel->getrecentarticles();
				$this->data["mostview"]  				    = $this->frontblogmodel->getmostview();
				$this->data["archive"]  					= $this->frontblogmodel->getarchive();
				$this->data["blogslidelink"]  				= $this->homemodel->getcmsblock(18);
				$this->data['blog_slider'] 					= $this->frontblogmodel->getblogslider($id);
				
				$this->load->view("common/header",$this->headerdata);
				$this->load->view('frontblog/view',$this->data);
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
		else
		{
			
			$this->headerdata = $this->commonlib->headerdata();
			$this->footerdata = $this->commonlib->footerdata();
		
			$this->headerdata["page_title"] = 'Le Blog de l’Océan Indien et de la Polynésie';
			$this->headerdata["page_head"]  = 'Le Blog de l’Océan Indien et de la Polynésie';
			$this->data["homeslider"]  		= $this->homemodel->gethomeslider(36);
			//$this->headerdata["canonical"]  = $this->config->base_url().$this->uri->uri_string;
			$this->headerdata["meta_desc"]  = 'Vous arrivez sur notre blog! Espace d’échange d’idées et de débat. N’hésitez pas à réagir. L’Equipe Au Coeur du Voyage';
			$this->headerdata["meta_key"]   = 'Vous arrivez sur notre blog! Espace d’échange d’idées et de débat. N’hésitez pas à réagir. L’Equipe Au Coeur du Voyage';
		
			/* GET SLUG TO ID */
			$year  = $this->uri->segments[2];
			$month = $this->uri->segments[3];
			/* GET SLUG TO ID */
			
			$current_url_desti 				= $_SERVER['REQUEST_URI'];
			if(isset($_GET['page']) && !empty($_GET['page']))
			{
				$current_url_desti =strtok($_SERVER["REQUEST_URI"],'?');
				
			}
			$total_row						= $this->frontblogmodel->gettotalarchiveblogALL($this->lang->line('CLIENT_BLOG_LIMIT'),$year,$month);
			$config['base_url']		    	= $current_url_desti.'?page=';
			$config['total_rows']	    	= $total_row;
			$config['per_page'] 			= $this->lang->line('CLIENT_BLOG_LIMIT');
			$config['num_links']			= $total_row;
			$config['cur_tag_open'] 		= '&nbsp;<a class="current">';
			$config['cur_tag_close'] 		= '</a>';
			$config['next_link']			= 'Next';
			$config['prev_link'] 			= 'Previous';
			$this->pagination->initialize($config);
			$pages = $this->input->get('page', TRUE);
			if (isset($pages) && !empty($pages)) { $page  = $pages; } else { $page=1; };  
			$start_from = ($page-1) * $this->lang->line('CLIENT_BLOG_LIMIT'); 
			$nextpage = $page + 1;
			$prevpage = $page - 1;
			
			$this->data['result'] 			= $this->frontblogmodel->getarchiveblogsALL($config['per_page'],$start_from,$year,$month);
			$this->data["category"]  		= $this->frontblogmodel->getcategory();
			$str_links 			  		= $this->pagination->create_links();
			$this->data["links"]   		= explode('&nbsp;',$str_links );
			$this->data['current_page'] = $page;
			if(isset($prevpage) && !empty($prevpage)){
			$this->headerdata['prev_url']   			 = $current_url_desti.'?page='.$prevpage;
			}
			$this->headerdata['next_url']   			 = $current_url_desti.'?page='.$nextpage;
			$this->headerdata['current_url']			 = $current_url_desti.'?page='.$page;
			
			if($page < $total_row){
			 $this->data["next_data_url"] = $this->config->site_url().'ajaxcall/autoload_archiveblogdata?page='.$nextpage.'&year='.$year.'&month='.$month;
			}else{
				 $this->data["next_data_url"] = '';
			}
			if($page != 1){
				 $this->data["prev_data_url"] = $this->config->site_url().'ajaxcall/autoload_archiveblogdata?page='.$prevpage.'&year='.$year.'&month='.$month;
			}else{
				 $this->data["prev_data_url"] ='';
			}
			$this->data['current_url']					 = $current_url_desti.'?page='.$page.'&year='.$year.'&month='.$month;
			
			$this->data['total_groups'] 	= $this->frontblogmodel->gettotalarchiveblog($this->lang->line('CLIENT_BLOG_LIMIT'),$year,$month);
	
			$this->data["category"]  		= $this->frontblogmodel->getcategory();
			$this->data["recentarticle"]  	= $this->frontblogmodel->getrecentarticles();
			$this->data["mostview"]  		= $this->frontblogmodel->getmostview();
			$this->data["archive"]  		= $this->frontblogmodel->getarchive();
			$this->data["blogslidelink"]  	= $this->homemodel->getcmsblock(18);
		
			 
			$this->load->view("common/header",$this->headerdata);
			$this->load->view('frontblog/archive',$this->data);
			$this->load->view("common/footer",$this->footerdata);
			
			
		}
	}
	
	
	
}
?>