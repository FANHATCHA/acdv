<?php
class Ajaxcall extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->model("destinationmodel");
		$this->load->model("clientreviewmodel");
		$this->load->library('form_validation');
		$this->load->library("email");
		$this->load->model("commonlibmodel");
		/*======================= LOAD COMMON LIBRARY ===================*/
		$this->load->library('commonlib');
		/*======================= LOAD COMMON LIBRARY ===================*/
	}
	function autoload_productdata()
	{
		$id = $this->input->post("id");
		$items_per_group = $this->lang->line('PRODUCT_LIMIT');

		//sanitize post value
		$group_number = filter_var($this->input->post("group_no"), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		
		//get current starting point of records
		$position = ($group_number * $items_per_group);
		
		/* Ajax filter data */
		
		$primefilter 		= $this->input->post("primary");
		$secondaryfilter 	= $this->input->post("secondary");
		$pricefilter 		= $this->input->post("price");
		$hitsfilter 		= $this->input->post("hits");
		$filterdata         = '';
		$filterdata_order   = '';
	
		if(isset($primefilter) && !empty($primefilter))
		{
			$filterdata .= ' AND FIND_IN_SET("'.$primefilter.'",p.primary)';
		}
		if(isset($secondaryfilter) && !empty($secondaryfilter))
		{
			$filterdata .= ' AND FIND_IN_SET("'.$secondaryfilter.'",p.secondary)';
		}
		if(isset($pricefilter) && !empty($pricefilter) && !isset($hitsfilter))
		{
			$filterdata_order .= ' ORDER BY p.price '.$pricefilter.'';
		}
		if(isset($hitsfilter) && !empty($hitsfilter) && !isset($pricefilter))
		{
			$filterdata_order .= ' ORDER BY p.hits '.$hitsfilter.'';
		}
		
		$destination_pro_cat_data = $this->destinationmodel->getdestinationproductdata($id,$position,$items_per_group,$filterdata,$filterdata_order);
		$html = '';
		if(isset($destination_pro_cat_data) && !empty($destination_pro_cat_data))
		{
			foreach($destination_pro_cat_data as $destination_pro_cat_datas)
			{
				
				$productdetails     =  $this->destinationmodel->getproductdetails($destination_pro_cat_datas['product_id']);
				$category_slugs     =  $this->commonlibmodel->categorytoslug($destination_pro_cat_datas['cat_id']);
				$product_slugs      =  $this->commonlibmodel->producttoslug($destination_pro_cat_datas['product_id']);
				$productdetailslink =  $this->config->site_url().$category_slugs.'/voyages/'.$product_slugs;
				
				$html .='<div class="product_details">
							<a href="'.$productdetailslink.'">
								<div class="pro_thumb_image">';
									if(isset($productdetails[0]["featured_image"]) && !empty($productdetails[0]["featured_image"])){
										$html .= '<img src="'.$this->config->site_url().'application/uploads/product/featuredimage/thumb200/'.$productdetails[0]['featured_image'].'" alt="'.$productdetails[0]['product_name'].'" title="'.$productdetails[0]['product_name'].'">';
									}else{ 
										$html .= '<img  width="200px" height="200px" src="'.$this->config->site_url().'application/uploads/no_image100.jpg" alt="'.$productdetails[0]['product_name'].'" title="'.$productdetails[0]["product_name"].'" border="0">';
									}
								$html .='</div>
							</a>
							<a href="'.$productdetailslink.'">
								<h1>'.$productdetails[0]["product_name"].'</h1>
								<h2>'.$productdetails[0]["subtitle"].'</h2>
							</a>		
							<div class="short_description">
								<p>'.$productdetails[0]["short_description"].'</p>
							</div>
							<div class="short_threepoint">
								<p>'.$productdetails[0]["short_point"].'</p>
							</div>
							<span class="nightformprice">
								<a href="'.$productdetailslink.'">'.$productdetails[0]["number_of_nights"].' nuits à partir de '.$productdetails[0]["price"].' &#8364; / Pers</a>
							</span>
						</div>';
								
			}
		}
		echo  $html;
	}
	
	
	function filter_productsdata()
	{
		
		$id = $this->input->post("id");
		$items_per_group = $this->lang->line('PRODUCT_LIMIT');
		
		//sanitize post value
		$group_number = filter_var($this->input->post("group_no"), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		
		//get current starting point of records
		$position = ($group_number * $items_per_group);
		
		/* Ajax filter data */
		
		$primefilter 		= $this->input->post("primary");
		$secondaryfilter 	= $this->input->post("secondary");
		$pricefilter 		= $this->input->post("price");
		$hitsfilter 		= $this->input->post("hits");
		$filterdata         = '';
		$filterdata_order   = '';
		if(isset($primefilter) && !empty($primefilter))
		{
			$filterdata .= ' AND FIND_IN_SET("'.$primefilter.'",p.primary)';
		}
		if(isset($secondaryfilter) && !empty($secondaryfilter))
		{
			$filterdata .= ' AND FIND_IN_SET("'.$secondaryfilter.'",p.secondary)';
		}
		if(isset($pricefilter) && !empty($pricefilter))
		{
			$filterdata_order .= ' ORDER BY p.price '.$pricefilter.'';
		}
		if(isset($hitsfilter) && !empty($hitsfilter))
		{
			$filterdata_order .= ' ORDER BY p.hits '.$hitsfilter.'';
		}
		
		$destination_pro_cat_data = $this->destinationmodel->getdestinationproductdata($id,$position,$items_per_group,$filterdata,$filterdata_order);
		
		$html = '';
		if(isset($destination_pro_cat_data) && !empty($destination_pro_cat_data))
		{
			foreach($destination_pro_cat_data as $destination_pro_cat_datas)
			{
				
				$productdetails     =  $this->destinationmodel->getproductdetails($destination_pro_cat_datas['product_id']);
				$category_slugs     =  $this->commonlibmodel->categorytoslug($destination_pro_cat_datas['cat_id']);
				$product_slugs      =  $this->commonlibmodel->producttoslug($destination_pro_cat_datas['product_id']);
				$productdetailslink =  $this->config->site_url().$category_slugs.'/voyages/'.$product_slugs;
				$html .='<div class="product_details">
							<a href="'.$productdetailslink.'">
								<div class="pro_thumb_image">';
									if(isset($productdetails[0]["featured_image"]) && !empty($productdetails[0]["featured_image"])){
										$html .= '<img src="'.$this->config->site_url().'application/uploads/product/featuredimage/thumb200/'.$productdetails[0]['featured_image'].'" alt="'.$productdetails[0]['product_name'].'" title="'.$productdetails[0]['product_name'].'">';
									}else{ 
										$html .= '<img  width="200px" height="200px" src="'.$this->config->site_url().'application/uploads/no_image100.jpg" alt="'.$productdetails[0]['product_name'].'" title="'.$productdetails[0]["product_name"].'" border="0">';
									}
								$html .='</div>
							</a>
							<a href="'.$productdetailslink.'">
								<h1>'.$productdetails[0]["product_name"].'</h1>
								<h2>'.$productdetails[0]["subtitle"].'</h2>
							</a>		
							<div class="short_description">
								<p>'.$productdetails[0]["short_description"].'</p>
							</div>
							<div class="short_threepoint">
								<p>'.$productdetails[0]["short_point"].'</p>
							</div>
							<span class="nightformprice">
								<a href="'.$productdetailslink.'">'.$productdetails[0]["number_of_nights"].' nuits à partir de '.$productdetails[0]["price"].' &#8364; / Pers</a>
							</span>
						</div>';
								
			}
		}
		echo  $html;
		
	}
	
	
	
	
	function autoload_clientreview()
	{
		$items_per_group = $this->lang->line('CLIENT_REVIEW_LIMIT');
		
		//sanitize post value
		$group_number = filter_var($this->input->post("group_no"), FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		
		//get current starting point of records
		$position = ($group_number * $items_per_group);
		
		$clientreview_data = $this->clientreviewmodel->getclientreviewdata($position,$items_per_group);
		
		$html = '';
		if(isset($clientreview_data) && !empty($clientreview_data))
		{
			foreach($clientreview_data as $clientreview_datas)
			{
				$categorydetails  =  $this->commonlibmodel->getcategoryname($clientreview_datas['destination_id']);
				
					$html .='<div class="destination-image">';
							if(isset($categorydetails[0]["image"]) && !empty($categorydetails[0]["image"])){
								$html .= '<img src="'.$this->config->site_url().'application/uploads/destinationimage/categoryimage/thumb200/'.$categorydetails[0]['image'].'" alt="'.$categorydetails[0]['category_name'].'" title="'.$categorydetails[0]['category_name'].'">';
							}else{ 
								$html .= '<img  width="200px" height="200px" src="'.$this->config->site_url().'application/uploads/no_image200.jpg" alt="'.$categorydetails[0]['category_name'].'" title="'.$categorydetails[0]["category_name"].'" border="0">';
							}
					$html .='</div>';
					$html .='<h1>'.$clientreview_datas['name'].'</h1>';
					$html .='<h2>'.$clientreview_datas['thems_name'].','.date('F Y',strtotime($clientreview_datas['review_date'])).'</h2>';
					$html .='<h3>'.$categorydetails[0]['category_name'].'</h3>';
					$html .='<p>'.$clientreview_datas['client_review'].'</p>';
			}
		}
		echo  $html;
	}
	
}
?>