<?php
$query = $this->db->query("select id FROM menu ORDER BY id ASC LIMIT 0,1");
$result = $query->result();
$firstmenuid = $result[0]->id;
?>

<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- add "navbar-no-scroll" class to disable the scrolling of the sidebar menu -->
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone">
					</div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<form class="sidebar-search" action="extra_search.html" method="POST">
						<div class="form-container">
						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				
				<!---=============== MENU PART START ================--->
				<li class="start <?php if($this->router->class =='dashboard')echo 'active';?>">
					<a href="<?php echo $this->config->site_url();?>admin/dashboard">
						<i class="fa fa-home"></i>
						<span class="title">
							<?php echo $this->lang->line('DASHBOARD_MENU');?>
						</span>
						<span class="selected">
						</span>
					</a>
				</li>
				<li class="<?php if($this->router->class =='setting' || $this->router->class =='socialmedia')echo 'active open';?>">
					<a href="javascript:;">
						<i class="fa fa-wrench"></i>
						<span class="title">
							<?php echo $this->lang->line('CONFIGRATION_MENU');?>
						</span>
						<span class="arrow ">
						</span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($this->router->class =='setting')echo 'active';?>">
							<a href="<?php echo $this->config->site_url();?>admin/setting">
								<?php echo $this->lang->line('GENERAL_SETTING_MENU');?>
							</a>
						</li>
						<li class="<?php if($this->router->class =='socialmedia')echo 'active';?>">
							<a href="<?php echo $this->config->site_url();?>admin/socialmedia">
								<?php echo $this->lang->line('SOCIAL_MEDIA_MENU');?>
							</a>
						</li>
					</ul>
				</li>
				<li class="<?php if($this->router->class =='banner')echo 'active open';?>">
					<a href="javascript:;">
						<i class="fa fa-folder"></i>
						<span class="title">
							<?php echo $this->lang->line('BANNER_MENU');?>
						</span>
						<span class="arrow ">
						</span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($this->router->class =='banner')echo 'active';?>">
							<a href="<?php echo $this->config->site_url();?>admin/banner">
								<?php echo $this->lang->line('BANNER_MANAGEMENT');?>
							</a>
						</li>
					</ul>
				</li>
				
				<li class="<?php if($this->router->class =='product' || $this->router->class =='product_category')echo 'active open';?>">
					<a href="javascript:;">
						<i class="fa fa-folder"></i>
						<span class="title">
							<?php echo $this->lang->line('PRODUCT_MENU');?>
						</span>
						<span class="arrow ">
						</span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($this->router->class =='product')echo 'active';?>">
							<a href="<?php echo $this->config->site_url();?>admin/product">
								<?php echo $this->lang->line('MAIN_PRODUCT_MENU');?>
							</a>
						</li>
						<li class="<?php if($this->router->class =='product_category')echo 'active';?>">
							<a href="<?php echo $this->config->site_url();?>admin/product_category">
								<?php echo $this->lang->line('PRODUCT_CATEGORY_MENU');?>
							</a>
						</li>
					</ul>
				</li>
				
				<li class="<?php if($this->router->class =='practicalinfo' || $this->router->class =='practicalinfocategory')echo 'active open';?>">
					<a href="javascript:;">
						<i class="fa fa-folder"></i>
						<span class="title">
							<?php echo $this->lang->line('PRODUCT_INFO_MENU');?>
						</span>
						<span class="arrow ">
						</span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($this->router->class =='practicalinfo')echo 'active';?>">
							<a href="<?php echo $this->config->site_url();?>admin/practicalinfo">
								<?php echo $this->lang->line('PRODUCT_INFO_MENU');?>
							</a>
						</li>
						<li class="<?php if($this->router->class =='practicalinfocategory')echo 'active';?>">
							<a href="<?php echo $this->config->site_url();?>admin/practicalinfocategory">
								<?php echo $this->lang->line('PRODUCT_INFO_CAT_MENU');?>
							</a>
						</li>
					</ul>
				</li>
				
				<li class="<?php if($this->router->class =='cmspage')echo 'active open';?>">
					<a href="javascript:;">
						<i class="fa fa-folder"></i>
						<span class="title">
							<?php echo $this->lang->line('CONTENT_MENU');?>
						</span>
						<span class="arrow ">
						</span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($this->router->class =='setting')echo 'active';?>">
							<a href="<?php echo $this->config->site_url();?>admin/cmspage">
								<?php echo $this->lang->line('CMS_PAGE_MENU');?>
							</a>
						</li>
					</ul>
				</li>
                <li class="<?php if($this->router->class =='tags')echo 'active open';?>">
					<a href="javascript:;">
						<i class="fa fa-folder"></i>
						<span class="title">
							<?php echo $this->lang->line('TAG_MENU');?>
						</span>
						<span class="arrow ">
						</span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($this->router->class =='tags')echo 'active';?>">
							<a href="<?php echo $this->config->site_url();?>admin/tags">
								<?php echo $this->lang->line('TAG_MENU_MNG');?>
							</a>
						</li>
					</ul>
				</li>
                <li class="<?php if($this->router->class =='newsletter')echo 'active open';?>">
					<a href="javascript:;">
						<i class="fa fa-folder"></i>
						<span class="title">
							<?php echo $this->lang->line('NEWSLETTER_MENU');?>
						</span>
						<span class="arrow ">
						</span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($this->router->class =='newsletter')echo 'active';?>">
							<a href="<?php echo $this->config->site_url();?>admin/newsletter">
								<?php echo $this->lang->line('NEWSLETTER_MENU_MNG');?>
							</a>
						</li>
					</ul>
				</li>
				
				<li class="<?php if($this->router->class =='redirect')echo 'active open';?>">
					<a href="javascript:;">
						<i class="fa fa-folder"></i>
						<span class="title">
							<?php echo $this->lang->line('URL_MENU');?>
						</span>
						<span class="arrow ">
						</span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($this->router->class =='redirect')echo 'active';?>">
							<a href="<?php echo $this->config->site_url();?>admin/redirect">
								<?php echo $this->lang->line('URL_MENU_MNG');?>
							</a>
						</li>
					</ul>
				</li>
				
				<li class="<?php if($this->router->class =='menu' || $this->router->class =='menulink')echo 'active open';?>">
					<a href="javascript:;">
						<i class="fa fa-folder"></i>
						<span class="title">
							<?php echo $this->lang->line('MENU_NAME');?>
						</span>
						<span class="arrow ">
						</span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($this->router->class =='menu')echo 'active';?>">
							<a href="<?php echo $this->config->site_url();?>admin/menu">
								<?php echo $this->lang->line('CUSTOM_MENU_MNG');?>
							</a>
						</li>
						<li class="<?php if($this->router->class =='menulink')echo 'active';?>">
							<a href="<?php echo $this->config->site_url();?>admin/menulink?menu=<?php echo $firstmenuid; ?>">
								<?php echo $this->lang->line('CUSTOM_MENU_LINK_MNG');?>
							</a>
						</li>
					</ul>
				</li>
				
				<li class="<?php if($this->router->class =='backup')echo 'active open';?>">
					<a href="javascript:;">
						<i class="fa fa-folder"></i>
						<span class="title">
							<?php echo $this->lang->line('DB_BACKUP_MAIN');?>
						</span>
						<span class="arrow ">
						</span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($this->router->class =='backup')echo 'active';?>">
							<a href="<?php echo $this->config->site_url();?>admin/backup">
								<?php echo $this->lang->line('DB_BACKUP');?>
							</a>
						</li>
					</ul>
				</li>
				
				<li class="<?php if($this->router->class =='countdown')echo 'active open';?>">
					<a href="javascript:;">
						<i class="fa fa-folder"></i>
						<span class="title">
							<?php echo $this->lang->line('COUNTDOWN_MAIN');?>
						</span>
						<span class="arrow ">
						</span>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($this->router->class =='countdown')echo 'active';?>">
							<a href="<?php echo $this->config->site_url();?>admin/countdown">
								<?php echo $this->lang->line('COUNTDOWN_MENU');?>
							</a>
						</li>
					</ul>
				</li>
				<!---=============== MENU PART END ================--->
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
</div>