<?php  if(isset($pagedata[0]['cms_image']) && !empty($pagedata[0]['cms_image'])){?>
<div class="banner_image">
	<img width="1500" height="400" src="<?php echo $this->config->site_url().'application/uploads/CMS_bannerimage/'.$pagedata[0]['cms_image'];?>" alt="<?php echo $pagedata[0]['cms_title'];?>" title="<?php echo $pagedata[0]['cms_title'];?>">
</div>
<?php } ?>
<div class="wrapper">
	<div class="cms_page">
		<div class="content">
			<h1><?php echo $pagedata[0]['cms_title']; ?></h1>
			<p class="description"><?php echo $pagedata[0]['cms_content']; ?></p>
		</div>
	</div>
</div>