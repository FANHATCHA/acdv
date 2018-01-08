<div class="wrapper">
<div class="product_details_page">
	<?php if(isset($productdata) && !empty($productdata))
	{?>
		<div class="pagination">
			<?php 
			//$proslug 	 = end($this->uri->segment_array());
			//$catslug	 = array_slice($this->uri->segment_array(),-3,1);
			//$comlibmod   = new Commonlibmodel();
			//$catid		 = $comlibmod->getIdFromSlug('category_id','products_categories',$catslug[0]);
			//$proprevnextlink = $comlibmod->productprevnext($catid,$proslug,$catslug[0]);
			//echo $proprevnextlink;//exit;
			?>
		</div>
		<div class="slide_show">
			<div class="slider-wrapper theme-default">       
			<?php
			/*==================== get slider id to all slider in banner section =============*/
			$banner_mod = new Voyagesmodel();
			$banner_images = $banner_mod->getbannerimages($productdata[0]['slider_id']);
			if(isset($banner_images) && !empty($banner_images))
			{	echo '<div id="slider" class="nivoSlider">';
					foreach($banner_images as $banner_image)
					{?>
					  <img  width="600" height="366" src="<?php echo $this->config->base_url();?>application/uploads/bannerimages/original/<?php echo $banner_image['banner_image']; ?>" alt="<?php echo $productdata[0]['product_name'];?>"  border="0"/>
					<?php 
					}
				echo '</div>';
			}	
			/*==================== get slider id to all slider in banner section =============*/			
			?>
			</div>
		</div>
		<div class="right_description">
			<h1><?php echo $productdata[0]['product_name'];?></h1>
			<h2><?php echo $productdata[0]['subtitle'];?></h2>
			<div class="pro_price">
				<?php echo $productdata[0]['number_of_nights'];?> nuits à partir de <span class="green"><?php echo $productdata[0]['price'];?> € <span>
			</div>
			<div class="appreciate_desc">
				<h3>Ce qui vous attend...</h3>
				<?php echo $productdata[0]['you_will_appreciate'];?>
			</div>
		</div>
		
        <div class="product_bot_lt">
        <div class="pro-bottom">
			<div id="hidden_web_id">
				<ul id="product-tabs" >
					<?php if(isset($presentation) && !empty($presentation)){ ?>
						<li id="tab1" class="active"><h2><a href="#tab-1" id="#tab1" >Présentation</a></h2></li> 
					<?php }?>	
					
					<?php if(isset($hotel) && !empty($hotel) && empty($route)){?>
						<li id="tab2" class=""><h2><a href="#tab-2" id="#tab2">Fiche hôtel</a></h2></li>
					<?php }if(isset($route) && !empty($route) && empty($hotel)){?>
						<li id="tab2" class=""><h2><a href="#tab-2" id="#tab2">Itinéraire</a></h2></li>
					<?php }if(isset($route) && !empty($route) && isset($hotel) && !empty($hotel)){ ?>
						<li id="tab2" class=""><h2><a href="#tab-2" id="#tab2">Fiche hôtel</a></h2></li>
						<li id="tab5" class=""><h2><a href="#tab-5" id="#tab5">Itinéraire</a></h2></li>
					<?php } ?>
					<?php if(isset($product_budget) && !empty($product_budget)){?>
						<li id="tab3" class=""><h2><a href="#tab-3" id="#tab3">Budget</a></h2></li>   
					<?php } ?>
					
					<?php if(isset($special_offers) && !empty($special_offers)){?>	
						<li id="tab4" class=""><h2><a href="#tab-4" id="#tab4">Offres Spéciales</a></h2></li>
					<?php } ?>
					
				</ul>
				<div id="product-content">
					<?php if(isset($presentation) && !empty($presentation)){?>
						<div id="tab-1" name="tab-1">
							<?php echo $presentation;?>
						</div>
					<?php } ?>
					
					<?php if(isset($hotel) && !empty($hotel) && empty($route)){?>
						<div id="tab-2" name="tab-2" style="display:none">
							<?php echo $hotel;?>
						</div>
					<?php }if(isset($route) && !empty($route) && empty($hotel) ){?>
						<div id="tab-2" name="tab-2" style="display:none">
							<?php echo $route;?>
						</div>
					<?php }if(isset($route) && !empty($route) && isset($hotel) && !empty($hotel)){ ?>
						<div id="tab-2" name="tab-2" style="display:none">
							<?php echo $hotel;?>
						</div>
						<div id="tab-5" name="tab-5" style="display:none">
							<?php echo $route;?>
						</div>
					<?php } ?>
					
					<?php if(isset($product_budget) && !empty($product_budget)){?>
						<div id="tab-3" name="tab-3" style="display:none">
							<?php echo $product_budget;?>
						</div>
					<?php } ?>
					
					<?php if(isset($special_offers) && !empty($special_offers)){?>
						<div id="tab-4" name="tab-4" style="display:none">
							<?php echo $special_offers;?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		
		
		<div class="product_tab_mobile">
			<div id="product-content">
				<?php if(isset($presentation) && !empty($presentation)){?>
					<label>Présentation</label>
					<div>
						<?php echo $presentation;?>
					</div>
				<?php } ?>
				<?php if(isset($hotel) && !empty($hotel) && empty($route)){?>
					<label>Fiche hôtel</label>
					<div>
						<?php echo $hotel;?>
					</div>
				<?php }if(isset($route) && !empty($route) && empty($hotel) ){?>
					<label>Itinéraire</label>
					<div>
						<?php echo $route;?>
					</div>
				<?php }if(isset($route) && !empty($route) && isset($hotel) && !empty($hotel)){ ?>
					<label>Fiche hôtel</label>
					<div>
						<?php echo $hotel;?>
					</div>
					<label>Itinéraire</label>
					<div>
						<?php echo $route;?>
					</div>
				<?php } ?>
				<?php if(isset($product_budget) && !empty($product_budget)){?>
					<label>Budget</label>
					<div>
						<?php echo $product_budget;?>
					</div>
				<?php } ?>
				<?php if(isset($special_offers) && !empty($special_offers)){?>
					<label>Offres Spéciales</label>
					<div>
						<?php echo $special_offers;?>
					</div>
				<?php } ?>
			</div>
		</div>
		
		
		<?php if(isset($productdata[0]['authentic_experience']) && !empty($productdata[0]['authentic_experience'])){?>
		<div id="product-raw">
			<div class="product_aero_top"> </div>
			<?php echo $productdata[0]['authentic_experience'];?>
        </div>
		<?php } ?>
			<div class="contact-btn-desti">
				<div class="formbutn">
					<a id="Devis-product-bottom" onclick="showfrm('Recevez votre devis personnalisé');ga('send', 'event', 'Devis', 'click', 'Product-Bottom');" class="header_right_btn2">
					DEMANDE DE DEVIS
					</a>
				</div>
				<div class="formbutn button_mobile">	
					<a onclick="fillpurlstring();" class="header_right_btn2">DEMANDE DE DEVIS</a>
				</div>
			</div>
			<div class="googleplushbutton">
				<script src="https://apis.google.com/js/platform.js" async defer></script>
				<div class="g-plusone" data-size="medium" data-annotation="inline" data-width="300"></div>
			</div>
		</div>
        
		<div class="mobile_left_panel">
		<?php
					$commodel = new Commonlibmodel();
					$slug = $this->uri->segment_array();
					$destslug  = array_slice($slug,-3,1);
					$comlidmod = new Commonlibmodel();
					$proslug  	      = array_slice($slug,-1,1);
					
					$desti_catid   = $this->input->server('HTTP_REFERER');
					$explodeprvurl = explode('/',$desti_catid);
					$destichecktwo = array_slice($explodeprvurl,-4,4);
					$desticheckone = array_slice($explodeprvurl,-3,1);
					$desticheck	   = array_slice($explodeprvurl,-2,4);
								
					
					if(isset($desticheck[0]) && !empty($desticheck[0]) && $desticheck[0] == 'destination')
					{
						$endsegment    = end($explodeprvurl);
						if(isset($endsegment) && !empty($endsegment))
						{
							$id = $commodel->getcatslgtoUserid($endsegment);
						}
						else
						{
							
							$proid 	 	   	  = $comlidmod->getIdFromSlug('id','products',$proslug[0]);
							$catslugtoproduct = $comlidmod->getproductidtodestinationslug($proid);
							$id = $commodel->getcatslgtoUserid($catslugtoproduct);
						}
					}
					else if(isset($desticheckone[0]) && !empty($desticheckone[0]) && $desticheckone[0] == 'destination')
					{
						$endsegment    = array_slice($explodeprvurl,-2,1);
						if(isset($endsegment) && !empty($endsegment))
						{
							$id = $commodel->getcatslgtoUserid($endsegment[0]);
							
						}
						else
						{
							
							$proid 	 	   	  = $comlidmod->getIdFromSlug('id','products',$proslug[0]);
							$catslugtoproduct = $comlidmod->getproductidtodestinationslug($proid);
							$id = $commodel->getcatslgtoUserid($catslugtoproduct);
						}
					}
					else if(isset($destichecktwo[0]) && !empty($destichecktwo[0]) && $destichecktwo[0] == 'destination')
					{
						$endsegment    = array_slice($explodeprvurl,-3,1);
						if(isset($endsegment) && !empty($endsegment))
						{
							$id = $commodel->getcatslgtoUserid($endsegment[0]);
						}
						else
						{
							
							$proid 	 	   	  = $comlidmod->getIdFromSlug('id','products',$proslug[0]);
							$catslugtoproduct = $comlidmod->getproductidtodestinationslug($proid);
							$id = $commodel->getcatslgtoUserid($catslugtoproduct);
						}
					}
					else
					{
						$proid 	 	   	  = $comlidmod->getIdFromSlug('id','products',$proslug[0]);
						$catslugtoproduct = $comlidmod->getproductidtodestinationslug($proid);
						$id = $commodel->getcatslgtoUserid($catslugtoproduct);
					}
					
						
						
					if(isset($id) && !empty($id)){ ?>
					
					<div class="user_information">
						<?php
							$travellingmod = new Voyagesmodel();
							$userdetailsinfo = $travellingmod->getuserdetails($id);
						?>
						<div class="client-image">
							<?php if(isset($userdetailsinfo[0]['image']) && !empty($userdetailsinfo[0]['image'])){?>
								<img width="125" height="125" src="<?php echo $this->config->site_url();?>application/uploads/userimages/thumb200/<?php echo $userdetailsinfo[0]['image'];?>" alt="" title="" border="0">
							<?php }else{?>
								<img width="125" height="125" src="<?php echo $this->config->site_url();?>application/uploads/no_image100.jpg" alt="<?php echo $userdetailsinfo[0]['user_name'];?>" title="<?php echo $userdetailsinfo[0]['user_name'];?>" border="0">
							<?php } ?>
						</div>
						<div class="client_image_right">
							<div class="client-name">
								<?php echo $userdetailsinfo[0]['user_name'];?>
							</div>
							<div class="client-function">
								<?php echo $userdetailsinfo[0]['position'];?>
							</div>
							<div class="client-description">
								<?php echo $userdetailsinfo[0]['description_product'];?>
							</div>
						</div>
					</div>
					<?php } ?>
		</div>
		
		<div class="sidebar" id="sticker2">
				<div class="contact-btn-desti">
					<div class="formbutn">
						<a id="Devis-product-top" onclick="showfrm('Recevez votre devis personnalisé');ga('send', 'event', 'Devis', 'click', 'Product-Top');" class="header_right_btn2">
						DEMANDE DE DEVIS
						<!--<?php echo $this->lang->line('RECEVEZ_ALL_PAGES_BUTTON_PRO');?>--></a>
					</div>
				</div>
				<div class="pro_slidebar">
					<?php
					$commodel = new Commonlibmodel();
					$slug = $this->uri->segment_array();
					$destslug  = array_slice($slug,-3,1);
					$comlidmod = new Commonlibmodel();
					//$id = $commodel->getcatslgtoUserid($destslug[0]);
					$proslug  	      = array_slice($slug,-1,1);
					
					$desti_catid   = $this->input->server('HTTP_REFERER');
					$explodeprvurl = explode('/',$desti_catid);
					$destichecktwo = array_slice($explodeprvurl,-4,4);
					$desticheckone = array_slice($explodeprvurl,-3,1);
					$desticheck	   = array_slice($explodeprvurl,-2,4);
								
					
					if(isset($desticheck[0]) && !empty($desticheck[0]) && $desticheck[0] == 'destination')
					{
						$endsegment    = end($explodeprvurl);
						if(isset($endsegment) && !empty($endsegment))
						{
							$id = $commodel->getcatslgtoUserid($endsegment);
						}
						else
						{
							
							$proid 	 	   	  = $comlidmod->getIdFromSlug('id','products',$proslug[0]);
							$catslugtoproduct = $comlidmod->getproductidtodestinationslug($proid);
							$id = $commodel->getcatslgtoUserid($catslugtoproduct);
						}
					}
					else if(isset($desticheckone[0]) && !empty($desticheckone[0]) && $desticheckone[0] == 'destination')
					{
						$endsegment    = array_slice($explodeprvurl,-2,1);
						if(isset($endsegment) && !empty($endsegment))
						{
							$id = $commodel->getcatslgtoUserid($endsegment[0]);
							
						}
						else
						{
							
							$proid 	 	   	  = $comlidmod->getIdFromSlug('id','products',$proslug[0]);
							$catslugtoproduct = $comlidmod->getproductidtodestinationslug($proid);
							$id = $commodel->getcatslgtoUserid($catslugtoproduct);
						}
					}
					else if(isset($destichecktwo[0]) && !empty($destichecktwo[0]) && $destichecktwo[0] == 'destination')
					{
						$endsegment    = array_slice($explodeprvurl,-3,1);
						if(isset($endsegment) && !empty($endsegment))
						{
							$id = $commodel->getcatslgtoUserid($endsegment[0]);
						}
						else
						{
							
							$proid 	 	   	  = $comlidmod->getIdFromSlug('id','products',$proslug[0]);
							$catslugtoproduct = $comlidmod->getproductidtodestinationslug($proid);
							$id = $commodel->getcatslgtoUserid($catslugtoproduct);
						}
					}
					else
					{
						$proid 	 	   	  = $comlidmod->getIdFromSlug('id','products',$proslug[0]);
						$catslugtoproduct = $comlidmod->getproductidtodestinationslug($proid);
						$id = $commodel->getcatslgtoUserid($catslugtoproduct);
					}
					
						
						
					if(isset($id) && !empty($id)){ ?>
					
					<div class="user_information">
						<?php
							$travellingmod = new Voyagesmodel();
							$userdetailsinfo = $travellingmod->getuserdetails($id);
						?>
						<div class="client-image">
							<?php if(isset($userdetailsinfo[0]['image']) && !empty($userdetailsinfo[0]['image'])){?>
								<img width="125" height="125" src="<?php echo $this->config->site_url();?>application/uploads/userimages/thumb200/<?php echo $userdetailsinfo[0]['image'];?>" alt="" title="" border="0">
							<?php }else{?>
								<img width="125" height="125" src="<?php echo $this->config->site_url();?>application/uploads/no_image100.jpg" alt="<?php echo $userdetailsinfo[0]['user_name'];?>" title="<?php echo $userdetailsinfo[0]['user_name'];?>" border="0">
							<?php } ?>
						</div>
						<div class="client_image_right">
							<div class="client-name">
								<?php echo $userdetailsinfo[0]['user_name'];?>
							</div>
							<div class="client-function">
								<?php echo $userdetailsinfo[0]['position'];?>
							</div>
							<div class="client-description">
								<?php echo $userdetailsinfo[0]['description_product'];?>
							</div>
						</div>
					</div>
					<?php } ?>
				
					<?php if(isset($companyinfo[0]['description']) && !empty($companyinfo[0]['description'])){?>
						<div class="company-info">
							<?php echo $companyinfo[0]['description'];?>
						</div>
					<?php  } ?>
					
				</div>
				<?php if(isset($productdata[0]['image_link_sidebar']) && !empty($productdata[0]['image_link_sidebar'])){?>
					<div class="map-link">
						<img src="<?php echo $this->config->site_url();?>application/uploads/product/sidebarimage/original/<?php echo $productdata[0]['image_link_sidebar'];?>" alt="Map Image" width="290" height="271" border="0"/>
					</div>
				<?php } ?>
		</div>
		
		
        <div class="no-suggestions">
			<h3>Nos Suggestions</h3>
            <div class="no_suggestions_row">
			<?php 
			/*==================== get Nos Suggestions Product =============*/
			$comlidmod = new Commonlibmodel();
			$travellingmod = new Voyagesmodel();
			$slug 		   = $this->uri->segment_array();
			$catslug  	   = array_slice($slug,0,1);
			$proslug  	      = array_slice($slug,-1,1);
			
			$desti_catid   = $this->input->server('HTTP_REFERER');
			$explodeprvurl = explode('/',$desti_catid);
			$destichecktwo = array_slice($explodeprvurl,-4,4);
			$desticheckone = array_slice($explodeprvurl,-3,1);
			$desticheck	   = array_slice($explodeprvurl,-2,4);
			
			
			if(isset($desticheck[0]) && !empty($desticheck[0]) && $desticheck[0] == 'destination')
			{
				$endsegment    = end($explodeprvurl);
				if(isset($endsegment) && !empty($endsegment))
				{
					$catid 	 = $comlidmod->getIdFromSlug('category_id','products_categories',$endsegment);
					
				}
				else
				{
					
					$proid 	 	   	  = $comlidmod->getIdFromSlug('id','products',$proslug[0]);
					$catslugtoproduct = $comlidmod->getproductidtodestinationslug($proid);
					$catid            = $comlidmod->getIdFromSlug('category_id','products_categories',$catslugtoproduct);
				}
			}
			else if(isset($desticheckone[0]) && !empty($desticheckone[0]) && $desticheckone[0] == 'destination')
			{
				$endsegment    = array_slice($explodeprvurl,-2,1);
				if(isset($endsegment) && !empty($endsegment))
				{
					$catid 	 = $comlidmod->getIdFromSlug('category_id','products_categories',$endsegment[0]);
					
				}
				else
				{
					
					$proid 	 	   	  = $comlidmod->getIdFromSlug('id','products',$proslug[0]);
					$catslugtoproduct = $comlidmod->getproductidtodestinationslug($proid);
					$catid            = $comlidmod->getIdFromSlug('category_id','products_categories',$catslugtoproduct);
				}
			}
			else if(isset($destichecktwo[0]) && !empty($destichecktwo[0]) && $destichecktwo[0] == 'destination')
			{
				$endsegment    = array_slice($explodeprvurl,-3,1);
				if(isset($endsegment) && !empty($endsegment))
				{
					$catid 	 = $comlidmod->getIdFromSlug('category_id','products_categories',$endsegment[0]);
					
				}
				else
				{
					
					$proid 	 	   	  = $comlidmod->getIdFromSlug('id','products',$proslug[0]);
					$catslugtoproduct = $comlidmod->getproductidtodestinationslug($proid);
					$catid            = $comlidmod->getIdFromSlug('category_id','products_categories',$catslugtoproduct);
				}
			}
			else
			{
				$proid 	 	   	  = $comlidmod->getIdFromSlug('id','products',$proslug[0]);
				$catslugtoproduct = $comlidmod->getproductidtodestinationslug($proid);
				$catid            = $comlidmod->getIdFromSlug('category_id','products_categories',$catslugtoproduct);
			}
			
			$relatedrndpro = $travellingmod->getrandrelatedpro($productdata[0]['id'],$catid);
			foreach($relatedrndpro as $relatedrndprodetails)
			{
				$comlidmod = new Commonlibmodel();
				$productdetails 	= $travellingmod->getproductdetails($relatedrndprodetails['product_id']);
				$category_slugs     =  $comlidmod->getproducturl($relatedrndprodetails['product_id']);
				$product_slugs      =  $comlidmod->producttoslug($relatedrndprodetails['product_id']);
				$productdetailslink =  $this->config->site_url().$category_slugs.'/voyages/'.$product_slugs;
				?>
                <div class="no_suggestions_cols">
					<div class="image-suggestions">
						<a href="<?php echo $productdetailslink;?>">
							<div class="pro_thumb_image">
								<?php if(isset($productdetails[0]['featured_image']) && !empty($productdetails[0]['featured_image'])){?>
									<?php /*<img src="<?php echo $this->config->site_url();?>application/uploads/product/featuredimage/thumb200/<?php echo $productdetails[0]['featured_image'];?>" alt="<?php echo $productdetails[0]['product_name'];?>" title="<?php echo $productdetails[0]['product_name'];?>">*/?>
									<img width="200" height="200" src="<?php echo $this->config->site_url();?>timthumb.php?src=<?php echo $this->config->site_url();?>application/uploads/product/featuredimage/original/<?php echo $productdetails[0]['featured_image'];?>&h=200&w=200&c=1" alt="<?php echo $productdetails[0]['product_name'];?>" title="<?php echo $productdetails[0]['product_name'];?>">
								<?php }else{ ?>
									<?php /*<img border="0" width="200px" height="200px" src="<?php echo $this->config->site_url();?>application/uploads/no_image100.jpg" alt="<?php echo $productdetails[0]['product_name'];?>" title="<?php echo $productdetails[0]['product_name'];?>">*/?>
									<img width="200" height="200" border="0" src="<?php echo $this->config->site_url();?>timthumb.php?src=<?php echo $this->config->site_url();?>application/uploads/no_image200.jpg&h=200&w=200&c=1" alt="<?php echo $productdetails[0]['product_name'];?>" title="<?php echo $productdetails[0]['product_name'];?>">
								<?php } ?>
							</div>
						</a>
					</div>
					<div class="details-suggestions">
						<h4><?php echo $productdetails[0]['product_name']; ?></h4>
						<div class="subtitle_nosug"><?php echo $productdetails[0]['subtitle']; ?></div>
						<span class="duration_sugg"><span><?php echo $productdetails[0]['number_of_nights']; ?></span> nuits à partir de</span>
						<span class="price_sugg"><span><?php echo $productdetails[0]['price']; ?> €</span></span>
						<label><a href="<?php echo $productdetailslink; ?>">En Savoir +</a></label>
					</div>
                </div>
				<?php
			}
			/*==================== get Nos Suggestions Product =============*/
			?>
            </div>
		</div>
		<div class="infolink-suggestions infolink_suggestions_product">
			<?php 
			$slug = first($this->uri->segment_array());
			$infopagelinkquand = $this->config->site_url().$slug.'/quand-partir';
			$infopagelinkinfos = $this->config->site_url().$slug.'/infos-pratiques';
			?>
			<h5><a class="left_btn_mn" href="<?php echo $infopagelinkquand; ?>">QUAND PARTIR</a></h5>
			<h5><a class="right_btn_mn" href="<?php echo $infopagelinkinfos; ?>">INFOS PAYS</a></h5>
		</div>
	<?php } 
	function first($array)
	{
		if (!is_array($array)) return $array;
		if (!count($array)) return null;
		reset($array);
		return $array[key($array)];
	} ?>
</div>
</div>
<script type="text/javascript">
$( window ).resize(function() {
	if($('.pro-bottom').css('display') == 'none')
	{
		window['removedHTML'] = $('.pro-bottom #hidden_web_id').html();
		$('#hidden_web_id').remove();
	}
	else
	{
		$('.pro-bottom').html(window['removedHTML']);
	}
});
</script>

