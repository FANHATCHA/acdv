<?php
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
?>
<script type="text/javascript">
var windowsize = $(window).width();
if (windowsize < 767) {
	var scrollminisheight = 675;
}
else
{
	var scrollminisheight = 100;
}
clientreview();
function clientreview()
{
	
	/*var hrml = $("clientreview-details").html();
	alert(hrml);
	if(hrml == '')
	{
		$('#clientreview-details').html('<div class="no_recordfound_clientreview"><?php echo $this->lang->line('CLIENT_REVIE_PAGE_NO_RECORD');?></div>');
	}*/
	$(document).ready(function() 
	{
		var track_load = 0; //total loaded record group(s)
		var loading  = false; //to prevents multipal ajax loads
		var total_groups = <?php echo $total_groups; ?>; //total record group(s)
		
		var filterbydate  = document.getElementById("selecteddate").value;
		var filterbydesti = document.getElementById("selecteddesti").value;

		$('#clientreview-details').load("<?php echo $this->config->site_url();?>ajaxcall/autoload_clientreview", {'group_no': track_load,'filterbydate': filterbydate,'filterbydesti': filterbydesti}, function() {track_load++;}); //load first group
		
		/*$.ajax({
		  url: "<?php echo $this->config->site_url();?>ajaxcall/autoload_clientreview",
		  type: "post",
		  data: {'group_no': track_load,'filterbydate': filterbydate,'filterbydesti': filterbydesti},
		  success: function(data){
				//alert(data);
				$('#clientreview-details').html(data);
		  },
		  error:function(){
			 alert('error');
		  }   
		});*/
		
		$(window).scroll(function() { //detect page scroll

			if($(window).scrollTop() + $(window).height() > $(document).height() - scrollminisheight)  //user scrolled to bottom of the page?

			{

				if(track_load <= total_groups && loading==false) //there's more data to load

				{

					loading = true; //prevent further ajax loading

					$('.animation_image').show(); //show loading image

					//load data from the server using a HTTP POST request
					var filterbydate  = document.getElementById("selecteddate").value;
					var filterbydesti = document.getElementById("selecteddesti").value;

					$.post('<?php echo $this->config->site_url();?>ajaxcall/autoload_clientreview',{'group_no': track_load,'filterbydate': filterbydate,'filterbydesti': filterbydesti}, function(data){
						
						//alert(data);	
						if(data == '<div class="no_recordfound_clientreview">No Record Found...</div>')
						{	
							$('.animation_image').hide();
							data = '';
						}
						$("#clientreview-details").append(data); //append received data into the element

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
}

function datechange(values)
{
	if(values == '-1')
	{
		document.getElementById("selecteddate").value = '';
	}
	else
	{
	  document.getElementById("selecteddate").value = values;
	}
	clientreview();
}
function destinationchange(values)
{
	if(values == '-1')
	{
		document.getElementById("selecteddesti").value = '';
	}
	else
	{
	  document.getElementById("selecteddesti").value = values;
	}
	clientreview();
}
</script>

<div class="client-review">

	<div class="client-review-bnner">

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

				</div>

				<div id="slider" class="nivoSlider">

					<?php

					if(isset($homeslider) && !empty($homeslider))

					{ 	$i = 1;

						foreach($homeslider as $homeslide)

						{?>

							<img width="1500" height="400" src="<?php echo $this->config->base_url();?>application/uploads/sliderimages/<?php echo $homeslide['image']; ?>" title="#htmlcaption<?php echo $i;?>" alt="<?php echo $homeslide['slider_title']; ?>" />

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

							<h1><?php echo $homeslide['slider_title'];?> </h1>

							<h3><?php echo $homeslide['short_description'];?></h3>

							<p><?php echo $homeslide['description'];?></p>

						</div>

					<?php $i++;

					}

				}

				?>

		</div>	

	</div>	

	<div class="wrapper">
		<div class="client_filer_main">
			<div class="filter_clientreview">
				<select name="review_date" id="review_date" class="cu_dds2" onchange="datechange(this.value);">
					<option value="-1">Date de voyage</option>
					<?php
						foreach($reviewdate as $reviewdate){ $reviewdate_format = date('Y-m-d',strtotime($reviewdate['review_date']));?>
						<option value="<?php echo date('m-Y',strtotime($reviewdate['review_date']));?>"><?php echo date_clientreview_french2($reviewdate_format);?></option>
					<?php }?>
				</select> 
			</div>
			<div class="filter_clientreview2">	
				<select name="destination" id="destination" class="cu_dds3" onchange="destinationchange(this.value);">
					<option value="-1">Choisir un Pays</option>
					<?php
						$commod = new Commonlibmodel();
						foreach($reviewdestination as $reviewdestinations){?>
						<option value="<?php echo $reviewdestinations;?>"><?php echo $commod->getdestinationidtoname($reviewdestinations);?></option>
					<?php }?>
				</select>
			</div>
		</div>
    	<div class="destination-product clientreview-content">

			<div class="client-details" id="clientreview-details"></div>

            <div class="animation_image" style="display:none" align="center">

            	<img src="<?php echo $this->config->site_url();?>application/uploads/ajax-loader.gif" alt="loading..." title="loading...">

            </div>

		</div>		

        

		<div class="sidebar" id="sticker">

			<div class="formbutn">

				<a onclick="showfrm('<?php echo $this->lang->line('RECEVEZ_ALL_PAGES_BUTTON_CIREVIEW');?>');"  class="header_right_btn3">
				DEMANDE DE DEVIS
				<!--<?php echo $this->lang->line('RECEVEZ_ALL_PAGES_BUTTON_CIREVIEW');?>--></a>

			</div>

			<?php if(isset($sidebarcontent[0]['description']) && !empty($sidebarcontent[0]['description'])){?>

				<div class="client-sidebar-contant">

					<?php echo $sidebarcontent[0]['description'];?>

				</div>

			<?php  } ?>

			<?php if(isset($companyinfo[0]['description']) && !empty($companyinfo[0]['description'])){?>

				<div class="company-destination-info">

					<?php echo $companyinfo[0]['description'];?>

				</div>

			<?php  } ?>

		</div>

    </div>
	<input type="hidden" name="selecteddate" id="selecteddate" value="">
	<input type="hidden" name="selecteddesti" id="selecteddesti" value="">
</div>

