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
/*var windowsize = $(window).width();
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
	$(document).ready(function() 
	{
		var track_load = 0; //total loaded record group(s)
		var loading  = false; //to prevents multipal ajax loads
		var total_groups = <?php echo $total_groups; ?>; //total record group(s)
		var filterbydate  = document.getElementById("selecteddate").value;
		var filterbydesti = document.getElementById("selecteddesti").value;
		$('#clientreview-details').load("<?php echo $this->config->site_url();?>ajaxcall/autoload_clientreview", {'group_no': track_load,'filterbydate': filterbydate,'filterbydesti': filterbydesti}, function() {track_load++;}); //load first group
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
}*/
function datechange(values,destination)
{
	if(values == '-1')
	{
		if(destination != ''){
			history.replaceState(null, null, 'lavis-de-nos-clients?page=1&destination='+destination);
		}else{
			history.replaceState(null, null, 'lavis-de-nos-clients?page=1');
		}
	}
	else
	{
	
		if(destination != ''){
			history.replaceState(null, null, 'lavis-de-nos-clients?page=1&date='+values+'&destination='+destination);
		}else{
			history.replaceState(null, null, 'lavis-de-nos-clients?page=1&date='+values);
		}
	}
	location.reload(); 
}
function destinationchange(values,dates)
{
	
	if(values == '-1')
	{
		if(dates != ''){
			history.replaceState(null, null, 'lavis-de-nos-clients?page=1&date='+dates);
		}else{
			history.replaceState(null, null, 'lavis-de-nos-clients?page=1');
		}
	}
	else
	{
		
		if(dates != ''){
			history.replaceState(null, null, 'lavis-de-nos-clients?page=1&destination='+values+'&date='+dates);
		}else{
			history.replaceState(null, null, 'lavis-de-nos-clients?page=1&destination='+values);
		}
	}
	location.reload(); 
}
</script>
<script>
var filteroption = '<?php echo $filteroption; ?>';
initPaginator(filteroption);
</script>
<?php 
$dates = '';
$destination = '';
if(isset($_GET['date']) && !empty($_GET['date']))
{
	$dates = $_GET['date'];
} 
if(isset($_GET['destination']) && !empty($_GET['destination'])){
	$destination = $_GET['destination'];
}
?>
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
				<select name="review_date" id="review_date" class="cu_dds2"  onchange="datechange(this.value,'<?php echo $destination;?>');" >
					<option value="-1">Date de voyage</option>
					<?php
						foreach($reviewdate as $reviewdate){ $reviewdate_format = date('Y-m-d',strtotime($reviewdate['review_date']));?>
						<option <?php if(isset($_GET['date']) && !empty($_GET['date']) && $_GET['date'] == date('m-Y',strtotime($reviewdate['review_date']))){ echo 'selected="selected"';}?> value="<?php echo date('m-Y',strtotime($reviewdate['review_date']));?>"><?php echo date_clientreview_french2($reviewdate_format);?></option>
					<?php }?>
				</select> 
			</div>
			<div class="filter_clientreview2">	
				<select name="destination" id="destination" class="cu_dds3" onchange="destinationchange(this.value,'<?php echo $dates;?>');">
					<option value="-1">Choisir un Pays</option>
					<?php
						$commod = new Commonlibmodel();
						foreach($reviewdestination as $reviewdestinations){?>
						<option <?php if(isset($_GET['destination']) && !empty($_GET['destination']) && $_GET['destination'] == $reviewdestinations){ echo 'selected="selected"';}?>  value="<?php echo $reviewdestinations;?>"><?php echo $commod->getdestinationidtoname($reviewdestinations);?></option>
					<?php }?>
				</select>
			</div>
		</div>
		
    	<div id="autoscrolling_client"></div>
		
		<div class="destination-product clientreview-content">
			<div id="scrollingcontent" class="client-details">
				<div class="headertoo">&nbsp;</div>
				<div class="headertoo">&nbsp;</div>
				<div class="listitems" id="content">
					<?php 
					$modalc = new Commonlibmodel();
					if(isset($results) && !empty($results)){
					foreach ($results as $clientreview_datas){  ?>
						<div class="listitempage" data-url="<?php echo $this->config->site_url(); ?>lavis-de-nos-clients?page=<?php echo $current_page; ?>">
							<div class="listitem" data-page-url="<?php echo $this->config->site_url(); ?>lavis-de-nos-clients?page=<?php echo $current_page; ?>">
								<div class="clientreview_details_row">
									<div class="clientreview_details_cols">
										<?php if(isset($clientreview_datas["client_review_image"]) && !empty($clientreview_datas["client_review_image"])){?>
											<img width="250" height="250" src="<?php echo $this->config->site_url();?>application/uploads/clientreview/original/<?php echo $clientreview_datas['client_review_image'];?>" alt="<?php echo $clientreview_datas['name'];?>" title="<?php echo $clientreview_datas['name'];?>" border="0">
										<?php }else{ ?> 
											<img  width="250px" height="250px" src="<?php echo $this->config->site_url();?>application/uploads/no_image250.jpg" alt="<?php echo $clientreview_datas['name'];?>" title="<?php echo $clientreview_datas['name'];?>" border="0">
										<?php } ?>
									</div>
									<div class="clientreview_details_cols1">
										<h3><?php echo $clientreview_datas['name']?></h3>
										<?php $clientreviewdate = date('Y-m-d',strtotime($clientreview_datas['review_date']));?>
										<h4>
											<?php echo $clientreview_datas['thems_name'].' - '.date_clientreview_french2($clientreviewdate);?>
										</h4>
										<?php $categoryids 	= explode(',',$clientreview_datas['destination_id']);
										$destinatitotal = count($categoryids);
										if(isset($categoryids) && !empty($categoryids))
										{	$i = 0;
											echo '<h5>';
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
												$categorydetails  =  $modalc->getcategoryname($destinationids);
												echo $categorydetails[0]['category_name'].$comma;
												$i++;
											}
											echo '</h5>';
										}
										else
										{
											echo '<h5>-</h5>';
										}?>	
										<div class="clientreview_details_cols1_row">
											<div class="clientreview_details_cols1_row1">
												<?php echo $clientreview_datas['client_review']?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } }else{ ?>
						<div class="no_recordfound_clientreview"><?php echo $this->lang->line('CLIENT_REVIE_PAGE_NO_RECORD');?></div>
					<?php } ?>
				 </div>
			</div>
			<div class="animation_image" style="display:none" align="center">
            	<img src="<?php echo $this->config->site_url();?>application/uploads/ajax-loader.gif" alt="loading..." title="loading...">
            </div>
		</div>	
		<div style="display:none">
			<?php foreach ($links as $link) {
				echo $link;
			} ?>
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

<script type="text/javascript">
   <?php if($next_data_url != ''): ?>
   next_data_url = '<?php echo $next_data_url; ?>';
   <?php endif; ?>
   <?php if($prev_data_url != ''): ?>
   prev_data_url = '<?php echo $prev_data_url; ?>';
   <?php endif; ?>
   primeCache();
</script>
