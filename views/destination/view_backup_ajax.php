<?php
$commodel = new Commonlibmodel();
$slug = end($this->uri->segment_array());
$id = $commodel->getIdFromSlug('category_id','products_categories',$slug);
?>
<script type="text/javascript">
$(document).ready(function() {
	var track_load = 0; //total loaded record group(s)
	var loading  = false; //to prevents multipal ajax loads
	var total_groups = <?php echo $total_groups; ?>; //total record group(s)
	var id = <?php echo $id; ?>; //total record group(s)
	
	var primarydata		 = document.getElementById("prime-hidden").value;
	var secondarydata 	 = document.getElementById("secound-hidden").value;
	var pricedata 		 = document.getElementById("price-hidden").value;
	var hitsdata 		 = document.getElementById("hits-hidden").value;
	
	$('#results').load("<?php echo $this->config->site_url();?>ajaxcall/autoload_productdata", {'group_no': track_load,'id':id,'primary':primarydata,'secondary':secondarydata,'price':pricedata,'hits':hitsdata}, function() {track_load++;}); //load first group
	$(window).scroll(function() { //detect page scroll
		if($(window).scrollTop() + $(window).height() == $(document).height())  //user scrolled to bottom of the page?
		{
			if(track_load <= total_groups && loading==false) //there's more data to load
			{
				loading = true; //prevent further ajax loading
				$('.animation_image').show(); //show loading image
				//load data from the server using a HTTP POST request
				
				var primarydata		 = document.getElementById("prime-hidden").value;
				var secondarydata 	 = document.getElementById("secound-hidden").value;
				var pricedata 		 = document.getElementById("price-hidden").value;
				var hitsdata 		 = document.getElementById("hits-hidden").value;
				
				$.post('<?php echo $this->config->site_url();?>ajaxcall/autoload_productdata',{'group_no': track_load,'id':id,'primary':primarydata,'secondary':secondarydata,'price':pricedata,'hits':hitsdata}, function(data){
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
	var id = <?php echo $id; ?>; //total record group(s)
	
	var filterdata = filter_element.split('@');
	if(filterdata[0] == 'prime')
	{
		document.getElementById("prime-hidden").value = filterdata[1];
	}
	
	if(filterdata[0] == 'prix')
	{
		document.getElementById("hits-hidden").value = '';
		var prixc = document.getElementById("price-hidden").value;
		if(typeof prixc == 'undefined' || prixc == 'DESC')
		{
			document.getElementById("price-hidden").value = 'ASC';
		}
		else if(prixc = 'ASC')
		{
			document.getElementById("price-hidden").value = 'DESC';
		}
		
	}
	if(filterdata[0] == 'plus')
	{	
		document.getElementById("price-hidden").value = '';
		var plusc = document.getElementById("hits-hidden").value;
		if(typeof plusc == 'undefined' || plusc == 'DESC')
		{
			document.getElementById("hits-hidden").value = 'ASC';
		}
		else if(plusc = 'ASC')
		{
			document.getElementById("hits-hidden").value = 'DESC';
		}
		
	}
	if(filterdata[0] == 'secound')
	{
		document.getElementById("secound-hidden").value = filterdata[1];
	}
	
	var primarydata		 = document.getElementById("prime-hidden").value;
	var secondarydata 	 = document.getElementById("secound-hidden").value;
	var pricedata 		 = document.getElementById("price-hidden").value;
	var hitsdata 		 = document.getElementById("hits-hidden").value;
	
	$.ajax({
		url:"<?php echo $this->config->site_url();?>ajaxcall/filter_productsdata",
		type: 'POST',
        data: {primary:primarydata,secondary:secondarydata,price:pricedata,hits:hitsdata,group_no:track_load,id:id},
		success: function (response) {
		    $('#results').html(response);
        },
        error: function () {
           alert("error");
        }
	});
}

</script>

<input type="hidden" value="" id="prime-hidden">
<input type="hidden" value="" id="secound-hidden">
<input type="hidden" value="" id="hits-hidden">
<input type="hidden" value="" id="price-hidden">

<div class="destination">
	<div class="slider-wrapper theme-default">        
		<div class="slider_search">            	
			<div class="Social_slider">
				<a href="#" class="Facebook">Facebook</a>
				<a href="#" class="twitter">Twitter</a>
				<a href="#" class="google_plus">Google plus</a>
				<a href="#" class="rss">RSS</a>
			</div>
			<div class="destnation-description">
				<h1><?php echo strtoupper('Voyages - '.$destinationdata[0]['category_name']); ?></h1>
				<p><?php echo $destinationdata[0]['category_description']; ?></p>
			</div>
		</div>
		
		<div id="slider" class="nivoSlider" style="height:500px">
			<?php
			if(isset($destination_slider) && !empty($destination_slider))
			{ 	$i = 1;
				foreach($destination_slider as $destination_sliders)
				{?>
					<img src="<?php echo $this->config->base_url();?>application/uploads/bannerimages/original/<?php echo $destination_sliders['banner_image']; ?>" title="#htmlcaption<?php echo $i;?>" alt="<?php echo $destinationdata[0]['category_name']; ?>" />
				<?php $i++;
				}
			}
			?>
		</div>
	</div>

	<div class="destination-filterpart">	
		<div class="typedevoyage">
			<span class="voyage">Type de Voyage<span>  
			<div class="filter-part">
				Filter par: 
				<?php 
				if(isset($primetag) && !empty($primetag))
				{
					foreach($primetag as $primetags)
					{ 	$primetgid = $primetags['tag_name']; ?>
						<button id="<?php echo $primetgid;?>" value="" onclick="filter_products('prime@<?php echo $primetgid;?>');"><label><?php echo $primetags['tag_name']; ?></label></button>
					<?php }
				}
				?>	
				<button id="price-asc" value="" onclick="filter_products('prix@ASC');"><label>Prix</label></button>
				<button id="hits-asc" value="" onclick="filter_products('plus@ASC');"><label>Plus consultés</label></button>
			</div>
		</div>
		<div class="themes">
			<span class="thme">Themés<span>  
			<div class="filter-part">
				Filter par:
				<?php 
				if(isset($secoundrytag) && !empty($secoundrytag))
				{
					foreach($secoundrytag as $secoundrytags)
					{ $secoutagid = $secoundrytags['tag_name']; ?>
						<button id="<?php echo $secoutagid;?>" value="" onclick="filter_products('secound@<?php echo $secoutagid;?>');"><label><?php echo $secoundrytags['tag_name']; ?></label></button>
					<?php }
				}
				?>	
			</div>
		</div>
	</div>

	<div class="destination-product">
		<div class="product_details" id="results"></div>
		<div class="animation_image" style="display:none" align="center"><img src="<?php echo $this->config->site_url();?>application/uploads/ajax-loader.gif" alt="loading..." title="loading..."></div>
	</div>
	
	<div class="sidebar">
		<div class="formbutn">
			<a class="header_right_btn2">Recevez votre devis personnalisé</a>
			<div class="content-form">
				<form name="enquiry-frm" id="enquiry-frm" action="" method="post">
					<div class="contact-frm">
						<div onclick="step1()">
							<span>DESTINATION</span>
						</div>
						
						<div id="participants">
							<span>PARTICIPANTS</span>
						</div>
						<div id="dates">
							<span>DATES</span>
						</div>
						
						<div id="budget">
							<span>BUDGET</span>
						</div>
						
						<div id="comment">
							<span>COMMENTAIRES</span>
						</div>
						<a onclick="step1()" class="main-button">Recevoir mon devis</a>
					</div>
					
					<div id="destination-frm" class="common-frm" style="display:none">
						<select name="dest" id="dest">
							<option value="">Select Destination</option>
							<option value="1">test</option>
							<option value="2">test2</option>
							<option value="3">test3</option>
						</select>
						<a class="button-inner" onclick="step2()">Suivant</a>
					</div>
					
					<div id="participants-frm" class="common-frm" style="display:none">
						<span class="part-top">Vos coordonnees</span>
						<div class="top-field">
							<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="name" id="name" value="Nom">
							<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="firstname" id="firstname" value="Prénom">
						</div>
						<div class="bottom-field">
							<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="email" id="email" value="Adresse email">
							<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="phoneno" id="phoneno" value="N° de telephone">
						</div>
						<span class="part-bottom">Vous voyagez:</span>
						
						<a class="button-inner" onclick="step3()">Suivant</a>
					</div>
					
					<div id="dates-frm" class="common-frm" style="display:none">
						<span class="part-top">Vos coordonnees</span>
						<div class="top-field">
							<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="name" id="name" value="Nom">
							<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="firstname" id="firstname" value="Prénom">
						</div>
						<div class="bottom-field">
							<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="email" id="email" value="Adresse email">
							<input type="text" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="phoneno" id="phoneno" value="N° de telephone">
						</div>
						<span class="part-bottom">Vous voyagez:</span>
					</div>
				</form>
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
				<div class="client-name">
					<?php echo $userdetailsinfo[0]['user_name'];?>
				</div>
				<div class="client-name">
					<?php echo $userdetailsinfo[0]['position'];?>
				</div>
				<div class="client-image">
					<?php if(isset($userdetailsinfo[0]['image']) && !empty($userdetailsinfo[0]['image'])){?>
						<img width="276px" height="283px" src="<?php echo $this->config->site_url();?>application/uploads/userimages/original/<?php echo $userdetailsinfo[0]['image'];?>" alt="" title="" border="0">
					<?php }else{?>
						<img width="276px" height="283px" src="<?php echo $this->config->site_url();?>application/uploads/no_image100.jpg" alt="<?php echo $userdetailsinfo[0]['user_name'];?>" title="<?php echo $userdetailsinfo[0]['user_name'];?>" border="0">
					<?php } ?>
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
			<img src="<?php echo $this->config->site_url();?>application/uploads/destinationimage/logodestination/original/<?php echo $destinationdata[0]['logo_destination'];?>" alt="<?php echo $destinationdata[0]['category_name'];?>" title="<?php echo $destinationdata[0]['category_name'];?>">
		</div>
		<?php } ?>
		<div class="infolink-suggestions">
			<?php
			$infopagelinkquand = $this->config->site_url().'infos-pratiques-'.$destinationdata[0]['slug'].'/quand-partir';
			$infopagelinkinfos = $this->config->site_url().'infos-pratiques-'.$destinationdata[0]['slug'].'/infos';
			?>
			<a href="<?php echo $infopagelinkquand; ?>"><h5>QUAND PARTIR</h5></a>
			<a href="<?php echo $infopagelinkinfos; ?>"><h5>INFOS PAYS</h5></a>
		</div>		
	</div>
</div>
<script src="<?php echo $this->config->base_url();?>assets/front/validation/destinationfrm.js"></script>
<style>
.main-button
{
	background-color: #7bc200;
	color: #ffffff;
	cursor: pointer;
	float: left;
	font-size: 16px;
	height: 41px;
	line-height: 39px;
	margin: 5px;
	text-align: center;
	width: 299px;
	
}
.common-frm
{
	border: 1px solid #7bc200;
	height: auto;
	padding: 23px;
	width: 455px;
	float:right;
}
.contact-frm
{
	float:right;
	
}
.button-inner
{
	background-color: #7bc200;
	border: 2px solid #7bc200;
	clear: both;
	color: white;
	cursor: pointer;
	float: right;
	padding: 3px;
	text-align: center;
	width: 74px;
}
.contact-frm span
{
	border: 1px solid #7bc200;
	clear: both;
	float: left;
	margin: 5px;
	padding: 12px;
	width: 272px;
}
.content-form
{
	
	float: right;
	
}
.animation_image {background: #F9FFFF;border: 1px solid #E1FFFF;padding: 10px;width: 500px;margin-right: auto;margin-left: auto;}
.destnation-description {
    bottom: 160px;
    box-sizing: border-box;
    color: #fff;
    left: 222px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 560px;
    z-index: 9999;
	
}
.destnation-description p{
    color: #ffffff;
    font-size: 16px;
    font-weight: normal;
    line-height: 24px;
    margin-right: 150px;
}
</style>


