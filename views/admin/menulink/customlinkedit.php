<div class="clearfix">
</div>
<div class="page-container">
	<?php echo $left_nav;?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					<?php echo $page_title; ?>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo $this->config->site_url();?>admin/dashboard">
								<?php echo $this->lang->line('HOME');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo $this->config->site_url();?>admin/setting">
								<?php echo $this->lang->line('CONFIGRATION_MENU');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo $this->config->site_url();?>admin/menu">
								<?php echo $this->lang->line('MENU_NAME');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<?php $menuid = $this->input->get("menu");?>
							<a href="<?php echo $this->config->site_url();?>admin/menulink?menu=<?php echo $menuid;?>">
								<?php echo $this->lang->line('MENU_ASSING');?>
								<i class="fa fa-angle-right"></i>
							</a>
						</li>
						<li>
							<?php echo $menuname;?>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box green ">
						<div class="portlet-title">
							<div class="caption">
								<?php echo $this->lang->line('EDIT_MENU_EIDT');?>
							</div>
						</div>
						<div class="portlet-body form">
							<form action="<?php echo $this->config->site_url();?>admin/menulink/customlinkupdate" class="form-horizontal form-bordered form-label-stripped" id="customlinkfrm" name="customlinkfrm" method="post" enctype="multipart/form-data">
								<div class="form-body">
									<div class="form-group">
										<label class="control-label col-md-3"> <?php echo $this->lang->line('TITLE_ASSIGN');?></label>
										<div class="col-md-9">
											<input type="text" id="custom_link_title" name="custom_link_title" class="form-control" value="<?php echo $menunamedata[0]['custom_link_title'];?>"/>
										</div>
									</div>
								</div>	
								<div class="form-body">
									<div class="form-group">
										<label class="control-label col-md-3"> <?php echo $this->lang->line('CUSTOM_LINK_MENU');?></label>
										<div class="col-md-9">
											<input type="text" id="custom_link" name="custom_link" value="<?php echo $menunamedata[0]['custom_link'];?>" class="form-control"/>
										</div>
									</div>
								</div>
								<div class="form-actions fluid">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-offset-3 col-md-9">
												<input type="hidden" name="menulinkids" id="menulinkids" value="<?php echo $menunamedata[0]['id'];?>">
												<input type="hidden" name="selectedmenuid" id="selectedmenuid" value="<?php echo $this->input->get("menu");?>">
												<button type="submit" class="btn green"><i class="fa fa-check"></i> <?php echo $this->lang->line('EDIT_MENU');?></button>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>