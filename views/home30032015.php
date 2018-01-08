<!-- Start Content -->
<div class="homepage">
<div id="content">
	<!-- =================================================== SLIDER PART START ============================ -->
	<div class="slider-wrapper theme-default">        
		<div class="slider_search">            	
			<div class="slider_search_mn">
				<div class="slider_search_bg">
					<div class="menu">
						<ul>
						<?php 
							$menuleve_data = json_decode($menulist[0]['menuleve_data'],true);
							$modelc = new Commonlibmodel();
							$main_menu = $modelc->searchdestinationmenu($menuleve_data);
							echo $main_menu;
						?>
						</ul>
					</div>
				</div>
			</div>
			<div class="Social_slider">
				<?php 
				$comlibmod   = new Commonlibmodel();
				$socialmedialink = $comlibmod->getsocialiconSlider();
				foreach($socialmedialink as $socialmedialinks){	?>
					<a target="_blank" href="<?php echo $socialmedialinks['url']; ?>" class="<?php echo $socialmedialinks['name']; ?>"><?php echo $socialmedialinks['name']; ?></a>
				<?php } ?>
			</div>
		</div>
		<div id="slider" class="nivoSlider">
			<?php
			if(isset($homeslider) && !empty($homeslider))
			{ 	$i = 1;
				foreach($homeslider as $homeslide)
				{?>
				<img height="400" width="1500" src="<?php echo $this->config->base_url();?>application/uploads/sliderimages/<?php echo $homeslide['image']; ?>" title="#htmlcaption<?php echo $i;?>" alt="<?php echo $homeslide['slider_title']; ?>" />
				<?php $i++;
				}
			}
			?>
		</div>
		<?php
		if(isset($homeslider) && !empty($homeslider))
		{ $i = 1;
			foreach($homeslider as $homeslide)
			{?>
				<div id="htmlcaption<?php echo $i;?>" class="nivo-html-caption">
					<h2><?php echo $homeslide['slider_title'];?> </h2>
					<h3><?php echo $homeslide['short_description'];?></h3>
					<p><?php echo $homeslide['description'];?></p>
				</div>
			<?php $i++;
			}
		}
		?> 
	</div>
	<!-- =================================================== SLIDER PART END ======================================== -->

	<!-- ============================================== La Communaut  ========================================== -->
	<div class="wrapper ">
		<?php echo $cmsblock1[0]['description'];?>
	</div> 
	<!-- ============================================== La Communaut  ==================================== -->
	
	<!-- =================================================== HOME PAGE GALLERY START ============================ -->
	<div class="gallery_bg_mn">
		<div class="wrapper">        
			<div class="demo">
			<ul id="demo" class="content-slider">
								<li><div class="gallery_bg_mn_row">
			
			<div class="view view-first home_gallry_small_box">
				<div class="small">
					<a href="http://www.aucoeurduvoyage.com/destination/la-reunion"><img width="340" height="340" src="http://www.aucoeurduvoyage.com/assets/front/images/home-gallery/La-Reunion.jpg" alt="La Réunion"/>
						<div class="mask">
							<p>Laissez-vous tenter par la beauté naturelle de ses nombreux sites…</p>
							<button class="btn-gallery">En savoir plus</button>
						</div>
					</a>
				</div>
			</div>
							
			<div class="view view-first home_gallry_small_box1">
				<div class="medium">
					<a href="http://www.aucoeurduvoyage.com/destination/etats-unis">
                    	<img width="710" height="340" src="http://www.aucoeurduvoyage.com/assets/front/images/home-gallery/Etats-Unis.jpg" alt="Les Etats-Unis"/>
					<div class="mask">
						<p>L'American dream de New-York à la Côte-Ouest, en passant par la Floride et la Lousiane</p>
						<button class="btn-gallery">En savoir plus</button>
                    </div>
                    </a>
				</div>
			</div>
			<div class="view view-first home_gallry_small_box2">
				<div class="big">
					<a href="http://www.aucoeurduvoyage.com/type-de-voyage/voyage-de-noces"><img width="1110" height="340" src="http://www.aucoeurduvoyage.com/assets/front/images/home-gallery/Voyage-de-noces.jpg" alt="Voyage de Noces"/>
					<div class="mask">
						<p>Passez une lune de miel de rêve 100% sur-mesure</p>
						<button class="btn-gallery">En savoir plus</button></a>
                    </div>
				</div>
			</div>
			<div class="view view-first home_gallry_small_box">
				<div class="small">
					<a href="http://www.aucoeurduvoyage.com/destination/indonesie"><img width="340" height="340" src="http://www.aucoeurduvoyage.com/assets/front/images/home-gallery/Indonesie.jpg" alt="Indonésie"/>
					<div class="mask">
						<p>Une population chaleureuse, des coutumes et traditions variées qui n’attendent que vous</p>
						<button class="btn-gallery">En savoir plus</button></a>
                    </div>
				</div>
			</div>
			<div class="view view-first home_gallry_small_box">
				<div class="small">
					<a href="http://www.aucoeurduvoyage.com/destination/ile-maurice"><img width="340" height="340" src="http://www.aucoeurduvoyage.com/assets/front/images/home-gallery/Maurice.jpg" alt="Ile Maurice"/>
					<div class="mask">
						<p>Embarquez pour un voyage riche en couleurs au coeur d’une île magique</p>
						<button class="btn-gallery">En savoir plus</button></a>
                    </div>
				</div>
			</div>
			<div class="view view-first home_gallry_small_box">
				<div class="small">
					<a href="http://www.aucoeurduvoyage.com/destination/cambodge"><img width="340" height="340" src="http://www.aucoeurduvoyage.com/assets/front/images/home-gallery/Cambodge.jpg" alt="Cambodge"/>
					<div class="mask">
						<p>Partez à l’encontre de paysages somptueux et de monuments au charme authentique</p>
						<button class="btn-gallery">En savoir plus</button></a>
                    </div>
				</div>
			</div>
			<div class="view view-first home_gallry_small_box1">
				<div class="medium">
					<a href="http://www.aucoeurduvoyage.com/destination/polynesie"><img width="710" height="340" src="http://www.aucoeurduvoyage.com/assets/front/images/home-gallery/Polynesie.jpg" alt="Polynésie"/>
					<div class="mask">
						<p>Entre eaux cristallines et forêts verdoyantes : laissez-vous tenter par ces paysages de rêve</p>
						<button class="btn-gallery">En savoir plus</button></a>
                    </div>
				</div>
			</div>
			<div class="view view-first home_gallry_small_box">
				<div class="small">
					<a href="http://www.aucoeurduvoyage.com/destination/sri-lanka"><img width="340" height="340" src="http://www.aucoeurduvoyage.com/assets/front/images/home-gallery/Sri-Lanka.jpg" alt="Sri-Lanka"/>
					<div class="mask">
						<p>Offrez-vous un séjour inoubliable à la découverte des perles sri lankaises</p>
						<button class="btn-gallery">En savoir plus</button></a>
                    </div>
				</div>
			</div>
		</div>
		</div>
        </li>
		</ul>
					
			<!--<ul id="demo" class="content-slider">				
					<?php if(isset($homegallery) && !empty($homegallery)){
						$i = 1;
						foreach($homegallery as $homegaller){
						 //if($i % 9 == 0){ echo '</div></li><li><div class="gallery_bg_mn_row">';}else if($i == 1){ echo '<li><div class="gallery_bg_mn_row">';}?>
						<div class="view view-first">
							<div class="small">
								 <?php	$image_path = FCPATH.'application/uploads/sliderimages/'.$homegaller['image'];?>
									<?php if(isset($homegaller['url']) && !empty($homegaller['url'])){
										$imagevariable =  list($width, $height, $type, $attr) = getimagesize($image_path);?>
										<a href="<?php echo $this->config->base_url().$homegaller['url'];?>">
											<img <?php echo $imagevariable[3];?> src="<?php echo $this->config->base_url();?>application/uploads/sliderimages/<?php echo $homegaller['image']; ?>" alt="<?php echo $homegaller['slider_title']; ?>"/>
											<div class="mask">
												<p><?php echo $homegaller['description'];?></p>
												<button class="btn-gallery">En savoir plus</button></a>
											</div>
										</a>
									<?php }else{ ?>
										<img <?php echo $imagevariable[3];?> src="<?php echo $this->config->base_url();?>application/uploads/sliderimages/<?php echo $homegaller['image']; ?>" alt="<?php echo $homegaller['slider_title']; ?>"/>
										<div class="mask">
											<p>Offrez-vous un séjour inoubliable à la découverte des perles sri lankaises</p>
											<button class="btn-gallery">En savoir plus</button></a>
										</div>
									<?php } ?>	
								<?php $i++; } ?>
							</div>
						</div>		
							<?php } ?>
				</ul>-->
				
			<!--<div class="gallery_bg_mn_row_bottom">
				Plus de Destinations
			</div>-->
		</div>	            
		</div>
	</div>
	<!-- =================================================== HOME PAGE GALLERY END ==========================================-->
	<!-- =================================================== HOME PAGE Offre Spciale CMS BLOCK   ==========================================-->
	<div class="review_slider">
		<div id="flexslider" class="cd-testimonials-wrapper cd-container">
			<ul class="cd-testimonials">
				<?php $sk = 1; foreach($PromotingOffers as $PromotingOffer){ 
					$commod 			= new Homemodel();
					$productname 		= $commod->getproidtoproname($PromotingOffer['product_id']);
					$productname 		= $commod->getproidtoproname($PromotingOffer['product_id']);
					$productnames       = $productname['product_name']; 
					$productprice       = $productname['price'];
					$comlidmod 			= new Commonlibmodel();
					$producttocatid     = $comlidmod->getproidtocatid($PromotingOffer['product_id']);
					$category_slugs     = $comlidmod->getproducturl($PromotingOffer['product_id']);
					$product_slugs      = $comlidmod->producttoslug($PromotingOffer['product_id']);
					
					$productdetailslink = $this->config->site_url().$category_slugs.'/voyages/'.$product_slugs;
					?>
					<li>
						<div class="Offre_specials_mn_row">
							<?php if(isset($PromotingOffer['title']) && !empty($PromotingOffer['title'])){ ?>
							<h2><?php echo $PromotingOffer['title'];?></h2>
							<?php }else{ ?>
							<h2>Offre Sp&eacute;ciale</h2>
							<?php } ?>
							<span>
								<?php if(isset($PromotingOffer['rating']) && !empty($PromotingOffer['rating'])){ ?>
									<img height="29" width="171"  alt="Rating &nbsp; 5 / <?php echo $PromotingOffer['rating'];?>" title="<?php echo $productnames;?>" src="<?php echo $this->config->base_url();?>application/uploads/medialibrary/images/starepro_offers<?php echo str_replace('.','-',$PromotingOffer['rating']);?>.png" />
								<?php }else{ ?>
									<img height="29" width="171" alt="Rating &nbsp; 5 / <?php echo $PromotingOffer['rating'];?>" title="<?php echo $productnames;?>" src="<?php echo $this->config->base_url();?>application/uploads/medialibrary/images/starepro_offers0.png" />
								<?php } ?>
							</span>
							<?php echo $PromotingOffer['description'];?>
						</div>
						<div class="Offre_specials_mn_row1">
							<?php if(isset($productprice) && !empty($productprice)){?><span class="pricetitle">Votre s&eacute;jour a partir de</span><div class="Offre_price"><?php echo $productprice;?>&euro;</div><?php } ?>
							
							<?php if(isset($PromotingOffer['promoting_offers']) && !empty($PromotingOffer['promoting_offers'])){
							$currentdate = strtotime(date('Y-m-d h:i:s'));
							$mydate      = strtotime(date('Y-m-d h:i:s',strtotime($PromotingOffer['end_date'])));
							if($currentdate < $mydate){?>
							<div class="countdown">
								<a href="<?php echo $productdetailslink;?>">R&eacute;servez d'ici</a> 
								<script type="text/javascript">
									var fulldate = '<?php echo date('Y/m/d H:i:s',strtotime($PromotingOffer['end_date']));?>';
									count_downs(fulldate,'<?php echo $sk; ?>');
								</script>
								<div id="future_date<?php echo $sk; ?>">
								</div>
							</div>
							<div class="count_desc">
								<div>
									<span>JRS</span> <span>HRS</span> <span>MNS</span> <span>SECS</span>
								</div>
							</div>
							<?php }else{?>
							<div class="countdown">	
								<a href="<?php echo $productdetailslink;?>">Réserver maintenant</a>
							</div>	
							<?php } }else{ ?>
							<div class="countdown">	
								<a href="<?php echo $productdetailslink;?>">Réserver maintenant</a>
							</div>		
							<?php } ?>
							
						</div>
					</li>
					
				<?php $sk++; }	?> 
			</ul>
		</div>
   </div>
   



	<script type="text/javascript">
	
	function count_downs(fulldate,id)
	{
		var cnt = jQuery.noConflict();
		var dates = fulldate;
		cnt('#future_date'+id).countdowntimer({
			dateAndTime : dates,
			size : "lg"
		});
	}
	</script>

 
   <!-- ================================================   HOME PAGE Offre Spciale CMS BLOCK       ========================================== -->
	
	<!-- ===============================================   HOME PAGE Notre Savoir CMS BLOCK 1 START ========================================= -->
	<div class="wrapper">
		 <?php echo $cmsblock4[0]['description'];?>
	</div>
	<!-- ================================================ HOME PAGE Notre Savoir CMS BLOCK 1 END    ========================================== -->
	
	<!-- ================================================ LA COMMUNAUTE                             ==========================================-->
	<div class="communautpart">
		<div class="wrapper">
			<div class="La_Communaute_mn">
				<h2>La Communaut&eacute;</h2>
				<h3>Au Coeur du Voyage</h3>
				<div class="dem2 client_review">
                	<h2 class="mobile_slider_title">Les avis <span>clients</span></h2>
					<ul id="demo2" class="content-slider">
						<?php 
						if(isset($clientreview) && !empty($clientreview))
						{
							foreach($clientreview as $clientreviews)
							{?>
								<?php if(isset($clientreviews['clientreview_clickble']) && !empty($clientreviews['clientreview_clickble']) && $clientreviews['clientreview_clickble'] == 'yes'){?>
								<li>
								<p class="review_title"><?php echo $clientreviews['name'];?></p>
									<?php 
									$categoryids 	= explode(',',$clientreviews['destination_id']);
									$destinatitotal = count($categoryids);
									$html = '';
									if(isset($categoryids) && !empty($categoryids))
									{	$i = 0;
										$html .='<p class="review_desti">';
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
											$commmodule = new Commonlibmodel();
											$categorydetails  =  $commmodule->getcategoryname($destinationids);
											$html .= $categorydetails[0]['category_name'].$comma;
											$i++;
										}
										$html .='</p>';
										echo $html;
									}
									?>
									<p><?php echo string_limit($clientreviews['client_review'],300);?></p>
									<p><a href="<?php echo $this->config->base_url();?>lavis-de-nos-clients">Lire la suite</a></p>
								</li>
								<?php }else{ ?>
								<li>
								<p class="review_title"><?php echo $clientreviews['name'];?></p>
								<?php 
									$categoryids 	= explode(',',$clientreviews['destination_id']);
									$destinatitotal = count($categoryids);
									$html = '';
									if(isset($categoryids) && !empty($categoryids))
									{	$i = 0;
										$html .='<p class="review_desti">';
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
											$commmodule = new Commonlibmodel();
											$categorydetails  =  $commmodule->getcategoryname($destinationids);
											$html .= $categorydetails[0]['category_name'].$comma;
											$i++;
										}
										$html .='</p>';
										echo $html;
									}
									?>
								<p><?php echo string_limit($clientreviews['client_review'],300);?></p>
								<p><a href="<?php echo $this->config->base_url();?>lavis-de-nos-clients">Lire la suite</a></p>
								</li>
								<?php } ?>
							<?php 
							}
						}
						?>
					</ul>
				</div>
				
				
				<div class="comment_right_mn">
					<div class="gposts">
						<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FAu-Coeur-Du-Voyage%2F233613626680309&amp;width=486&amp;height=258&amp;colorscheme=light&amp;show_faces=false&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:486px; height:100px;" allowTransparency="false"></iframe>
					</div>
					
					<div class="comment_right_mn_row">
						<div class="userdetails_left">
							<script type="text/javascript" src="https://apis.google.com/js/platform.js" async defer>{lang: 'fr'}</script>
							<div>
								<div class="g-page" data-width="220" data-height="100"   data-href="https://plus.google.com/103159257597036426877" data-showtagline="false" data-rel="publisher"></div>
							</div>  
						</div>	
						<div class="client_logos userdetails_left">
							<?php if(isset($userdetails_left) && !empty($userdetails_left)){?>
								<?php if(isset($userdetails_left['userblock_clickble']) && !empty($userdetails_left['userblock_clickble']) && $userdetails_left['userblock_clickble'] == 'yes' ){?>
									<a href="<?php echo $this->config->base_url().$userdetails_left['clickble_link']?>">
										<?php
										if(isset($userdetails_left['image']) && !empty($userdetails_left['image'])){ ?>
											<div class="user-image">
												<?php	$image_path2 = FCPATH.'application/uploads/userimages/original/'.$userdetails_left['image'];
												$imagevariable2 =  list($width, $height, $type, $attr) = getimagesize($image_path2);?>
												<img height="293" width="280" src="<?php echo $this->config->site_url();?>application/uploads/userimages/original/<?php echo $userdetails_left['image']; ?>&amp;h=293&amp;w=280&amp;c=1" alt="<?php echo $userdetails_left['user_name'];?>" title="<?php echo $userdetails_left['user_name'];?>">
											</div>
										<?php }else{ ?>
											<div class="user-image">
												<img height="293" width="280" src="<?php echo $this->config->site_url();?>application/uploads/no_image.jpg" alt="<?php echo $userdetails_left['user_name'];?>" title="<?php echo $userdetails_left['user_name'];?>">
											</div>
										<?php } ?>
										<div class="user-image-img">
										<h2><?php echo $userdetails_left['user_name'];?></h2>
										<?php if(isset($userdetails_left['position']) && !empty($userdetails_left['position'])){?>
										<h3><?php echo $userdetails_left['position'];?></h3>
										</div>
										<?php } ?>
										
									</a>
								<?php }else{
										if(isset($userdetails_left['image']) && !empty($userdetails_left['image'])){ ?>
											<a href="http://www.aucoeurduvoyage.com/qui-sommes-nous">
											<div class="user-image">
												<?php	$image_path2 = FCPATH.'application/uploads/userimages/original/'.$userdetails_left['image'];
												$imagevariable2 =  list($width, $height, $type, $attr) = getimagesize($image_path2);?>
												<img height="293" width="280"  src="<?php echo $this->config->site_url();?>timthumb.php?src=<?php  echo $this->config->site_url();?>application/uploads/userimages/original/<?php echo $userdetails_left['image']; ?>&amp;h=293&amp;w=280&amp;c=1" alt="<?php echo $userdetails_left['user_name'];?>" title="<?php echo $userdetails_left['user_name'];?>">
											</div></a>
										<?php }else{ ?>
											<div class="user-image">
												<img height="293" width="280"  src="<?php echo $this->config->site_url();?>timthumb.php?src=<?php  echo $this->config->site_url();?>application/uploads/no_image.jpg&amp;h=293&amp;w=280&amp;c=1" alt="<?php echo $userdetails_left['user_name'];?>" title="<?php echo $userdetails_left['user_name'];?>">
											</div>
										<?php } ?>
										<div class="user-image-img">
										<h2><?php echo $userdetails_left['user_name'];?></h2>
										<?php if(isset($userdetails_left['position']) && !empty($userdetails_left['position'])){?><h3><?php echo $userdetails_left['position'];?></h3></div><?php } ?>
								<?php } 
							} ?>
						</div>
					</div>
                </div>
                <div class="userdetails_right">
				<a class="twitter-timeline" href="https://twitter.com/aucoeurduvoyage" data-widget-id="568731422610173952" width="277" height="394">Tweets de @aucoeurduvoyage</a>
					<script>window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));</script>
				</div>
				<?php /*
				<div class="facebook-news-feed-code">
					<div id="fb-root"></div>
					<script type="text/javascript">
					  (function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
					  fjs.parentNode.insertBefore(js, fjs);
					  }(document, 'script', 'facebook-jssdk'));
					</script>
					<div class="fb-comments" data-href="http://aucoeurduvoyage.com/" data-width="100%" data-numposts="1" data-colorscheme="light"></div>
				</div>*/?>
                
			</div>	
		</div>	
	</div> 
	<!-- ============================================== La Communaut  ==================================== -->
</div>
</div>
<!-- End Content -->
<script type="text/javascript">
$( window ).resize(function() {
	if($('.comment_right_mn').css('display') == 'none')
	{
		$('.comment_right_mn').remove();
	}
	if($('.userdetails_right').css('display') == 'none')
	{
		$('.userdetails_right').remove();
	}
	if($('.communautpart').css('display') == 'none')
	{
		$('.communautpart').remove();
	}
});
</script>

