<?php
$commodel = new Commonlibmodel();$urlsegment = count($this->uri->segment_array());
$slug = $this->uri->segment_array();

$destslug  = array_slice($slug,-1,1);
$destslug1 = array_slice($slug,-2,1);
$destslug2 = array_slice($slug,-3,1);

$filtetagdatasecound = '';
$filtetagdata = '';
/* GET SLUG TO ID */
$filterdata = '';
if(isset($urlsegment) && !empty($urlsegment) && $urlsegment == '3')
{
	$commodel = new Commonlibmodel();
	$destinationmodel = new Destinationmodel();
	$slug = $this->uri->segment_array();
	
	
	$id = $commodel->getIdFromSlug('category_id','products_categories',$destslug1[0]);
	
	/* TAG DISPLAY FILE TAG */
	$tagsfilter2 		= $commodel->getslugtotag($destslug[0]);
	if(isset($tagsfilter2) && !empty($tagsfilter2))
	{
		$filterdata .= ' AND FIND_IN_SET("'.$tagsfilter2.'",p.primary) OR FIND_IN_SET("'.$tagsfilter2.'",p.secondary)';
	}
	/* TAG DISPLAY FILE TAG */
	
	$primarytag = $destinationmodel->getprimetags($id,$filterdata);
	$primarytagname = $commodel->getslugtotag($destslug[0]);
	$filtetagdata    = end($this->uri->segment_array());
	
	if(isset($primarytag) && !empty($primarytag) && isset($primarytagname) && !empty($primarytagname))
	{
		if(in_array($primarytagname,$primarytag))
		{
			$filtetagdata    = end($this->uri->segment_array());
		}
	}
}
else if(isset($urlsegment) && !empty($urlsegment) && $urlsegment == '4')
{
	$commodel = new Commonlibmodel();
	$slug = $this->uri->segment_array();
	$id = $commodel->getIdFromSlug('category_id','products_categories',$destslug2[0]);
	
	/* TAG DISPLAY FILE TAG */
	$secoundrytagfilter		 =  $destslug[0];
	$primaryagfilter		 =  explode('.',$destslug1[0]);
	
	
	$secoundryfilter 		 = $commodel->getslugtotag($secoundrytagfilter);
	$primaryfilter 		     = $commodel->getslugtotag($primaryagfilter[0]);
	if(isset($secoundryfilter) && !empty($secoundryfilter) && isset($primaryfilter))
	{
		$filterdata .= ' AND FIND_IN_SET("'.$primaryfilter.'",p.primary) AND FIND_IN_SET("'.$secoundryfilter.'",p.secondary)';
	}
	/* TAG DISPLAY FILE TAG */
	
	
	$filtetagdataprimery = explode('.',$destslug1[0]);
	$filtetagdata = $filtetagdataprimery[0];
	$filtetagdatasecound = end($this->uri->segment_array());
}
else
{
	$commodel = new Commonlibmodel();
	$slug = end($this->uri->segment_array());
	$id = $commodel->getIdFromSlug('category_id','products_categories',$slug);
}
/* GET SLUG TO ID */
$current_url_desti 				= $_SERVER['REQUEST_URI'];
?>
<script>
var filteroption = '<?php if(isset($_GET['hits']) && !empty($_GET['hits'])){ echo '&hits='.$_GET['hits'];}else if(isset($_GET['price']) && !empty($_GET['price'])){ echo '&price='.$_GET['price']; }?>';
initPaginator(filteroption);
</script>
<input type="hidden" value="" id="price-hidden">
<input type="hidden" value="" id="filter_element">

