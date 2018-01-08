<div class="client-review">

<div class="client-review-bnner2">

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

<div class="representatives_mn">
	<div class="wrapper">

		<div class="des_voyages">
			<a name="des-voyages"></a>
			<h2>Des voyages <span>&agrave; la carte</span></h2>
			<p>H&ocirc;tels,&nbsp;excursions ou visites... vous pouvez choisir et r&eacute;server ce que vous souhaitez. Vous serez en contact avec un <span>conseiller d&eacute;di&eacute;</span>,&nbsp;sp&eacute;cialiste de sa destination,&nbsp;qui &eacute;coutera votre demande et saura fa&ccedil;onner avec vous le voyage dont <span>vous</span> r&ecirc;vez. Il pourra adapter vos &eacute;tapes,&nbsp;rajouter les excursions de votre choix,&nbsp;vous conseiller,&nbsp;et surtout vous proposer le voyage qui vous convient.
			De plus,&nbsp;si vous le souhaitez,&nbsp;vous pourrez rencontrer la <span>population locale</span>,&nbsp;aller dans des lieux typiques et recul&eacute;s ou encore vivre pleinement les f&ecirc;tes culturelles locales.</p>
			<div class="separation"></div>
		</div>
		<div class="des_conseillers">
			<a name="des-conseillers"></a>
			<h2>Des conseillers <span>sp&eacute;cialistes</span></span></h2>
			<div class="representatives">
				<?php foreach($representativedata as $representativedatas) { ?>
					<div class="representatives_row">
						<div class="image">
							<?php if(isset($representativedatas['image']) && !empty($representativedatas['image'])){?>
								<img src="<?php echo $this->config->site_url();?>application/uploads/userimages/original/<?php echo $representativedatas['image'];?>" border="0" title="<?php echo $representativedatas['user_name'];?>" alt="<?php echo $representativedatas['user_name'];?>">
								<?php }else{  ?>
								<img src="<?php echo $this->config->site_url();?>timthumb.php?src=<?php echo $this->config->site_url();?>application/uploads/no_image250.jpg&h=250&w=250&c=1" alt="<?php echo $representativedatas['user_name'];?>" title="<?php echo $representativedatas['user_name'];?>" border="0">
							<?php }		?>
						</div>
						<div class="representatives_cols_rt">
							<h2><?php echo $representativedatas['user_name']; ?></h2>
							<h3><?php echo $representativedatas['position']; ?></h3>
							<div class="retentive_description">
								<?php echo $representativedatas['cms_page_description']; ?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
			<div class="separation"></div>
		</div>
		<div class="des_Une">
			<a name="une-assistance"></a>
			<h2>Une assistance <span>24/24</span></h2>
			<p>Nous disposons d'un v&eacute;ritable r&eacute;seau qui vous accompagnera tout au long de votre voyage : outre le fait d'offrir de tr&egrave;s nombreuses activit&eacute;s,&nbsp;nos repr&eacute;sentants locaux seront &agrave; votre disposition 24h/24 lors de votre voyage,&nbsp;<span>en cas de besoin</span>.</p>
		</div>
	</div>
</div>
</div>