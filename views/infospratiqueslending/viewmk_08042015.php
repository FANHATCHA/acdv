<?php if(isset($pratical_info_pages) && !empty($pratical_info_pages)){
$slug2 = $this->uri->segment_array();
$destslug  = array_slice($slug2,-1,1);
$destslug1 = array_slice($slug2,-2,1);
$destslug2 = array_slice($slug2,-3,1);
?>

<div class="piratical-information">

	<div class="info-banner">
		<?php
		if(isset($categoryimage['image']) && !empty($categoryimage['image'])){?>
			<img width="1500" height="400" src="<?php echo $this->config->site_url().'application/uploads/destinationimage/categoryimage/original/'.$categoryimage['image'];?>" alt="<?php echo $categoryimage['category_name'];?>" title="<?php echo $categoryimage['category_name'];?>">
		<?php } ?>
	</div>
	<div class="wrapper">
		<div>
			<?php
			$slug = $this->uri->segment_array();
			$destslug  = array_slice($slug,0,1);
			$destslug2  = end($this->uri->segment_array());
			$commod 		 = new Commonlibmodel();
			$destinationname = $commod->getcatslugtocatname($destslug[0]);
			$particalmod 	 = new infospratiqueslendingmodel();
			
			?>
			<div class="proinfo-brd">
				<div class="breadcrumbs">
					<a href="<?php echo $this->config->base_url();?>"><span>Accueil</span></a> > <a href="<?php echo $this->config->base_url().'destination/'.$destslug[0];?>"><span><?php echo ucfirst($destinationname);?></span></a> > <span><?php echo ucfirst('infos');?></span>
				</div>
			</div>
			<div class="product_bot_lt_info">
				<div class="pro-bottom-info">
					<ul id="product-info-tabs">
						<?php 
							$i = 1 ;
							foreach($pratical_info_pages as $pratical_info_page)
							{
								$activeclass = '';
								$slugurl = end($this->uri->segment_array());
								$detailscatslugandname 	 = $particalmod->getdetailscatidtoslug($pratical_info_page['practical_information_id']);
								if($i == '1'){ $activeclass = "class='active'";}
								$infopagelinkquand = $this->config->site_url().$destslug[0].'/'.$detailscatslugandname['slug'];
							?>
							<li id="tab1_product" <?php echo $activeclass;?>><a href="<?php echo $infopagelinkquand;?>#product-info-tabs"><?php echo $detailscatslugandname['category_name'];?></a></li>
							<?php 
							$i++;}
						?>
					</ul>
					<div class="praticalinfo-content">
						<?php
						echo $praticalinfocontent;	
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>