<input type="hidden" value="" id="hits-hidden">
<div class="destination">
	<?php if(isset($destination_slider) && !empty($destination_slider)){ ?>
	<div class="slider-wrapper theme-default">        
		<div class="slider_search">            	
			<div class="Social_slider">
				<?php 
				$comlibmod   = new Commonlibmodel();
				$socialmedialink = $comlibmod->getsocialiconSlider();
				foreach($socialmedialink as $socialmedialinks){	?>
					<a target="_blank" href="<?php echo $socialmedialinks['url']; ?>" class="<?php echo $socialmedialinks['name']; ?>"><?php echo $socialmedialinks['name']; ?></a>
				<?php } ?>
			</div>
			<div class="destnation-description">
				<?php if(isset($destinationdata[0]['h1_name']) && !empty($destinationdata[0]['h1_name'])){ ?>
					<h1><?php echo strtoupper($destinationdata[0]['h1_name']); ?></h1>
				<?php }else{ ?>
					<h1><?php echo strtoupper('Voyages - '.$destinationdata[0]['category_name']); ?></h1>
				<?php } ?>
				<?php echo $destinationdata[0]['category_description']; ?>
			</div>
		</div>
		<div id="slider" class="nivoSlider">
			<?php
			if(isset($destination_slider) && !empty($destination_slider))
			{ 	$i = 1;
				foreach($destination_slider as $destination_sliders)
				{?>
					<img width="1500" height="400" src="<?php echo $this->config->base_url();?>application/uploads/bannerimages/original/<?php echo $destination_sliders['banner_image']; ?>" title="#htmlcaption<?php echo $i;?>" alt="<?php echo $destinationdata[0]['category_name']; ?>" />
				<?php $i++;
				}
			}
			?>
		</div>
	</div>
	<?php } ?>

