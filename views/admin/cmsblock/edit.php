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
							<a href="<?php echo $this->config->site_url();?>admin/cmsblock">
								<?php echo $this->lang->line('CONTENT');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo $this->config->site_url();?>admin/cmsblock">
								<?php echo $page_head;?>
								<i class="fa fa-angle-right"></i>
							</a>
						</li>
						<li>
								<?php echo $page_view;?>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<div class="tab-pane" id="tab_7">
				 <div class="portlet box green ">
					  <div class="portlet-title">
							<div class="caption">
								<?php echo $page_title; ?>
							</div>
					  </div>
					  
					<div class="portlet-body form">
					
					<form action="<?php echo $this->config->site_url();?>admin/cmsblock/update" class="form-horizontal form-bordered form-label-stripped" id="cmsblockfrm" name="cmsblockfrm" method="post" enctype="multipart/form-data">
						<div class="alert alert-danger display-hide">
								<button class="close" data-close="alert"></button>
								<?php echo $this->lang->line('FORM_ERROR');?>
						</div>
						<?php if(isset($image_error) && !empty($image_error)){?>
								<div class="alert alert-danger">
									<button class="close" data-dismiss="alert">×</button>
									<strong><?php echo $this->lang->line('VALID_IMAGE');$this->session->unset_userdata('error_image'); ?></strong>
								</div>
						<?php }
						if(validation_errors()){?> 
                        <div class="alert alert-error">
                            <button class="close" data-dismiss="alert">×</button>
                            <strong><?php echo validation_errors(); ?></strong>
                        </div>
						<? } ?> 
						
						<div class="form-body">
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('CMS_BLOCK_PAGE_TITLE');?><span class="required"> *</span></label>
								<div class="col-md-9">
									<input type="text" id="title" name="title" value="<?php echo $formdata['title'];?>" class="form-control"/>
									<span class="help-block">
										 <?php echo $this->lang->line('CMS_BLOCK_PAGE_TITLE_HINT');?>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('CMS_BLOCK_DESCRIPTION');?><span class="required"> *</span></label>
								<div class="col-md-9">
									<textarea id="description" name="description" rows="6" data-error-container="#description_error" class="ckeditor form-control"><?php echo $formdata['description'];?></textarea>
									<div id="cms_content_error"></div>
									<span class="help-block">
										  <?php echo $this->lang->line('CMS_BLOCK_DESCRIPTION_HINT');?>
									</span>
									
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3"><?php echo $this->lang->line('STATUS');?></label>
								<div class="col-md-9">
									<div class="radio-list">
									 	 <label class="radio-inline">
											<div class="radio" id="uniform-optionsRadios25">
												<input <?php if(isset($formdata['status']) && $formdata['status']=='active'){ echo 'checked="checked"';}?>  type="radio"  value="active" id="status" name="status">
											</div>
											<?php echo $this->lang->line('ACTIVE');?>
										 </label>
										 <label class="radio-inline">
											<div class="radio" id="uniform-optionsRadios25">
													<input type="radio" <?php  if(isset($formdata['status']) && $formdata['status'] =='inactive'){ echo 'checked="checked"'; }?> value="inactive" id="status" name="status">
											</div>
											<?php echo $this->lang->line('INACTIVE');?>
										 </label>
								    </div>
									<span class="help-block">
										  <?php echo $this->lang->line('CMS_STATUS_HINT');?>
									</span>
								</div>
							</div>
							<div class="form-actions fluid">
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn green"><i class="fa fa-check"></i> Submit</button>
											<button type="button" onclick="window.location='<?php echo $this->config->site_url();?>admin/cmsblock'" class="btn default">Cancel</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" name="id" id="id" value="<?php echo $formdata['id'];?>">						
					</form>
					<!-- END FORM-->
				</div>
			</div>
		</div>
							
		</div>
	</div>
	<!-- END CONTENT -->
</div>
