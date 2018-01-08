<?php
setlocale(LC_TIME, "fr_FR");
$year  = $this->uri->segments[2];
$month = $this->uri->segments[3];
?>
<?php
// enter date format 2011-01-31 (Y-m-d)
function date_in_french ($date){
$week_name = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
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
$(document).ready(function() {
	var track_load = 0; //total loaded record group(s)
	var loading  = false; //to prevents multipal ajax loads
	var total_groups = <?php echo $total_groups; ?>; //total record group(s)
	var year = <?php echo $year; ?>; 
	var month = <?php echo $month; ?>; 
	$('#blog-details').load("<?php echo $this->config->site_url();?>ajaxcall/autoload_archiveblogdata", {'group_no': track_load,'year': year,'month': month}, function() {track_load++;}); //load first group
	$(window).scroll(function() { //detect page scroll
		if($(window).scrollTop() + $(window).height() > $(document).height() - scrollminisheight)  //user scrolled to bottom of the page?  //user scrolled to bottom of the page?
		{
			if(track_load <= total_groups && loading==false) //there's more data to load
			{
				loading = true; //prevent further ajax loading
				$('.animation_image').show(); //show loading image
				//load data from the server using a HTTP POST request
				$.post('<?php echo $this->config->site_url();?>ajaxcall/autoload_archiveblogdata',{'group_no': track_load,'year': year,'month': month}, function(data){
					$("#blog-details").append(data); //append received data into the element
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
</script>
<div class="blog-page">
	<div class="blog-review-bnner">
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
							<p><?php echo $homeslide['description'];?></p>
							<span><?php echo $homeslide['short_description'];?></span>
						</div>
					<?php $i++;
					}
				}
				?>
		</div>	
	</div>	
	<div class="wrapper">
		
		<div id="category_show_mobile">Cat&eacute;gories</div>
		<div class="mobile_left_panel"  id="mobile_left_panel_blog">
			<div class="category blog_right_menu">	
				<h3>Cat&eacute;gories</h3>	
				<ul>	
					<?php foreach($category as $categorys){	
						$categoryurl = $this->config->base_url().'category/blog/'.$categorys['slug'];?>		
						<li>		
							<a href="<?php echo $categoryurl;?>"><?php echo $categorys['category_name'];?></a>	
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		
		
		<div class="destination-product blog-content">
			<div class="blog-detailsss" id="blog-details"></div>
            <div class="animation_image" style="display:none" align="center">
            	<img src="<?php echo $this->config->site_url();?>application/uploads/ajax-loader.gif" alt="loading..." title="loading...">
            </div>
		</div>
		
		
		
		<div class="sidebar blogsidebar" id="sticker">	
		<div class="category blog_right_menu">	
			<h3>Cat&eacute;gories</h3>	
			<ul>	
				<?php foreach($category as $categorys){	
					$categoryurl = $this->config->base_url().'category/blog/'.$categorys['slug'];?>		
					<li>		
						<a href="<?php echo $categoryurl;?>"><?php echo $categorys['category_name'];?></a>	
					</li>
				<?php } ?>
			</ul>
		</div>
			<div class="articles blog_right_menu1">				<h3>Articles r&eacute;cents</h3>				<ul>					<?php foreach($recentarticle as $recentarticles){						$articleY =  date('Y',strtotime($recentarticles['created_date']));						$articleM =  date('m',strtotime($recentarticles['created_date']));						$articlelink = $this->config->base_url().'blog/'.$articleY.'/'.$articleM.'/'.$recentarticles['slug'];?>						<li>							<a href="<?php echo $articlelink;?>"><?php echo $recentarticles['blog_title'];?></a>						</li>					<?php } ?>				</ul>				</div>	
		<?php if(isset($blogslidelink[0]['description']) && !empty($blogslidelink[0]['description'])){ ?>
		<div class="Comitetidorial blog_right_menu1">	
			<h3>Comit&eacute; &eacute;tidorial du blog</h3>	
			<?php echo $blogslidelink[0]['description'];?>
		</div>
		<?php } ?>	
		<div class="archives blog_right_menu">				<h3>Archives</h3>
		<ul>					<?php 					foreach($archive as $archives){	
		$articleY =  date('Y',strtotime($archives['created_date']));			
		$articleM =  date('m',strtotime($archives['created_date']));		
		$archivelink = $this->config->base_url().'blog/'.$articleY.'/'.$articleM;?>			
		<li>	
			<?php
				$archivedate = date('Y-m-d',strtotime($archives['created_date']));
			?>		
		<a href="<?php echo $archivelink;?>"><?php echo date_in_french($archivedate);?> (<?php print_r($archives['countmonth']);?>)</a>	
		</li>		
		<?php } ?>				</ul>				</div>			<div class="Lesplus blog_right_menu1">				<h3>Les plus consult&eacute;s</h3>				<ul>					<?php foreach($mostview as $mostviews){						$articleY =  date('Y',strtotime($mostviews['created_date']));						$articleM =  date('m',strtotime($mostviews['created_date']));						$articlelink = $this->config->base_url().'blog/'.$articleY.'/'.$articleM.'/'.$mostviews['slug'];?>						<li>							<a href="<?php echo $articlelink;?>"><?php echo $mostviews['blog_title'];?> - <?php echo $mostviews['hits'];?> visites</a>						</li>					<?php } ?>				</ul>				</div>		</div>	
	</div>
</div>