<div class="wrapper"> 
	<div id="filtre"><div class="destination-filterpart">
		<div class="breadcrumbs">
			<?php
			if(isset($breadcrumbs) && !empty($breadcrumbs))
			{
				echo $breadcrumbs;
			}
			?>
		</div>
		<div class="typedevoyage">
			<?php 
			$current_url_desti 				= $_SERVER['REQUEST_URI'];
			if(isset($_GET['page']) && !empty($_GET['page']))
			{
				$current_url_desti =strtok($_SERVER["REQUEST_URI"],'?');
				
			}
			
			if(isset($primetag) && !empty($primetag)){?>
				<h3 class="voyage" onclick="classaddtypedevoyage()">Type de Voyage</h3>  
				<div class="filter-part" id="typedevoyage_hide">
					<span>Filtrer par : </span>
					<?php 
					$comlibmod = new Commonlibmodel();
					$primaryactivess = '';
					foreach($primetag as $primetags){
					$slugprimarytags = $comlibmod->gettagtoslug($primetags);?>
						<a <?php if(isset($tagactive) && !empty($tagactive) && $slugprimarytags == $tagactive[0]){$primaryactivess= '1'; echo "class='active'";}else if(isset($primaryactive) && !empty($primaryactive) && $primaryactive == $slugprimarytags){ $primaryactivess= '1'; echo "class='active'";} ?> href="<?php echo $this->config->site_url();?>destination/<?php echo $destinationslg;?>/<?php echo $comlibmod->gettagtoslug($primetags); ?>#filtre"><?php echo $primetags; ?></a>
					<?php } ?>
					
				</div>
				<span class="destination_search_img" id="typedevoyage2_hide">
					<?php if(isset($primaryurl) && !empty($primaryurl) && !empty($primaryactivess)){?>
						<a class="destination_search_close" href="<?php echo $primaryurl;?>"><img src="<?php echo $this->config->site_url();?>assets/front/images/demande_ic3.png" alt="Reset Voyage Filter" title="Reset Voyage Filter"/></a>
					<?php } ?>
					<!--<img src="<?php //echo $this->config->site_url();?>assets/front/images/search_ic.png" alt="" />-->
					<div class="filter-part"><span>Classer par : </span></div>
				</span>
				<div class="ascdescbutton" id="typedevoyage3_hide">
					
					<?php if(isset($_GET['price']) && !empty($_GET['price']) && $_GET['price'] == 'asc'){?>
						<a id="price-asc" class="price-asc" value="" href="<?php echo $current_url_desti; ?>?page=1&price=desc"><label>Prix</label></a>
					<?php }else if(isset($_GET['price']) && !empty($_GET['price']) && $_GET['price'] == 'desc'){ ?>
						<a id="price-asc" class="price-asc1" value="" href="<?php echo $current_url_desti; ?>?page=1&price=asc"><label>Prix</label></a>
					<?php }else{ ?>
						<a id="price-asc" class="price-asc" value="" href="<?php echo $current_url_desti; ?>?page=1&price=desc"><label>Prix</label></a>
					<?php } ?>
					
					<?php if(isset($_GET['hits']) && !empty($_GET['hits']) && $_GET['hits'] == 'asc'){?>
						<a id="hits-asc" class="price-asc" value="" href="<?php echo $current_url_desti; ?>?page=1&hits=desc"><label>Plus consultés</label></a>
					<?php }else if(isset($_GET['hits']) && !empty($_GET['hits']) && $_GET['hits'] == 'desc'){ ?>
						<a id="hits-asc" class="price-asc1" value="" href="<?php echo $current_url_desti; ?>?page=1&hits=asc"><label>Plus consultés</label></a>
					<?php }else{ ?>
						<a id="hits-asc" class="price-asc" value="" href="<?php echo $current_url_desti; ?>?page=1&hits=desc"><label>Plus consultés</label></a>
					<?php } ?>
				</div>
			<?php }else{	?>
				<h3 class="voyage" onclick="classaddtypedevoyage()">Type de Voyage</h3>  
				<div class="filter-part" id="typedevoyage_hide">
					<span>Filtrer par : </span>
					<span class="destination_search_img" id="typedevoyage2_hide">
					<!--<img src="<?php //echo $this->config->site_url();?>assets/front/images/search_ic.png" alt="" />-->
					<div class="filter-part"><span>Classer par : </span></div>
					</span>
					<div class="ascdescbutton" id="typedevoyage3_hide">
						<?php if(isset($_GET['price']) && !empty($_GET['price']) && $_GET['price'] == 'asc'){?>
						<a id="price-asc" class="price-asc" value="" href="<?php echo $current_url_desti; ?>?page=1&price=desc"><label>Prix</label></a>
					<?php }else if(isset($_GET['price']) && !empty($_GET['price']) && $_GET['price'] == 'desc'){ ?>
						<a id="price-asc" class="price-asc1" value="" href="<?php echo $current_url_desti; ?>?page=1&price=asc"><label>Prix</label></a>
					<?php }else{ ?>
						<a id="price-asc" class="price-asc" value="" href="<?php echo $current_url_desti; ?>?page=1&price=desc"><label>Prix</label></a>
					<?php } ?>
					
					<?php if(isset($_GET['hits']) && !empty($_GET['hits']) && $_GET['hits'] == 'asc'){?>
						<a id="hits-asc" class="price-asc" value="" href="<?php echo $current_url_desti; ?>?page=1&hits=desc"><label>Plus consultés</label></a>
					<?php }else if(isset($_GET['hits']) && !empty($_GET['hits']) && $_GET['hits'] == 'desc'){ ?>
						<a id="hits-asc" class="price-asc1" value="" href="<?php echo $current_url_desti; ?>?page=1&hits=asc"><label>Plus consultés</label></a>
					<?php }else{ ?>
						<a id="hits-asc" class="price-asc" value="" href="<?php echo $current_url_desti; ?>?page=1&hits=desc"><label>Plus consultés</label></a>
					<?php } ?>
					</div>
				</div>	
			<?php }?>	
       </div>
		<?php if(isset($secoundrytag) && !empty($secoundrytag) && count($secoundrytag) > 1){ ?>
		<div class="themes">
			<h3 class="thme" onclick="classadd();">Thèmes</h3>   
			<div class="filter-part" id="themes_hide">
				<span>Filtrer par : </span>
                <div class="filter-part-cols">
				<?php 
				$comlibmod = new Commonlibmodel();
				$secoundryactivess = '';
				foreach($secoundrytag as $secoundrytags){
					$tagslug = $comlibmod->gettagtoslug($secoundrytags);
					if(isset($destination_primery) && !empty($destination_primery))
					{
						$secoundtaglink = $this->config->site_url().'destination/'.$destinationslg.'/'.$destination_primery.'/'.$tagslug;
					}
					else
					{
						$secoundtaglink = $this->config->site_url().'destination/'.$destinationslg.'/'.$tagslug;
					}
					//print_r($tagactive[0]);
					?>
					<a <?php if(isset($tagactive) && !empty($tagactive) && $tagslug == $tagactive[0]){ $secoundryactivess = '1'; echo "class='active'";}else if(isset($secoundryactive) && !empty($secoundryactive) && $secoundryactive == $tagslug){ $secoundryactivess = '1'; echo "class='active'";} ?> href="<?php echo $secoundtaglink;?>#filtre"><?php echo $secoundrytags; ?></a>
				<?php }?>	
                </div>
			</div>
			<?php if(isset($secoundryurl) && !empty($secoundryurl) && !empty($secoundryactivess)){?>
				<span class="destination_search_img">
					<a href="<?php echo $secoundryurl;?>"><img src="<?php echo $this->config->site_url();?>assets/front/images/demande_ic3.png" alt="Reset Themés Filter" title="Reset Themés Filter"/></a>
				</span>
			<?php } ?>
		</div>
		<?php } ?>
	</div>
	</div>
	
	<div class="destination-product">
		<div  id="scrollingcontent">
			<div class="product_details" id="results">
				<div class="headertoo">&nbsp;</div>
				<div class="headertoo">&nbsp;</div>
				<?php 
				$destinationmodel = new destinationmodel();
				$commonlibmodel	  = new commonlibmodel();
				$current_url_desti 				= $_SERVER['REQUEST_URI'];
				if(isset($_GET['page']) && !empty($_GET['page']))
				{
					$current_url_desti =strtok($_SERVER["REQUEST_URI"],'?');
					
				}
				if(isset($result) && !empty($result))
				{
					foreach($result as $destination_pro_cat_datas)
					{
						$productdetails     =  $destinationmodel->getproductdetails($destination_pro_cat_datas['product_id']);
						$category_slugs     =  $commonlibmodel->getproducturl($destination_pro_cat_datas['product_id']);
						$product_slugs      =  $commonlibmodel->producttoslug($destination_pro_cat_datas['product_id']);
						$productdetailslink =  $this->config->site_url().$category_slugs.'/voyages/'.$product_slugs;
						?>
						<div class="listitempage" data-url="<?php echo $current_url_desti?>?page=<?php echo $current_page;?>">
							<div class="listitem" data-page-url="<?php echo $current_url_desti?>?page=<?php echo $current_page;?>">
								<div class="product_details">
									<div class="pro_thumb_image">
										<a href="<?php echo $productdetailslink;?>">
												<?php if(isset($productdetails[0]["featured_image"]) && !empty($productdetails[0]["featured_image"])){?>
													<img width="250" height="250" src="<?php echo $this->config->site_url();?>application/uploads/product/featuredimage/original/<?php echo $productdetails[0]['featured_image'];?>" border="0" title="<?php echo $productdetails[0]['product_name'];?>" alt="<?php echo $productdetails[0]['product_name'];?>">
												<?php }else{ ?>
													<img width="250" height="250" src="<?php echo $this->config->site_url();?>application/uploads/no_image250.jpg" alt="<?php echo $productdetails[0]['product_name'];?>" title="<?php echo $productdetails[0]['product_name'];?>" border="0">
												<?php } ?>
										</a>
									</div>
									<div class="pro_thumb_image_right">
										<h2>
											<a href="<?php echo $productdetailslink;?>">
												<?php echo $productdetails[0]["product_name"];?>
											</a>
										</h2>
										<h3>
											<a href="<?php echo $productdetailslink;?>">
											<?php echo $productdetails[0]["subtitle"];?>
											</a>
										</h3>							
										<div class="short_description">
											<p><?php echo $productdetails[0]["short_description"];?></p>
										</div>
										<div class="short_threepoint">
											<p><?php echo $productdetails[0]["short_point"];?></p>
										</div>
										<span class="nightformprice">
											<label><?php echo $productdetails[0]["number_of_nights"];?> nuits à partir de</label> <span><?php echo $productdetails[0]["price"];?> &#8364;</span> <sup>/ Pers</sup>
											<a href="<?php echo $productdetailslink;?>">En savoir plus</a>
										</span>
									</div>
								</div>
							</div>
						</div>				
					<?php }
				}	?>
				<div class="animation_image" style="display:none" align="center">
					<img src="<?php echo $this->config->site_url();?>application/uploads/ajax-loader.gif" alt="loading..." title="loading...">
				</div>
			</div>	
		</div>
	</div>
	<div style="display:none">
		<?php foreach ($links as $link) {
			echo $link;
		} ?>
	</div>	
	
	
	
	<div class="sidebar" id="sticker">
		<div class="contact-btn">
			<div class="formbutn">
				<a id="Devis-desti-top" onclick="showfrm('Recevez votre devis personnalisé');ga('send', 'event', 'Devis', 'click', 'Desti-Top');" class="header_right_btn2">
				DEMANDE DE DEVIS
				<!--<?php echo $this->lang->line('RECEVEZ_ALL_PAGES_BUTTON_DESTI');?>--></a>
			</div>
		</div>
		<?php 
		if(isset($destinationdata[0]['user_details_id']) && !empty($destinationdata[0]['user_details_id']) && $destinationdata[0]['user_details_id'] != '-1')
		{?>
			<div class="user_information">
				<?php
					$destinationmod = new Destinationmodel();
					$userdetailsinfo = $destinationmod->getuserdetails($destinationdata[0]['user_details_id']);
				?>
				<div class="client-image">
					<?php if(isset($userdetailsinfo[0]['image']) && !empty($userdetailsinfo[0]['image'])){?>
						<img src="<?php echo $this->config->site_url();?>application/uploads/userimages/thumb200/<?php echo $userdetailsinfo[0]['image'];?>" alt="" title="" border="0">
					<?php }else{?>
						<img src="<?php echo $this->config->site_url();?>application/uploads/no_image100.jpg" alt="<?php echo $userdetailsinfo[0]['user_name'];?>" title="<?php echo $userdetailsinfo[0]['user_name'];?>" border="0">
					<?php } ?>
				</div>
				<div class="client-name">
					<?php echo $userdetailsinfo[0]['user_name'];?>
				</div>
				<div class="client-name1">
					<?php echo $userdetailsinfo[0]['position'];?>
				</div>
				<div class="client-description">
					<?php echo $userdetailsinfo[0]['description_destination'];?>
				</div>
			</div>
		<?php } ?>	
		<?php if(isset($companyinfo[0]['description']) && !empty($companyinfo[0]['description'])){?>
		<div class="company-destination-info">
			<?php echo $companyinfo[0]['description'];?>
		</div>
		<?php  } ?>
		<?php if(isset($destinationdata[0]['logo_destination']) && !empty($destinationdata[0]['logo_destination'])){?>
		<div class="logo-destination">
			<img width="226" height="226"  src="<?php echo $this->config->site_url();?>application/uploads/destinationimage/logodestination/original/<?php echo $destinationdata[0]['logo_destination'];?>" alt="<?php echo $destinationdata[0]['category_name'];?>" title="<?php echo $destinationdata[0]['category_name'];?>">
		</div>
		<?php } ?>
		<div class="infolink-suggestions">
			<?php
			$infopagelinkquand = $this->config->site_url().$destinationdata[0]['slug'].'/quand-partir';
			$infopagelinkinfos = $this->config->site_url().$destinationdata[0]['slug'].'/infos-pratiques';
			?>
			<h5><a class="left_btn_mn" href="<?php echo $infopagelinkquand; ?>">QUAND PARTIR</a></h5>
			<h5><a class="right_btn_mn" href="<?php echo $infopagelinkinfos; ?>">INFOS PAYS</a></h5>
		</div>		
	<div class="contact-btn fixed-bottom">
			<div class="formbutn">
				<a id="Devis-desti-bottom" onclick="showfrm('Recevez votre devis personnalisé');ga('send', 'event', 'Devis', 'click', 'Desti-Bottom');" class="header_right_btn2">
				DEMANDE DE DEVIS
				<!--Recevez votre devis personnalisé--></a>
			</div>
		</div>
	</div>
    
    </div>
</div>
<script type="text/javascript">
var jqr = jQuery.noConflict();

function classadd() {
	jqr('#themes_hide').toggle();
}
function classaddtypedevoyage() {
	jqr('#typedevoyage_hide').toggle();
	jqr('#typedevoyage2_hide').toggle();
	jqr('#typedevoyage3_hide').toggle();
}
</script>

<script type="text/javascript">
   <?php if($next_data_url != ''): ?>
   next_data_url = '<?php echo $next_data_url; ?>';
   <?php endif; ?>
   <?php if($prev_data_url != ''): ?>
   prev_data_url = '<?php echo $prev_data_url; ?>';
   <?php endif; ?>
   primeCache();
</script>

