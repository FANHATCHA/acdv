<?php
$commodel = new Commonlibmodel();
$commodel = new Commonlibmodel();
$slug = end($this->uri->segment_array());

?>
<script type="text/javascript">
/*var windowsize = $(window).width();
if (windowsize < 767) {
	var scrollminisheight = 675;
}
else
{
	var scrollminisheight = 100;
}
$(document).ready(function() {
	var track_load = 0; //total loaded record group(s)
	var loading  = false; //to prevents multipal ajax loads
	var total_groups = <?php echo $total_groups; ?>; //total record group(s)
	var slug = '<?php echo $slug; ?>';
	
	/*$.ajax({
      url: "<?php echo $this->config->site_url();?>ajaxcall/autoload_tagproductdata",
      type: "post",
      data: {'group_no': track_load,'slug': slug},
	  success: function(data){
            alert(data);
			$('#results').html(data);
      },
      error:function(){
         alert('error');
      }   
    });*/
	/*var pricedata 		 = document.getElementById("price-hidden").value;
	var hitsdata 		 = document.getElementById("hits-hidden").value;
	//$("#results").html(''); 
	$('#results').load("<?php echo $this->config->site_url();?>ajaxcall/autoload_tagproductdata", {'group_no': track_load,'slug':slug,'price':pricedata,'hits':hitsdata}, function() {track_load++;}); //load first group
	$(window).scroll(function() { //detect page scroll
		if($(window).scrollTop() + $(window).height() > $(document).height() - scrollminisheight)  //user scrolled to bottom of the page?
		{
			if(track_load <= total_groups && loading==false) //there's more data to load
			{
				var pricedata 		 = document.getElementById("price-hidden").value;
				var hitsdata 		 = document.getElementById("hits-hidden").value;
				loading = true; //prevent further ajax loading
				$('.animation_image').show(); //show loading image
				//load data from the server using a HTTP POST request
				$.post('<?php echo $this->config->site_url();?>ajaxcall/autoload_tagproductdata',{'group_no': track_load,'slug':slug,'price':pricedata,'hits':hitsdata}, function(data){
					//$("#results").append('');   
					$("#results").append(data); //append received data into the element
					//hide loading image
					$('.animation_image').hide(); //hide loading image once data is received
					track_load++; //loaded group increment
					loading = false; 
				}).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
					alert(thrownError); //alert with HTTP error
					$('.animation_image').hide(); //hide loading image
					loading = false;
				});
				
			}
		}
	});
});
function filter_products(filter_element)
{
	var track_load = 0; //total loaded record group(s)
	var loading  = false; //to prevents multipal ajax loads
	var total_groups = <?php echo $total_groups; ?>; //total record group(s)
	var slug = '<?php echo $slug; ?>'; //total record group(s)
	var filterdata = filter_element.split('@');
	if(filterdata[0] == 'prix')
	{
		document.getElementById("hits-hidden").value = '';
		var prixc = document.getElementById("price-hidden").value;
		if(typeof prixc == 'undefined' || prixc == 'DESC')
		{
			document.getElementById("price-hidden").value = 'ASC';
			$('#price-asc').removeClass('price-asc1');
			$('#price-asc').addClass('price-asc');
		}
		else if(prixc = 'ASC')
		{
			document.getElementById("price-hidden").value = 'DESC';
			$('#price-asc').removeClass('price-asc');
			$('#price-asc').addClass('price-asc1');
		}
		
	}
	if(filterdata[0] == 'plus')
	{	
		document.getElementById("price-hidden").value = '';
		var plusc = document.getElementById("hits-hidden").value;
		if(typeof plusc == 'undefined' || plusc == 'DESC')
		{
			document.getElementById("hits-hidden").value = 'ASC';
			$('#hits-asc').removeClass('price-asc1');
			$('#hits-asc').addClass('price-asc');
		}
		else if(plusc = 'ASC')
		{
			document.getElementById("hits-hidden").value = 'DESC';
			$('#hits-asc').removeClass('price-asc');
			$('#hits-asc').addClass('price-asc1');
		}
		
	}
	
	var pricedata 		 = document.getElementById("price-hidden").value;
	var hitsdata 		 = document.getElementById("hits-hidden").value;
	
	//$("#results").html(''); 
	$('#results').load("<?php echo $this->config->site_url();?>ajaxcall/autoload_tagproductdata",{'group_no': track_load,'slug':slug,'price':pricedata,'hits':hitsdata}, function() {track_load++;}); //load first group
	
	$(window).scroll(function() { //detect page scroll
		if($(window).scrollTop() + $(window).height() > $(document).height() - scrollminisheight)  //user scrolled to bottom of the page?
		{
			if(track_load <= total_groups && loading==false) //there's more data to load
			{
				var pricedata 		 = document.getElementById("price-hidden").value;
				var hitsdata 		 = document.getElementById("hits-hidden").value;
				loading = true; //prevent further ajax loading
				$('.animation_image').show(); //show loading image
				//load data from the server using a HTTP POST request
				$.post('<?php echo $this->config->site_url();?>ajaxcall/autoload_productdata',{'group_no': track_load,'slug':slug,'price':pricedata,'hits':hitsdata}, function(data){
					//alert(pricedata);
					//$("#results").append('');
					$("#results").append(data); //append received data into the element
					//hide loading image
					$('.animation_image').hide(); //hide loading image once data is received
					track_load++; //loaded group increment
					loading = false; 
				}).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
					alert(thrownError); //alert with HTTP error
					$('.animation_image').hide(); //hide loading image
					loading = false;
				});
				
			}
		}
	});
}*/
</script>
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


