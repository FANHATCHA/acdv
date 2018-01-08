<?php
function date_in_french ($date){
$month_name=array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août",
"Septembre","Octobre","Novembre","Décembre");

$split = preg_split('/-/', $date);
$year = $split[0];
$month = round($split[1]);
$day = round($split[2]);

$week_day = date("w", mktime(12, 0, 0, $month, $day, $year));
return $date_fr = $month_name[$month] .' '. $year;
}
function date_in_french2 ($date){
$month_name=array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août",
"Septembre","Octobre","Novembre","Décembre");

$split = preg_split('/-/', $date);
$year = $split[0];
$month = round($split[1]);
$day = round($split[2]);

$week_day = date("w", mktime(12, 0, 0, $month, $day, $year));
return $date_fr = $day.' '.$month_name[$month] .' '. $year;
}

?>
<div class="blog-page">
<?php

if(isset($blog_slider) && !empty($blog_slider)){?> 

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

			$i = 1;

			foreach($blog_slider as $blog_sliders)

			{?>

				<img width="1500" height="400" src="<?php echo $this->config->base_url();?>application/uploads/bannerimages/original/<?php echo $blog_sliders['banner_image']; ?>" title="#htmlcaption<?php echo $i;?>" alt="<?php echo $blogdata[0]['blog_title']; ?>" />

			<?php $i++;

			}

		?>

	</div>

</div>	

<?php } ?>

<div class="wrapper">

	<div class="destination-product blog-content">

		<div id="home-left" role="main">

			<div class="single_blog">

				<div class="blog-title">

					<h1><?php echo $blogdata[0]['blog_title'];?></h1>
					<?php
							$archivedate2 = date('Y-m-d',strtotime($blogdata[0]['blog_date']));
					?>		
					<span><?php echo date_in_french2($archivedate2); ?></span>

				</div>

				<div class="blog-description">

					<?php echo $blogdata[0]['blog_content'];?>

				</div>

				<div class="google-cooment">

					<?php 

					$urlsegment 	  = $this->uri->rsegments[1];

					

					?>

					<div id="fb-root"></div>

					<script type="text/javascript">
					 (function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
					  fjs.parentNode.insertBefore(js, fjs);
					}
					(document, 'script', 'facebook-jssdk'));
					</script>
					<div class="fb-comments" data-href="<?php echo $this->config->base_url().$this->uri->uri_string;?>" data-numposts="3" data-colorscheme="light" data-width="100%"></div>

				</div>

				<div class="googleplushbutton">

					<!-- Place this tag in your head or just before your close body tag. -->

					<script src="https://apis.google.com/js/platform.js" async defer></script>

					<!-- Place this tag where you want the +1 button to render. -->

					<div class="g-plusone" data-size="medium" data-annotation="inline" data-width="300"></div>

				</div>

			</div>

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

			<div class="articles blog_right_menu1">

				<h3>Articles r&eacute;cents</h3>

				<ul>

					<?php foreach($recentarticle as $recentarticles){

						$articleY =  date('Y',strtotime($recentarticles['created_date']));

						$articleM =  date('m',strtotime($recentarticles['created_date']));

						$articlelink = $this->config->base_url().'blog/'.$articleY.'/'.$articleM.'/'.$recentarticles['slug'];?>

						<li>

							<a href="<?php echo $articlelink;?>"><?php echo $recentarticles['blog_title'];?></a>

						</li>

					<?php } ?>

				</ul>	

			</div>

			<?php if(isset($blogslidelink[0]['description']) && !empty($blogslidelink[0]['description'])){ ?>
		<div class="Comitetidorial blog_right_menu1">	
			<h3>Comit&eacute; &eacute;tidorial du blog</h3>	
			<?php echo $blogslidelink[0]['description'];?>
		</div>
		<?php } ?>
			<div class="archives blog_right_menu">

				<h3>Archives</h3>

				<ul>

					<?php 

					foreach($archive as $archives){

						$articleY =  date('Y',strtotime($archives['created_date']));

						$articleM =  date('m',strtotime($archives['created_date']));

						$archivelink = $this->config->base_url().'blog/'.$articleY.'/'.$articleM;?>

						<li>
							<?php
								$archivedate = date('Y-m-d',strtotime($archives['created_date']));
							?>		
							<a href="<?php echo $archivelink;?>"><?php echo date_in_french($archivedate);?> (<?php print_r($archives['countmonth']);?>)</a>

						</li>

					<?php } ?>

				</ul>	

			</div>

			<div class="Lesplus blog_right_menu1">

				<h3>Les plus consult&eacute;s</h3>

				<ul>

					<?php foreach($mostview as $mostviews){

						$articleY =  date('Y',strtotime($mostviews['created_date']));

						$articleM =  date('m',strtotime($mostviews['created_date']));

						$articlelink = $this->config->base_url().'blog/'.$articleY.'/'.$articleM.'/'.$mostviews['slug'];?>

						<li>

							<a href="<?php echo $articlelink;?>"><?php echo $mostviews['blog_title'];?> - <?php echo $mostviews['hits'];?> visites</a>

						</li>

					<?php } ?>

				</ul>	

			</div>

		</div>

</div>
</div>