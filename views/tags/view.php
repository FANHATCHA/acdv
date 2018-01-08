<?php
$commodel = new Commonlibmodel();
$commodel = new Commonlibmodel();
$slug = end($this->uri->segment_array());

?>
<script>
var filteroption = '<?php if(isset($_GET['hits']) && !empty($_GET['hits'])){ echo '&hits='.$_GET['hits'];}else if(isset($_GET['price']) && !empty($_GET['price'])){ echo '&price='.$_GET['price']; }?>';
initPaginator(filteroption);
</script>
<input type="hidden" value="" id="price-hidden">
<input type="hidden" value="" id="hits-hidden">
<div class="destination">
	<?php if(isset($tagslider_slider) && !empty($tagslider_slider)){?> 	
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
				<?php if(isset($tagsdata['h1_title']) && !empty($tagsdata['h1_title'])){?>
					<h1><?php echo strtoupper($tagsdata['h1_title']); ?></h1>
				<?php }else{ ?>
					<h1><?php echo strtoupper($tagsdata['tag_name']); ?></h1>
				<?php } ?>
				
				<?php 
				$text = str_ireplace('<p>','',$tagsdata['tag_description']);
				echo '<p>'.$text.'</p>';
				?>
			</div>
		</div>
		<div id="slider" class="nivoSlider">
			<?php
			if(isset($tagslider_slider) && !empty($tagslider_slider))
			{ 	$i = 1;
				foreach($tagslider_slider as $tagslider_sliders)
				{?>
					<img width="1500" height="400" src="<?php echo $this->config->base_url();?>application/uploads/bannerimages/original/<?php echo $tagslider_sliders['banner_image']; ?>" title="#htmlcaption<?php echo $i;?>" alt="<?php echo $tagsdata['tag_name']; ?>" />
				<?php $i++;
				}
			}
			?>
		</div>
	</div>
	<?php }?> 
	
	<div class="wrapper"> 
		<div class="destination-filterpart">	
			<div class="typedevoyage2">
				<?php 
				$current_url_desti 				= $_SERVER['REQUEST_URI'];
				if(isset($_GET['page']) && !empty($_GET['page']))
				{
					$current_url_desti =strtok($_SERVER["REQUEST_URI"],'?');
					
				}
				if(isset($_GET['price']) && !empty($_GET['price']) && $_GET['price'] == 'asc'){?>
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
		
		<div class="destination-product">
			<div  id="scrollingcontent">
				<div class="product_details" id="results">
					<div class="headertoo">&nbsp;</div>
					<div class="headertoo">&nbsp;</div>
					<?php 
					$tagsmodel = new tagsmodel();
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
							$productdetails     =  $tagsmodel->getproductdetails($destination_pro_cat_datas['id']);
							$category_slugs     =  $commonlibmodel->getproducturl($destination_pro_cat_datas['id']);
							$product_slugs      =  $commonlibmodel->producttoslug($destination_pro_cat_datas['id']);
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
			<div class="formbutn">
				<a onclick="showfrm('Recevez votre devis personnalisé');" class="header_right_btn2">DEMANDE DE DEVIS</a>
			</div>
			
			<?php if(isset($companyinfo[0]['description']) && !empty($companyinfo[0]['description'])){?>
			<div class="company-destination-info">
				<?php echo $companyinfo[0]['description'];?>
			</div>
			<?php  } ?>
			
			
		</div>
	</div>
</div>
<script type="text/javascript">
   <?php if($next_data_url != ''): ?>
   next_data_url = '<?php echo $next_data_url; ?>';
   <?php endif; ?>
   <?php if($prev_data_url != ''): ?>
   prev_data_url = '<?php echo $prev_data_url; ?>';
   <?php endif; ?>
   primeCache();
</script>


