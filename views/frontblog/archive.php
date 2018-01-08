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
<script>
var filteroption = '';
initPaginator(filteroption);
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
			<div class="blog-detailsss"  id="blog-details">
				<div id="scrollingcontent">
					<div class="headertoo">&nbsp;</div>
					<div class="headertoo">&nbsp;</div>
					<div class="listitems" id="content">
						<?php 
						$current_url_desti 				= $_SERVER['REQUEST_URI'];
						if(isset($_GET['page']) && !empty($_GET['page']))
						{
							$current_url_desti =strtok($_SERVER["REQUEST_URI"],'?');
						}
						if(isset($result) && !empty($result))
						{	
							foreach($result as $blogdata)
							{
								$articleY =  date('Y',strtotime($blogdata['created_date']));
								$articleM =  date('m',strtotime($blogdata['created_date']));
								$singlebloglink = $this->config->base_url().'blog/'.$articleY.'/'.$articleM.'/'.$blogdata['slug'];
								?>
								<div class="listitempage" data-url="<?php echo $current_url_desti; ?>?page=<?php echo $current_page; ?>">
									<div class="listitem" data-page-url="<?php echo $current_url_desti; ?>?page=<?php echo $current_page; ?>">
										<div class="clientreview_details_row">
											<div class="clientreview_details_cols">
													<?php if(isset($blogdata['featured_image']) && !empty($blogdata['featured_image'])){?>
														<a href="<?php echo $singlebloglink;?>" title="<?php echo $blogdata['blog_title'];?>"><img width="250" height="250" src="<?php echo $this->config->site_url();?>application/uploads/blog/featuredimage/original/<?php echo $blogdata['featured_image'];?>" border="0"></a>
													<?php }else{ ?>
														<img width="250" height="250" src="<?php echo $this->config->site_url();?>application/uploads/no_image250.jpg" alt="<?php echo $blogdata['blog_title'];?>" title="<?php echo $blogdata["blog_title"];?>" border="0">
													<?php } ?>
											</div>
											<div class="artical_cols1">
												<div class="blog_cols1">
													<h2>
														<a href="<?php echo $singlebloglink;?>">
															<?php echo $blogdata['blog_title'];?>
														</a>
													</h2>
													<?php $archivedate2 = date('Y-m-d',strtotime($blogdata['blog_date']));?>
													<span class="date">
														<?php echo date_in_french($archivedate2);?>
													</span>
													<div class="blog_content_row">
														<?php echo string_limit($blogdata['blog_content'],340);?>
													</div>
													<a href="<?php echo $singlebloglink;?>" class="blog_btn_right">
														Lire la suite
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>			
							<?php }
						} ?>
						<div class="animation_image" style="display:none" align="center">
							<img src="<?php echo $this->config->site_url();?>application/uploads/ajax-loader.gif" alt="loading..." title="loading...">
						</div>
					</div>	
				</div>	
			</div>	
		</div>
		<div style="display:none">
			<?php foreach ($links as $link) {
				echo $link;
			} ?>
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
<script type="text/javascript">
   <?php if($next_data_url != ''): ?>
   next_data_url = '<?php echo $next_data_url; ?>';
   <?php endif; ?>
   <?php if($prev_data_url != ''): ?>
   prev_data_url = '<?php echo $prev_data_url; ?>';
   <?php endif; ?>
   primeCache();
</script>