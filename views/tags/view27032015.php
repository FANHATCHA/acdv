<?php
$commodel = new Commonlibmodel();
$commodel = new Commonlibmodel();
$slug = end($this->uri->segment_array());

?>
<script type="text/javascript">
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
	var pricedata 		 = document.getElementById("price-hidden").value;
	var hitsdata 		 = document.getElementById("hits-hidden").value;
		
	//$("#results").html(''); 
	$('#results').load("<?php echo $this->config->site_url();?>ajaxcall/autoload_tagproductdata", {'group_no': track_load,'slug':slug,'price':pricedata,'hits':hitsdata}, function() {track_load++;}); //load first group
	
	$(window).scroll(function() { //detect page scroll
		if($(window).scrollTop() + $(window).height() > $(document).height() - 100)  //user scrolled to bottom of the page?
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
		if($(window).scrollTop() + $(window).height() > $(document).height() - 100)  //user scrolled to bottom of the page?
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
}

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
				<button id="price-asc" class="price-asc"  value="" onclick="filter_products('prix@ASC');"><label>Prix</label></button>
				<button id="hits-asc" class="price-asc" value=""  onclick="filter_products('plus@ASC');"><label>Plus consultés</label></button>
			</div>
		</div>
		<div class="destination-product">
			<div class="product_details" id="results"></div>
			<div class="animation_image" style="display:none" align="center">
				<img src="<?php echo $this->config->site_url();?>application/uploads/ajax-loader.gif" alt="loading..." title="loading...">
			</div>
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


