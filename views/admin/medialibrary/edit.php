<div class="clearfix">
</div>
<div class="page-container">
   <?php echo $left_nav;?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="row">
				<div class="col-md-12">
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
							<a href="<?php echo $this->config->site_url();?>admin/medialibrary">
								<?php echo $this->lang->line('MEDIA_LIBRAY');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo $this->config->site_url();?>admin/medialibrary">
								<?php echo $this->lang->line('MANAGE_FILES');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<?php echo $getmedianame;?>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>	
			<div class="tab-pane" id="tab_7">
				 <div class="portlet box green ">
					  <div class="portlet-title">
							<div class="caption">
								<?php echo $page_view; ?>
							</div>
					  </div>
					  
					  <div class="portlet-body form">
						  <form action="<?php echo $this->config->site_url();?>admin/medialibrary/update" class="form-horizontal" enctype="multipart/form-data" method="post" id="mediafrm" name="mediafrm">
								<?php
									$image_error = $this->session->userdata('error_image');
								?>
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
								if(validation_errors()!=''){?> 
									<div class="alert alert-error">
										<button class="close" data-dismiss="alert">×</button>
										<strong><?php echo validation_errors(); ?></strong>
									</div>
								<? }

									?> 
								
								<div class="form-body">
									<div class="row tabbable tabbable-custom boxless">
										<div class="col-md-6">
											<div class="form-group">
												<div id="preview-pane">
													<?php 
													$image_title = explode('.',$formdata['original_title']);
													if(isset($image_title[1]) && !empty($image_title[1]) && $image_title[1] == 'pdf'){ ?>
														<img  width="200px" src="<?php echo base_url().'application/uploads/PDF.png'; ?>" alt="<?php if(isset($formdata['alternate_text']) && !empty($formdata['alternate_text'])){ echo $formdata['alternate_text'];}?>">
													<?php }else{?>
														<img  src="<?php echo base_url().'application/uploads/images/thumb200/'.$formdata['original_title']; ?>" alt="<?php if(isset($formdata['alternate_text']) && !empty($formdata['alternate_text'])){ echo $formdata['alternate_text'];}?>">
													<?php } ?>
												 </div>
											</div>
											
										</div>
										<div class="col-md-9">
												<div class="form-group">
													<label class="control-label col-md-3"><?php echo $this->lang->line('MEDIA_TITLE');?></label>
													<div class="col-md-9">
														<div class="input-icon right">
															<i class="fa"></i>
															<input value="<?php if(isset($formdata["title"]) && !empty($formdata["title"])){ echo $formdata["title"]; }?>" id="title" name="title" type="text" class="form-control">
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-9">
												<div class="form-group">
													<label class="control-label col-md-3"><?php echo $this->lang->line('MEDIA_ALT_TEXT');?></label>
													<div class="col-md-9">
														<div class="input-icon right">
															<i class="fa"></i>
															<input value="<?php if(isset($formdata["alternate_text"]) && !empty($formdata["alternate_text"])){ echo $formdata["alternate_text"]; }?>" id="alternate_text" name="alternate_text" type="text" class="form-control">
														</div>	
													</div>
												</div>
											</div>
											 <div class="col-md-9">
												<div class="form-group">
													<label class="control-label col-md-3"><?php echo $this->lang->line('MEDIA_ALT_CAPTION');?></label>
													<div class="col-md-9">
														<div class="input-icon right">
															<i class="fa"></i>
															<input value="<?php if(isset($formdata["caption"]) && !empty($formdata["caption"])){ echo $formdata["caption"]; }?>" id="caption" name="caption" type="text" class="form-control">
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-9">
												<div class="form-group">
													<label class="control-label col-md-3"><?php echo $this->lang->line('MEDIA_ALT_DESCRIPTION');?></label>
													<div class="col-md-9">
														<div class="input-icon right">
															<i class="fa"></i>
															<textarea id="description" class="form-control" name="description"><?php if(isset($formdata["description"]) && !empty($formdata["description"])){ echo $formdata["description"]; }?></textarea>
														</div>	
													</div>
												</div>
											</div>
											 <div class="col-md-9">
												<div class="form-group">
													<label class="control-label col-md-3"><?php echo $this->lang->line('MEDIA_ALT_FILE_URL');?></label>
													<div class="col-md-9">
														<div class="input-icon right">
															<i class="fa"></i>
															<input readonly="readonly" value="<?php echo base_url().'application/uploads/images/original/'.$formdata['original_title']; ?>" id="file_url" name="file_url" type="text" class="form-control">
														</div>
													</div>
												</div>
										  </div>
									 </div>
									 <div class="row">
										  
									</div>
									<div class="row">
										 
									</div>
									<div class="row">

										 
									</div>
								</div>
								<div class="form-actions fluid">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-offset-3 col-md-9">
												<button class="btn green" type="submit"><i class="fa fa-check"></i> Submit</button>
												<button class="btn default" onClick="window.location='<?php echo $this->config->site_url();?>admin/medialibrary';" type="button">Cancel</button>
											</div>
										</div>
									</div>
								</div>
								<input type="hidden" name="media_id" id="media_id" value="<?php echo $formdata['id'];?>">
							</form>	
						</div>
                    </div>
               </div>
          </div>
    </div>
</div>
