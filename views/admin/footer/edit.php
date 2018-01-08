<div class="clearfix">
</div>
	<div class="page-container">
	<?php echo $left_nav;?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					<?php echo $page_head;?>
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
								<?php echo $this->lang->line('FOOTER');?>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<div class="portlet box green">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i><?php echo $page_head;?>
					</div>
				</div>
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
					<form action="" id="profilefrm"  name="profilefrm" class="form-horizontal" method="post" enctype= "multipart/form-data">
						<div class="form-body">
							<div class="alert alert-danger display-hide">
								<button class="close" data-close="alert"></button>
								<?php echo $this->lang->line('FORM_ERROR');?>
							</div>
							<?php if($success == 1): ?>
							<div class="alert alert-success">
								<button class="close" data-dismiss="alert">×</button>
								<strong><?php echo $this->lang->line('FOOTER_SUCC');?></strong>
							</div>
							<?php endif; ?>
							<h3 class="form-section"><?php echo $this->lang->line('FOOTER_CONTENT_PART');?></h3>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
											<div class="col-md-12">
											<div class="input-icon right">
												<i class="fa"></i>
												<textarea id="footer_content" name="footer_content" rows="6" data-error-container="#content_error" class="ckeditor form-control"><?php if(isset($profiledata['footer_content']) && !empty($profiledata['footer_content'])){ echo $profiledata['footer_content'];}?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
						<div class="form-actions fluid">
							<div class="row">
								<div class="col-md-6">
									<div class="col-md-offset-3 col-md-9">
										<input type="submit" class="btn green" value="<?php echo $this->lang->line('SAVE');?>">
										<button onclick="window.location='<?php echo $this->config->site_url();?>admin/dashboard'" type="button" class="btn default"><?php echo $this->lang->line('CANCEL');?></button>
									</div>
								</div>
								<div class="col-md-6">
								</div>
							</div>
						</div>
					</form>
					<!-- END FORM-->
				</div>
			</div>
		</div>
		</div>
	</div>
	<!-- END CONTENT -->
</div>
