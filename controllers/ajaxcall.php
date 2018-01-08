<?php
class Ajaxcall extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->model("destinationmodel");
		$this->load->model("clientreviewmodel");
		$this->load->model("frontblogmodel");
		$this->load->model("tagsmodel");
		$this->load->model("voyagesmodel");
		$this->load->library('form_validation');
		$this->load->library("email");
		$this->load->model("commonlibmodel");
		/*======================= LOAD COMMON LIBRARY ===================*/
		$this->load->library('commonlib');
		$this->load->library('pagination');
		/*======================= LOAD COMMON LIBRARY ===================*/
	}
	function captch_code_check()
	{
		session_start();
		$code 				= $this->input->post("code");
		$session_captcha	= $this->session->userdata('vercode');
		if($_SESSION['vercode'] == $code)
		{
			echo '1';
		}
		else
		{
			echo '0';
		}
	}
	
	
	function autoload_productdata()
	{	
		header('Content-Type: text/html; charset=utf-8');
		$destination_id 				= $this->input->get('id', TRUE);
		$filterdata          			= $this->input->get('filterdata', TRUE);
		$current_url_desti 				= $_SERVER['HTTP_REFERER'];
		if(isset($_GET['page']) && !empty($_GET['page']))
		{
			$current_url_desti =strtok($_SERVER["HTTP_REFERER"],'?');
			
		}
		$total_row						= $this->destinationmodel->gettotalproductAll($destination_id,$filterdata,$this->lang->line('PRODUCT_LIMIT'));
		
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
		$return = array();
		$results = $this->destinationmodel->getdestinationproductdataALL($destination_id,$config["per_page"],$start_from,$filterdata,$filterdata_order);
		$str_links 			   = $this->pagination->create_links();
        $current_page = $pages;
				
		if($page < $total_row){
			 $return["next_data_url"] = $this->config->site_url().'ajaxcall/autoload_productdata?page='.$nextpage.'&id='.$destination_id.'&filterdata='.$filterdata.'&price='.$pricefilter.'&hits='.$hitsfilter;
		}else{
			 $return["next_data_url"] = '';
		}
		if($page != 1){
			 $return["prev_data_url"] = $this->config->site_url().'ajaxcall/autoload_productdata?page='.$prevpage.'&id='.$destination_id.'&filterdata='.$filterdata.'&price='.$pricefilter.'&hits='.$hitsfilter;
		}else{
			 $return["prev_data_url"] ='';
		}
		$return['current_url'] = $current_url_desti.'?page='.$page.'&id='.$destination_id.'&filterdata='.$filterdata.'&price='.$pricefilter.'&hits='.$hitsfilter;
		$return['next_url']    = $current_url_desti.'?page='.$nextpage;
		
		$return_res = '';
		if(isset($results) && !empty($results))
		{
			foreach($results as $destination_pro_cat_datas)
			{
				
				$productdetails     =  $this->destinationmodel->getproductdetails($destination_pro_cat_datas['product_id']);
				$category_slugs     =  $this->commonlibmodel->getproducturl($destination_pro_cat_datas['product_id']);
				$product_slugs      =  $this->commonlibmodel->producttoslug($destination_pro_cat_datas['product_id']);
				$productdetailslink =  $this->config->site_url().$category_slugs.'/voyages/'.$product_slugs;
				$return_res .= '<div class="listitempage" data-url="'.$current_url_desti.'?page='.$current_page.'">';
				$return_res .= '<div class="listitem" data-page-url="'.$current_url_desti.'?page='.$current_page.'">';
				$return_res.='<div class="product_details"><div class="pro_thumb_image">
							<a href="'.$productdetailslink.'">';
									if(isset($productdetails[0]["featured_image"]) && !empty($productdetails[0]["featured_image"])){
										$return_res .= '<img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/product/featuredimage/original/'.$productdetails[0]['featured_image'].'&h=250&w=250&c=1" border="0" title="'.$productdetails[0]['product_name'].'" alt="'.$productdetails[0]['product_name'].'">';
									}else{ 
										$return_res .= '<img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/no_image250.jpg&h=250&w=250&c=1" alt="'.$productdetails[0]['product_name'].'" title="'.$productdetails[0]["product_name"].'" border="0">';
									}
								$return_res .='
							</a></div><div class="pro_thumb_image_right">
							<h2><a href="'.$productdetailslink.'">
								'.$productdetails[0]["product_name"].'
							</a></h2>
							<h3><a href="'.$productdetailslink.'">
								'.$productdetails[0]["subtitle"].'
							</a></h3>							
							<div class="short_description">
								<p>'.$productdetails[0]["short_description"].'</p>
							</div>
							<div class="short_threepoint">
								<p>'.$productdetails[0]["short_point"].'</p>
							</div>
							<span class="nightformprice">
								<label>'.$productdetails[0]["number_of_nights"].' nuits à partir de</label> <span>'.$productdetails[0]["price"].' &#8364;</span> <sup>/ Pers</sup>
								<a href="'.$productdetailslink.'">En savoir plus</a>
							</span>
							</div>
						</div></div></div>';
								
			}
		}
		$return['prev_url']    = $current_url_desti.'?page='.$prevpage;
		
	
			
		$return['response']    = $return_res; 
		//$arr = array_map('utf8_encode', $return);
		echo json_encode($return); 
	}
	/*function autoload_tagproductdata()
	{
	
		$slug = $this->input->post("slug");
		$items_per_group = $this->lang->line('PRODUCT_LIMIT');

		//sanitize post value
		$group_number = filter_var($this->input->post("group_no"), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		
		//get current starting point of records
		$position = ($group_number * $items_per_group);
		
		$pricefilter 		= $this->input->post("price");
		$hitsfilter 		= $this->input->post("hits");
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
			$filterdata_order .= ' ORDER BY p.display_order ASC';
		}
		
		$slugtotagsname = $this->tagsmodel->gettagsdata($slug);
		$slug 			=  $slugtotagsname['tag_name'];
		
		$destination_pro_cat_data = $this->tagsmodel->gettagsproductdata($slug,$position,$items_per_group,$filterdata_order);
		$html = '';
		if(isset($destination_pro_cat_data) && !empty($destination_pro_cat_data))
		{
			foreach($destination_pro_cat_data as $destination_pro_cat_datas)
			{
				
				$productdetails     =  $this->tagsmodel->getproductdetails($destination_pro_cat_datas['id']);
				//$category_slugs     =  $this->commonlibmodel->getproducturl($destination_pro_cat_datas['product_id']);
				$category_slugs     =  $this->commonlibmodel->getproducturl($destination_pro_cat_datas['id']);
				$product_slugs      =  $this->commonlibmodel->producttoslug($destination_pro_cat_datas['id']);
				$productdetailslink =  $this->config->site_url().$category_slugs.'/voyages/'.$product_slugs;
				
						$html .='<div class="product_details"><div class="pro_thumb_image">
							<a href="'.$productdetailslink.'">';
									if(isset($productdetails[0]["featured_image"]) && !empty($productdetails[0]["featured_image"])){
										$html .= '<img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/product/featuredimage/original/'.$productdetails[0]['featured_image'].'&h=250&w=250&c=1" border="0" title="'.$productdetails[0]['product_name'].'" alt="'.$productdetails[0]['product_name'].'">';
									}else{ 
										$html .= '<img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/no_image250.jpg&h=250&w=250&c=1" alt="'.$productdetails[0]['product_name'].'" title="'.$productdetails[0]["product_name"].'" border="0">';
									}
								$html .='
							</a></div><div class="pro_thumb_image_right">
							<h2><a href="'.$productdetailslink.'">
								'.$productdetails[0]["product_name"].'
							</a></h2>	
							<h3><a href="'.$productdetailslink.'">
								'.$productdetails[0]["subtitle"].'
							</a></h3>								
							<div class="short_description">
								<p>'.$productdetails[0]["short_description"].'</p>
							</div>
							<div class="short_threepoint">
								<p>'.$productdetails[0]["short_point"].'</p>
							</div>
							<span class="nightformprice">
								<label>'.$productdetails[0]["number_of_nights"].' nuits à partir de</label> <span>'.$productdetails[0]["price"].' &#8364;</span> <sup>/ Pers</sup>
								<a href="'.$productdetailslink.'">En savoir plus</a>
							</span>
							</div>
						</div>';
								
			}
		}
		echo  $html;
	}*/
	
	function autoload_tagproductdata()
	{
		header('Content-Type: text/html; charset=utf-8');
		//$slugtotagname          		= $this->input->get('slugtotagname', TRUE);
		$current_url_desti          	= $this->input->get('currenturl', TRUE);
		$slugexp = end(explode('/',$current_url_desti));
		$slugtotagsname = $this->tagsmodel->gettagsdata($slugexp);
		if(isset($slugtotagsname) && !empty($slugtotagsname))
		{
			$slugtotagname  =  $slugtotagsname['tag_name'];
		}
		else
		{	
			$slugtotagname  =  '';
		}
		//$current_url_desti 			= $_SERVER["HTTP_REFERER"];
		/*if(isset($_GET['page']) && !empty($_GET['page']))
		{
			$current_url_desti = strtok($_SERVER["HTTP_REFERER"],'?');
		}*/
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
		
		$results = $this->tagsmodel->gettagsproductdataALL($slugtotagname,$config["per_page"],$start_from,$filterdata_order);
		$str_links 			   = $this->pagination->create_links();
        $this->data["links"]   = explode('&nbsp;',$str_links );
		$current_page = $pages;
		$return = array();
		if($page < $total_row){
			 $return["next_data_url"] = $this->config->site_url().'ajaxcall/autoload_tagproductdata?page='.$nextpage.'&slugtotagname='.$slugtotagname.'&currenturl='.$current_url_desti.'&price='.$pricefilter.'&hits='.$hitsfilter;
		}else{
			 $return["next_data_url"] = '';
		}
		if($page != 1){
			 $return["prev_data_url"] = $this->config->site_url().'ajaxcall/autoload_tagproductdata?page='.$prevpage.'&slugtotagname='.$slugtotagname.'&currenturl='.$current_url_desti.'&price='.$pricefilter.'&hits='.$hitsfilter;
		}else{
			 $return["prev_data_url"] ='';
		}
		$return['current_url'] = $current_url_desti.'?page='.$page.'&slugtotagname='.$slugtotagname.'&currenturl='.$current_url_desti.'&price='.$pricefilter.'&hits='.$hitsfilter;
		$return['next_url']    = $current_url_desti.'?page='.$nextpage;
		
		
		$return_res = '';
		if(isset($results) && !empty($results))
		{
			foreach($results as $destination_pro_cat_datas)
			{
				
				$productdetails     =  $this->tagsmodel->getproductdetails($destination_pro_cat_datas['id']);
				$category_slugs     =  $this->commonlibmodel->getproducturl($destination_pro_cat_datas['id']);
				$product_slugs      =  $this->commonlibmodel->producttoslug($destination_pro_cat_datas['id']);
				$productdetailslink =  $this->config->site_url().$category_slugs.'/voyages/'.$product_slugs;
				
					$return_res .='<div class="listitempage" data-url="'.$current_url_desti.'?page='.$current_page.'">';
						$return_res .='<div class="listitem" data-page-url="'.$current_url_desti.'?page='.$current_page.'">';
						$return_res .='<div class="product_details"><div class="pro_thumb_image">
							<a href="'.$productdetailslink.'">';
									if(isset($productdetails[0]["featured_image"]) && !empty($productdetails[0]["featured_image"])){
										$return_res .= '<img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/product/featuredimage/original/'.$productdetails[0]['featured_image'].'&h=250&w=250&c=1" border="0" title="'.$productdetails[0]['product_name'].'" alt="'.$productdetails[0]['product_name'].'">';
									}else{ 
										$return_res .= '<img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/no_image250.jpg&h=250&w=250&c=1" alt="'.$productdetails[0]['product_name'].'" title="'.$productdetails[0]["product_name"].'" border="0">';
									}
								$return_res .='
							</a></div><div class="pro_thumb_image_right">
							<h2><a href="'.$productdetailslink.'">
								'.$productdetails[0]["product_name"].'
							</a></h2>	
							<h3><a href="'.$productdetailslink.'">
								'.$productdetails[0]["subtitle"].'
							</a></h3>								
							<div class="short_description">
								<p>'.$productdetails[0]["short_description"].'</p>
							</div>
							<div class="short_threepoint">
								<p>'.$productdetails[0]["short_point"].'</p>
							</div>
							<span class="nightformprice">
								<label>'.$productdetails[0]["number_of_nights"].' nuits à partir de</label> <span>'.$productdetails[0]["price"].' &#8364;</span> <sup>/ Pers</sup>
								<a href="'.$productdetailslink.'">En savoir plus</a>
							</span>
							</div>
						</div></div></div>';
								
			}
		}
		$return['prev_url']    = $current_url_desti.'?page='.$prevpage;
		$return['response']    = $return_res; 
		//$arr = array_map('utf8_encode', $return);
		echo json_encode($return);
	}
	
	function date_clientreview_french2 ($date)
	{
		$month_name=array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août",
		"Septembre","Octobre","Novembre","Décembre");

		$split = preg_split('/-/', $date);
		$year = $split[0];
		$month = round($split[1]);
		$day = round($split[2]);

		$week_day = date("w", mktime(12, 0, 0, $month, $day, $year));
		return $date_fr = $month_name[$month] .' '. $year;
	}
	function autoload_clientreview()
	{
		header('Content-Type: text/html; charset=utf-8');
		$total_row						= $this->clientreviewmodel->gettotalclientreview($this->lang->line('CLIENT_REVIEW_LIMIT'));
		$config['base_url']		    	= $this->config->site_url().'lavis-de-nos-clients?page=';
		$config['total_rows']	    	= $total_row;
		$config['per_page'] 			= $this->lang->line('CLIENT_REVIEW_LIMIT');
		$config['use_page_numbers'] 	= TRUE;
		 $config['num_links'] 			= $total_row;
		$config['cur_tag_open'] 		= '&nbsp;<a class="current">';
        $config['cur_tag_close'] 		= '</a>';
        $config['next_link']			= 'Next';
        $config['prev_link'] 			= 'Previous';
		$this->pagination->initialize($config);
		
		$pages = $this->input->get('page', TRUE);
		
		if (isset($pages) && !empty($pages)) { $page  = $pages; } else { $page=1; }; 
		$start_from = ($page-1) * $this->lang->line('CLIENT_REVIEW_LIMIT'); 
		
		$nextpage = $page + 1;
		$prevpage = $page - 1;
		
		$filterbydate  = $this->input->get("date");
		$filterbydesti = $this->input->get("destination");
		$filtercondition = '';
		
	
		$return["filteroption"] = '';
		if(isset($filterbydate) && !empty($filterbydate) && empty($filterbydesti))
		{
			$explodemonthyear  		 = explode('-',$filterbydate);
			$filterbydatemonth 		 = $explodemonthyear[0];
			$filterbydateyear  		 = $explodemonthyear[1];
			$filtercondition   		 = " AND MONTH(review_date) = '".$filterbydatemonth."' AND YEAR(review_date)= '".$filterbydateyear."'";
			$nextpage          		.= "&date=".$filterbydate;
			$prevpage          		.= "&date=".$filterbydate;
			$return["filteroption"]  = "&date=".$filterbydate;
		}
		else if(isset($filterbydesti) && !empty($filterbydesti) && empty($filterbydate))
		{
			$filtercondition 	= " AND destination_id LIKE '%".$filterbydesti."%'";
			$nextpage          .= "&destination=".$filterbydesti;
			$prevpage          .= "&destination=".$filterbydesti;
			$return["filteroption"]  = "&destination=".$filterbydesti;
		}
		else if(isset($filterbydesti) && !empty($filterbydesti) && isset($filterbydate) && !empty($filterbydate))
		{
			$explodemonthyear  = explode('-',$filterbydate);
			$filterbydatemonth = $explodemonthyear[0];
			$filterbydateyear  = $explodemonthyear[1];
			$filtercondition = " AND MONTH(review_date) = '".$filterbydatemonth."' AND YEAR(review_date)= '".$filterbydateyear."' AND destination_id LIKE '%".$filterbydesti."%'";
			$nextpage          .= "&date=".$filterbydate."&destination=".$filterbydesti;
			$prevpage          .= "&date=".$filterbydate."&destination=".$filterbydesti;
			$return["filteroption"]  = "&date=".$filterbydate."&destination=".$filterbydesti;
		} 
		
		$results			   = $this->clientreviewmodel->clientreviewAlldata($config["per_page"], $start_from,$filtercondition);
		$str_links 			   = $this->pagination->create_links();
        $this->data["links"]   = explode('&nbsp;',$str_links );
		$current_page = $pages;
		
		$return = array();
		if($page < $total_row){
			 $return["next_data_url"] = $this->config->site_url().'ajaxcall/autoload_clientreview?page='.$nextpage.'';
		}else{
			 $return["next_data_url"] = '';
		}
		if($page != 1){
			 $return["prev_data_url"] = $this->config->site_url().'ajaxcall/autoload_clientreview?page='.$prevpage.'';
		}else{
			 $return["prev_data_url"] ='';
		}
		$return['current_url'] = $this->config->site_url().'lavis-de-nos-clients?page='.$page;
		$return['next_url']    = $this->config->site_url().'lavis-de-nos-clients?page='.$nextpage;
		
		
		$return_res = '';
		if(isset($results) && !empty($results))
		{
			foreach($results as $clientreview_datas)
			{
				$return_res .= '<div class="listitempage" data-url="'.$this->config->site_url().'lavis-de-nos-clients?page='.$current_page.'">';
				$return_res .= '<div class="listitem" data-page-url="'.$this->config->site_url().'lavis-de-nos-clients?page='.$current_page.'">';
				$return_res .='<div class="clientreview_details_row"><div class="clientreview_details_cols">';
						if(isset($clientreview_datas["client_review_image"]) && !empty($clientreview_datas["client_review_image"])){
							$return_res .= '<img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/clientreview/original/'.$clientreview_datas['client_review_image'].'&h=250&w=250&c=1" alt="'.$clientreview_datas['name'].'" title="'.$clientreview_datas['name'].'">';
						}else{ 
							$return_res .= '<img  width="250px" height="250px" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/no_image250.jpg&h=250&w=250&c=1" alt="'.$clientreview_datas['name'].'" title="'.$clientreview_datas['name'].'" border="0">';
						}
				$return_res .='</div>';
				$return_res .='<div class="clientreview_details_cols1"><h3>'.$clientreview_datas['name'].'</h3>';
				$clientreviewdate = date('Y-m-d',strtotime($clientreview_datas['review_date']));
				$return_res .='<h4>'.$clientreview_datas['thems_name'].' - '.$this->date_clientreview_french2($clientreviewdate).'</h4>';
				$categoryids 	= explode(',',$clientreview_datas['destination_id']);
				$destinatitotal = count($categoryids);
				if(isset($categoryids) && !empty($categoryids))
				{	$i = 0;
					$return_res .='<h5>';
					foreach($categoryids as $destinationids)
					{
						if($i == $destinatitotal - 1 )
						{
							$comma = '';
						}
						else
						{
							$comma = ' - ';
						}
						$categorydetails  =  $this->commonlibmodel->getcategoryname($destinationids);
						$return_res .= $categorydetails[0]['category_name'].$comma;
						$i++;
					}
					$return_res .='</h5>';
				}
				else
				{
					$return_res .='<h5>-</h5>';
				}
				$return_res .='<div class="clientreview_details_cols1_row"><div class="clientreview_details_cols1_row1">'.$clientreview_datas['client_review'].'</div></div></div></div></div>';
				$return_res .='</div></div>';
				
			}
		}
		
		$return['prev_url']    = $this->config->site_url().'lavis-de-nos-clients?page='.$prevpage;
		$return['response']    = $return_res; 
		//$arr = array_map('utf8_encode', $return);
		echo json_encode($return); 
		
	}
	
	function autoload_blogdata()
	{
		header('Content-Type: text/html; charset=utf-8');
		$current_url_desti 				= $_SERVER['HTTP_REFERER'];
		if(isset($_GET['page']) && !empty($_GET['page']))
		{
		$current_url_desti =strtok($_SERVER["HTTP_REFERER"],'?');
		}
		$total_row						= $this->frontblogmodel->gettotalblogALL($this->lang->line('CLIENT_BLOG_LIMIT'));
		$config['base_url']		    	= $current_url_desti.'?page=';
		$config['total_rows']	    	= $total_row;
		$config['per_page'] 			= $this->lang->line('CLIENT_BLOG_LIMIT');
		$config['use_page_numbers'] 	= TRUE;
		$config['num_links'] 			= $total_row;
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
		
		$results = $this->frontblogmodel->getallblogsALL($config["per_page"],$start_from);
		$str_links 			   = $this->pagination->create_links();
        $this->data["links"]   = explode('&nbsp;',$str_links );
		$current_page = $pages;
		
		$return = array();
		
		if($page < $total_row){
			 $return["next_data_url"] = $this->config->site_url().'ajaxcall/autoload_blogdata?page='.$nextpage;
		}else{
			 $return["next_data_url"] = '';
		}
		if($page != 1){
			 $return["prev_data_url"] = $this->config->site_url().'ajaxcall/autoload_blogdata?page='.$prevpage;
		}else{
			 $return["prev_data_url"] ='';
		}
		$return['current_url'] = $current_url_desti.'?page='.$page;
		$return['next_url']    = $current_url_desti.'?page='.$nextpage;
		
		$return_res = '';
		if(isset($results) && !empty($results))
		{
			foreach($results as $blogdata)
			{
				$articleY =  date('Y',strtotime($blogdata['created_date']));
				$articleM =  date('m',strtotime($blogdata['created_date']));
				$singlebloglink = $this->config->base_url().'blog/'.$articleY.'/'.$articleM.'/'.$blogdata['slug'];
				$return_res .='<div class="listitempage" data-url="'.$current_url_desti.'?page='.$current_page.'">';
				$return_res .='<div class="listitem" data-page-url="'.$current_url_desti.'?page='.$current_page.'">';
				$return_res .='<div class="clientreview_details_row"><div class="clientreview_details_cols">';
						if(isset($blogdata['featured_image']) && !empty($blogdata['featured_image'])){
							$return_res .='<a href="'.$singlebloglink.'" title="'.$blogdata['blog_title'].'"><img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/blog/featuredimage/original/'.$blogdata['featured_image'].'&h=250&w=250&c=1"></a>';
						}else{
							$return_res .= '<img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/no_image250.jpg&h=250&w=250&c=1" alt="'.$blogdata['blog_title'].'" title="'.$blogdata["blog_title"].'" border="0">';
										
						}
				$return_res .='</div>';
				$return_res .='<div class="artical_cols1"><div class="blog_cols1"><h2><a href="'.$singlebloglink.'">'.$blogdata['blog_title'].'</a></h2>';
				$archivedate2 = date('Y-m-d',strtotime($blogdata['blog_date']));
				$return_res .='<span class="date">'.$this->date_in_french2($archivedate2).'</span>';
				$return_res .='<div class="blog_content_row">'.$this->string_limit($blogdata['blog_content'],340).'</div><a href="'.$singlebloglink.'" class="blog_btn_right">Lire la suite</a></div></div></div></div></div>';
				
			}
		}
		$return['prev_url']    = $current_url_desti.'?page='.$prevpage;
		$return['response']    = $return_res; 
		//$arr = array_map('utf8_encode', $return);
		echo json_encode($return); 
	}
	
	function autocomplete_search()
	{
		header('Content-Type: text/html; charset=utf-8');
		
		$user_input				 = 	$this->input->get("term");
		$autocomplateproduct     =  $this->voyagesmodel->autocomplete_search($user_input);
		
		$display_json = array();
		$json_arr = array();
		$comlid = new Commonlibmodel();
		if(isset($autocomplateproduct) && !empty($autocomplateproduct))
		{
			foreach($autocomplateproduct as $autocomplateproducts)
			{
				//$proidtocatslug 	=  $this->voyagesmodel->getproducttocatslug($autocomplateproducts['id']);
				$proidtocatslug 	=  $comlid->getproducturl($autocomplateproducts['id']);
				$url 				=  $this->config->site_url().$proidtocatslug.'/voyages/'.$autocomplateproducts['slug'];				
				$json_arr["id"] 	=  $url;
				$json_arr["value"]  =  $autocomplateproducts['slug'];
				$json_arr["label"]  =  $autocomplateproducts['product_name'];
				array_push($display_json, $json_arr);
			}
		}
		else
		{
			$json_arr["id"] = "#";
			$json_arr["value"] = "";
			$json_arr["label"] = "";
			array_push($display_json, $json_arr);
		}
		$jsonWrite = json_encode($display_json);
		
		print_r($jsonWrite);

	}
	
	function string_limit($string, $limit) { 
		$string = strip_tags($string);
		if (strlen($string) > $limit) {
			// truncate string
			$stringCut = substr($string, 0, $limit);
			// make sure it ends in a word so assassinate doesn't become ass...
			$string = substr($stringCut, 0, strrpos($stringCut, ' '))	; 
		}
		return $string;
	}
	function date_in_french2 ($date)
	{
		$month_name=array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août",
		"Septembre","Octobre","Novembre","Décembre");

		$split = preg_split('/-/', $date);
		$year = $split[0];
		$month = round($split[1]);
		$day = round($split[2]);

		$week_day = date("w", mktime(12, 0, 0, $month, $day, $year));
		return $date_fr = $day.' '.$month_name[$month] .' '. $year;
	}
	
	
	function autoload_categoryblogdata()
	{
		header('Content-Type: text/html; charset=utf-8');
		$id 							= $this->input->get('id', TRUE);
		$current_url_desti 				= $_SERVER['HTTP_REFERER'];
		if(isset($_GET['page']) && !empty($_GET['page']))
		{
		$current_url_desti =strtok($_SERVER["HTTP_REFERER"],'?');
		}
		$total_row						= $this->frontblogmodel->gettotalcategoryblogALL($this->lang->line('CLIENT_BLOG_LIMIT'),$id);
		$config['base_url']		    	= $current_url_desti.'?page=';
		$config['total_rows']	    	= $total_row;
		$config['per_page'] 			= $this->lang->line('CLIENT_BLOG_LIMIT');
		$config['use_page_numbers'] 	= TRUE;
		$config['num_links'] 			= $total_row;
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
		
		$results = $this->frontblogmodel->getcategoryblogsALL($config["per_page"],$start_from,$id);
		$str_links 			   = $this->pagination->create_links();
        $this->data["links"]   = explode('&nbsp;',$str_links );
		$current_page = $pages;
		
		$return = array();
		
		if($page < $total_row){
			 $return["next_data_url"] = $this->config->site_url().'ajaxcall/autoload_categoryblogdata?page='.$nextpage.'&id='.$id;
		}else{
			 $return["next_data_url"] = '';
		}
		if($page != 1){
			 $return["prev_data_url"] = $this->config->site_url().'ajaxcall/autoload_categoryblogdata?page='.$prevpage.'&id='.$id;
		}else{
			 $return["prev_data_url"] ='';
		}
		$return['current_url'] = $current_url_desti.'?page='.$page.'&id='.$id;
		$return['next_url']    = $current_url_desti.'?page='.$nextpage;
		
		$return_res = '';
		if(isset($results) && !empty($results))
		{
			foreach($results as $blogdata)
			{
				$articleY =  date('Y',strtotime($blogdata['created_date']));
				$articleM =  date('m',strtotime($blogdata['created_date']));
				$singlebloglink = $this->config->base_url().'blog/'.$articleY.'/'.$articleM.'/'.$blogdata['slug'];
				$return_res .='<div class="listitempage" data-url="'.$current_url_desti.'?page='.$current_page.'">';
				$return_res .='<div class="listitem" data-page-url="'.$current_url_desti.'?page='.$current_page.'">';
				$return_res .='<div class="clientreview_details_row"><div class="clientreview_details_cols">';
						if(isset($blogdata['featured_image']) && !empty($blogdata['featured_image'])){
							$return_res .='<a href="'.$singlebloglink.'" title="'.$blogdata['blog_title'].'"><img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/blog/featuredimage/original/'.$blogdata['featured_image'].'&h=250&w=250&c=1"></a>';
						}else{
							$return_res .= '<img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/no_image250.jpg&h=250&w=250&c=1" alt="'.$blogdata['blog_title'].'" title="'.$blogdata["blog_title"].'" border="0">';
										
						}
				$return_res .='</div>';
				$return_res .='<div class="artical_cols1"><div class="blog_cols1"><h2><a href="'.$singlebloglink.'">'.$blogdata['blog_title'].'</a></h2>';
				$archivedate2 = date('Y-m-d',strtotime($blogdata['blog_date']));
				$return_res .='<span class="date">'.$this->date_in_french2($archivedate2).'</span>';
				$return_res .='<div class="blog_content_row">'.$this->string_limit($blogdata['blog_content'],340).'</div><a href="'.$singlebloglink.'" class="blog_btn_right">Lire la suite</a></div></div></div></div></div>';
				
			}
		}
		$return['prev_url']    = $current_url_desti.'?page='.$prevpage;
		$return['response']    = $return_res; 
		//$arr = array_map('utf8_encode', $return);
		echo json_encode($return); 
	}
	
	function autoload_archiveblogdata()
	{	
		header('Content-Type: text/html; charset=utf-8');
		$year = $this->input->get("year");
		$month = $this->input->get("month");
		$current_url_desti 				= $_SERVER['HTTP_REFERER'];
		if(isset($_GET['page']) && !empty($_GET['page']))
		{
		$current_url_desti =strtok($_SERVER["HTTP_REFERER"],'?');
		}
		$total_row						= $this->frontblogmodel->gettotalarchiveblogALL($this->lang->line('CLIENT_BLOG_LIMIT'),$year,$month);
		$config['base_url']		    	= $current_url_desti.'?page=';
		$config['total_rows']	    	= $total_row;
		$config['per_page'] 			= $this->lang->line('CLIENT_BLOG_LIMIT');
		$config['use_page_numbers'] 	= TRUE;
		$config['num_links'] 			= $total_row;
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
		
		$results = $this->frontblogmodel->getarchiveblogsALL($config["per_page"],$start_from,$year,$month);
		$str_links 			   = $this->pagination->create_links();
        $this->data["links"]   = explode('&nbsp;',$str_links );
		$current_page = $pages;
		
		$return = array();
		
		if($page < $total_row){
			 $return["next_data_url"] = $this->config->site_url().'ajaxcall/autoload_archiveblogdata?page='.$nextpage.'&year='.$year.'&month='.$month;
		}else{
			 $return["next_data_url"] = '';
		}
		if($page != 1){
			 $return["prev_data_url"] = $this->config->site_url().'ajaxcall/autoload_archiveblogdata?page='.$prevpage.'&year='.$year.'&month='.$month;
		}else{
			 $return["prev_data_url"] ='';
		}
		$return['current_url'] = $current_url_desti.'?page='.$page.'&year='.$year.'&month='.$month;
		$return['next_url']    = $current_url_desti.'?page='.$nextpage;
		
		$return_res = '';
		if(isset($results) && !empty($results))
		{
			foreach($results as $blogdata)
			{
				$articleY =  date('Y',strtotime($blogdata['created_date']));
				$articleM =  date('m',strtotime($blogdata['created_date']));
				$singlebloglink = $this->config->base_url().'blog/'.$articleY.'/'.$articleM.'/'.$blogdata['slug'];
				$return_res .='<div class="listitempage" data-url="'.$current_url_desti.'?page='.$current_page.'">';
				$return_res .='<div class="listitem" data-page-url="'.$current_url_desti.'?page='.$current_page.'">';
				$return_res .='<div class="clientreview_details_row"><div class="clientreview_details_cols">';
						if(isset($blogdata['featured_image']) && !empty($blogdata['featured_image'])){
							$return_res .='<a href="'.$singlebloglink.'" title="'.$blogdata['blog_title'].'"><img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/blog/featuredimage/original/'.$blogdata['featured_image'].'&h=250&w=250&c=1"></a>';
						}else{
							$return_res .= '<img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/no_image250.jpg&h=250&w=250&c=1" alt="'.$blogdata['blog_title'].'" title="'.$blogdata["blog_title"].'" border="0">';
										
						}
				$return_res .='</div>';
				$return_res .='<div class="artical_cols1"><div class="blog_cols1"><h2><a href="'.$singlebloglink.'">'.$blogdata['blog_title'].'</a></h2>';
				$archivedate2 = date('Y-m-d',strtotime($blogdata['blog_date']));
				$return_res .='<span class="date">'.$this->date_in_french2($archivedate2).'</span>';
				$return_res .='<div class="blog_content_row">'.$this->string_limit($blogdata['blog_content'],340).'</div><a href="'.$singlebloglink.'" class="blog_btn_right">Lire la suite</a></div></div></div></div></div>';
				
			}
		}
		$return['prev_url']    = $current_url_desti.'?page='.$prevpage;
		$return['response']    = $return_res; 
		//$arr = array_map('utf8_encode', $return);
		echo json_encode($return);
	}
	/*function autoload_productdata()
	{
		$id = $this->input->post("id");
		$items_per_group = $this->lang->line('PRODUCT_LIMIT');
		
		//sanitize post value
		$group_number = filter_var($this->input->post("group_no"), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		
		//get current starting point of records
		$position = ($group_number * $items_per_group);
		$tagsfilter 		= $this->input->post("tagsfilter");
		$tagsfiltersecound  = $this->input->post("tagsfiltersecound");
		
		
		if(isset($tagsfilter) && !empty($tagsfilter))
		{
			$tagsfilter2 		= $this->commonlibmodel->getslugtotag($this->input->post("tagsfilter"));
		}
		if(isset($tagsfiltersecound) && !empty($tagsfiltersecound))
		{
			$tagsfiltersecound 		= $this->commonlibmodel->getslugtotag($this->input->post("tagsfiltersecound"));
		}
		
		$pricefilter 		= $this->input->post("price");
		$hitsfilter 		= $this->input->post("hits");
		$filterdata         = '';
		$filterdata_order   = '';
		
		if(isset($tagsfilter2) && !empty($tagsfilter2) && empty($tagsfiltersecound))
		{
			$filterdata .= ' AND (FIND_IN_SET("'.$tagsfilter2.'",p.primary) OR FIND_IN_SET("'.$tagsfilter2.'",p.secondary))';
		}
		else if(isset($tagsfilter2) && !empty($tagsfilter2) && isset($tagsfiltersecound) && !empty($tagsfiltersecound))
		{
			$filterdata .= ' AND (FIND_IN_SET("'.$tagsfilter2.'",p.primary) AND FIND_IN_SET("'.$tagsfiltersecound.'",p.secondary))';
		}
		else if(isset($tagsfiltersecound) && !empty($tagsfiltersecound) && empty($tagsfilter2))
		{
			$filterdata .= ' AND (FIND_IN_SET("'.$tagsfiltersecound.'",p.primary) OR FIND_IN_SET("'.$tagsfiltersecound.'",p.secondary))';
		}
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
		
		$destination_pro_cat_data = $this->destinationmodel->getdestinationproductdata($id,$position,$items_per_group,$filterdata,$filterdata_order);
		//print_R($destination_pro_cat_data);exit;
		$html = '';
		if(isset($destination_pro_cat_data) && !empty($destination_pro_cat_data))
		{
			foreach($destination_pro_cat_data as $destination_pro_cat_datas)
			{
				
				$productdetails     =  $this->destinationmodel->getproductdetails($destination_pro_cat_datas['product_id']);
				$category_slugs     =  $this->commonlibmodel->getproducturl($destination_pro_cat_datas['product_id']);
				$product_slugs      =  $this->commonlibmodel->producttoslug($destination_pro_cat_datas['product_id']);
				$productdetailslink =  $this->config->site_url().$category_slugs.'/voyages/'.$product_slugs;
				
				$html .='<div class="product_details"><div class="pro_thumb_image">
							<a href="'.$productdetailslink.'">';
									if(isset($productdetails[0]["featured_image"]) && !empty($productdetails[0]["featured_image"])){
										$html .= '<img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/product/featuredimage/original/'.$productdetails[0]['featured_image'].'&h=250&w=250&c=1" border="0" title="'.$productdetails[0]['product_name'].'" alt="'.$productdetails[0]['product_name'].'">';
									}else{ 
										$html .= '<img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/no_image250.jpg&h=250&w=250&c=1" alt="'.$productdetails[0]['product_name'].'" title="'.$productdetails[0]["product_name"].'" border="0">';
									}
								$html .='
							</a></div><div class="pro_thumb_image_right">
							<h2><a href="'.$productdetailslink.'">
								'.$productdetails[0]["product_name"].'
							</a></h2>
							<h3><a href="'.$productdetailslink.'">
								'.$productdetails[0]["subtitle"].'
							</a></h3>							
							<div class="short_description">
								<p>'.$productdetails[0]["short_description"].'</p>
							</div>
							<div class="short_threepoint">
								<p>'.$productdetails[0]["short_point"].'</p>
							</div>
							<span class="nightformprice">
								<label>'.$productdetails[0]["number_of_nights"].' nuits à partir de</label> <span>'.$productdetails[0]["price"].' &#8364;</span> <sup>/ Pers</sup>
								<a href="'.$productdetailslink.'">En savoir plus</a>
							</span>
							</div>
						</div>';
								
			}
		}
		echo  $html;
	}*/
	
	/*function autoload_archiveblogdata()
	{
		$items_per_group = $this->lang->line('CLIENT_BLOG_LIMIT');
		//sanitize post value
		$group_number = filter_var($this->input->post("group_no"), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		$year = $this->input->post("year");
		$month = $this->input->post("month");
		//get current starting point of records
		$position = ($group_number * $items_per_group);
		$clientreview_data = $this->frontblogmodel->getarchiveblogs($position,$items_per_group,$year,$month);
		$html = '';
		
		if(isset($clientreview_data) && !empty($clientreview_data))
		{	
			foreach($clientreview_data as $blogdata)
			{
				$articleY =  date('Y',strtotime($blogdata['created_date']));
				$articleM =  date('m',strtotime($blogdata['created_date']));
				$singlebloglink = $this->config->base_url().'blog/'.$articleY.'/'.$articleM.'/'.$blogdata['slug'];
				$html .='<div class="clientreview_details_row"><div class="clientreview_details_cols">';
						if(isset($blogdata['featured_image']) && !empty($blogdata['featured_image'])){
							$html .='<a href="'.$singlebloglink.'" title="'.$blogdata['blog_title'].'"><img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/blog/featuredimage/original/'.$blogdata['featured_image'].'&h=250&w=250&c=1"></a>';
						}else{
							$html .= '<img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/no_image250.jpg&h=250&w=250&c=1" alt="'.$blogdata['blog_title'].'" title="'.$blogdata["blog_title"].'" border="0">';
						}
				$html .='</div>';
				$html .='<div class="artical_cols1"><div class="blog_cols1"><h2><a href="'.$singlebloglink.'">'.$blogdata['blog_title'].'</a></h2>';
				$archivedate2 = date('Y-m-d',strtotime($blogdata['blog_date']));
				$html .='<span class="date">'.$this->date_in_french2($archivedate2).'</span>';
				$html .='<div class="blog_content_row">'.$this->string_limit($blogdata['blog_content'],340).'</div><a href="'.$singlebloglink.'" class="blog_btn_right">Lire la suite</a></div></div></div>';
				
			}
		}
		
		echo  $html;
	}*/
	/*function autoload_blogdata()
	{
		$items_per_group = $this->lang->line('CLIENT_BLOG_LIMIT');
		//sanitize post value
		$group_number = filter_var($this->input->post("group_no"), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		//get current starting point of records
		$position = ($group_number * $items_per_group);
		
		$clientreview_data = $this->frontblogmodel->getallblogs($position,$items_per_group);
		$html = '';
		if(isset($clientreview_data) && !empty($clientreview_data))
		{	
			foreach($clientreview_data as $blogdata)
			{
				$articleY =  date('Y',strtotime($blogdata['created_date']));
				$articleM =  date('m',strtotime($blogdata['created_date']));
				$singlebloglink = $this->config->base_url().'blog/'.$articleY.'/'.$articleM.'/'.$blogdata['slug'];
				$html .='<div class="clientreview_details_row"><div class="clientreview_details_cols">';
						if(isset($blogdata['featured_image']) && !empty($blogdata['featured_image'])){
							$html .='<a href="'.$singlebloglink.'" title="'.$blogdata['blog_title'].'"><img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/blog/featuredimage/original/'.$blogdata['featured_image'].'&h=250&w=250&c=1"></a>';
						}else{
							$html .= '<img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/no_image250.jpg&h=250&w=250&c=1" alt="'.$blogdata['blog_title'].'" title="'.$blogdata["blog_title"].'" border="0">';
										
						}
				$html .='</div>';
				$html .='<div class="artical_cols1"><h2><a href="'.$singlebloglink.'">'.$blogdata['blog_title'].'</a></h2>';
				$archivedate2 = date('Y-m-d',strtotime($blogdata['blog_date']));
				$html .='<span class="date">'.$this->date_in_french2($archivedate2).'</span>';
				$html .='<div class="blog_content_row">'.$this->string_limit($blogdata['blog_content'],340).'</div><a href="'.$singlebloglink.'" class="blog_btn_right">Lire la suite</a></div></div>';
				
			}
		}
		echo  $html;
	}*/
	
	/*function autoload_categoryblogdata()
	{
		$items_per_group = $this->lang->line('CLIENT_BLOG_LIMIT');
		//sanitize post value
		$group_number = filter_var($this->input->post("group_no"), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		$catid = $this->input->post("catid");
		//get current starting point of records
		$position = ($group_number * $items_per_group);
		$clientreview_data = $this->frontblogmodel->getcategoryblogs($position,$items_per_group,$catid);
		$html = '';
		if(isset($clientreview_data) && !empty($clientreview_data))
		{	
			foreach($clientreview_data as $blogdata)
			{
				$articleY =  date('Y',strtotime($blogdata['created_date']));
				$articleM =  date('m',strtotime($blogdata['created_date']));
				$singlebloglink = $this->config->base_url().'blog/'.$articleY.'/'.$articleM.'/'.$blogdata['slug'];
				$html .='<div class="clientreview_details_row"><div class="clientreview_details_cols">';
						if(isset($blogdata['featured_image']) && !empty($blogdata['featured_image'])){
							$html .='<a href="'.$singlebloglink.'" title="'.$blogdata['blog_title'].'"><img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/blog/featuredimage/original/'.$blogdata['featured_image'].'&h=250&w=250&c=1"></a>';
						}else{
							$html .= '<img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/no_image250.jpg&h=250&w=250&c=1" alt="'.$blogdata['blog_title'].'" title="'.$blogdata["blog_title"].'" border="0">';
										
						}
				$html .='</div>';
				$html .='<div class="artical_cols1"><div class="blog_cols1"><h2><a href="'.$singlebloglink.'">'.$blogdata['blog_title'].'</a></h2>';
				$archivedate2 = date('Y-m-d',strtotime($blogdata['blog_date']));
				$html .='<span class="date">'.$this->date_in_french2($archivedate2).'</span>';
				$html .='<div class="blog_content_row">'.$this->string_limit($blogdata['blog_content'],340).'</div><a href="'.$singlebloglink.'" class="blog_btn_right">Lire la suite</a></div></div></div>';
				
			}
		}
		echo  $html;
	}*/
	/*function autoload_clientreview()
	{
		$items_per_group = $this->lang->line('CLIENT_REVIEW_LIMIT');
		
		//sanitize post value
		$group_number = filter_var($this->input->post("group_no"), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		
		//get current starting point of records
		$position = ($group_number * $items_per_group);
		
		
		$filterbydate  = $this->input->post("filterbydate");
		$filterbydesti = $this->input->post("filterbydesti");
		$filtercondition = '';
		
		if(isset($filterbydate) && !empty($filterbydate) && empty($filterbydesti))
		{
			$explodemonthyear  = explode('-',$filterbydate);
			$filterbydatemonth = $explodemonthyear[0];
			$filterbydateyear  = $explodemonthyear[1];
			$filtercondition   = " AND MONTH(review_date) = '".$filterbydatemonth."' AND YEAR(review_date)= '".$filterbydateyear."'";
		}
		else if(isset($filterbydesti) && !empty($filterbydesti) && empty($filterbydate))
		{
			$filtercondition = " AND destination_id LIKE '%".$filterbydesti."%'";
		}
		else if(isset($filterbydesti) && !empty($filterbydesti) && isset($filterbydate) && !empty($filterbydate))
		{
			$explodemonthyear  = explode('-',$filterbydate);
			$filterbydatemonth = $explodemonthyear[0];
			$filterbydateyear  = $explodemonthyear[1];
			$filtercondition = " AND MONTH(review_date) = '".$filterbydatemonth."' AND YEAR(review_date)= '".$filterbydateyear."' AND destination_id LIKE '%".$filterbydesti."%'";
		}
		
		$clientreview_data = $this->clientreviewmodel->getclientreviewdata($position,$items_per_group,$filtercondition);
		$html = '';
		if(isset($clientreview_data) && !empty($clientreview_data))
		{
			foreach($clientreview_data as $clientreview_datas)
			{
				
					$html .='<div class="clientreview_details_row"><div class="clientreview_details_cols">';
							if(isset($clientreview_datas["client_review_image"]) && !empty($clientreview_datas["client_review_image"])){
								$html .= '<img width="250" height="250" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/clientreview/original/'.$clientreview_datas['client_review_image'].'&h=250&w=250&c=1" alt="'.$clientreview_datas['name'].'" title="'.$clientreview_datas['name'].'">';
							}else{ 
								$html .= '<img  width="250px" height="250px" src="'.$this->config->site_url().'timthumb.php?src='.$this->config->site_url().'application/uploads/no_image250.jpg&h=250&w=250&c=1" alt="'.$clientreview_datas['name'].'" title="'.$clientreview_datas['name'].'" border="0">';
							}
					$html .='</div>';
					$html .='<div class="clientreview_details_cols1"><h3>'.$clientreview_datas['name'].'</h3>';
					$clientreviewdate = date('Y-m-d',strtotime($clientreview_datas['review_date']));
					$html .='<h4>'.$clientreview_datas['thems_name'].' - '.$this->date_clientreview_french2($clientreviewdate).'</h4>';
					
					
					
					$categoryids 	= explode(',',$clientreview_datas['destination_id']);
					$destinatitotal = count($categoryids);
					
					if(isset($categoryids) && !empty($categoryids))
					{	$i = 0;
						$html .='<h5>';
						foreach($categoryids as $destinationids)
						{
							if($i == $destinatitotal - 1 )
							{
								$comma = '';
							}
							else
							{
								$comma = ' - ';
							}
							$categorydetails  =  $this->commonlibmodel->getcategoryname($destinationids);
							$html .= $categorydetails[0]['category_name'].$comma;
							$i++;
						}
						$html .='</h5>';
					}
					else
					{
						$html .='<h5>-</h5>';
					}	
					$html .='<div class="clientreview_details_cols1_row"><div class="clientreview_details_cols1_row1">'.$clientreview_datas['client_review'].'</div></div></div></div>';
			}
		}
		else
		{	$html = '';
			$html = '<div class="no_recordfound_clientreview">'.$this->lang->line('CLIENT_REVIE_PAGE_NO_RECORD').'</div>';
		}
		echo  $html;
	}*/
	
	
	
}
?>