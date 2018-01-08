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
					<?php echo $this->lang->line('SETTING_TITLE');?>
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
							<?php echo $this->lang->line('GENERAL_SETTING_MENU');?>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			
				<div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-reorder"></i><?php echo $this->lang->line('SETTING_TITLE');?>
										</div>
										
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form action="" id="form_sample_2" class="form-horizontal" method="post" enctype= multipart/form-data>
										
											<div class="form-body">
												<div class="alert alert-danger display-hide">
													<button class="close" data-close="alert"></button>
													<?php echo $this->lang->line('FORM_ERROR');?>
												</div>
												<?php if($success == 1): ?>
												<div class="alert alert-success">
													<button class="close" data-dismiss="alert">×</button>
													<strong><?php echo $this->lang->line('GENERAL_SUCC');?></strong>
												</div>
												<?php endif; ?>
												<?php /*<h3 class="form-section"><?php echo $this->lang->line('UPLOAD_LOGO');?></h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">First Name</label>
															<div class="col-md-9">
																<input type="text" class="form-control" placeholder="Chee Kin">
																<span class="help-block">
																	 This is inline help
																</span>
															</div>
														</div>
													</div>
												</div> */ ?>
												<h3 class="form-section"><?php echo $this->lang->line('ADDRESS');?></h3>
													<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3"><?php echo $this->lang->line('COMPANY_NAME');?><span class="required"> *</span></label>
															<div class="col-md-9">
																<div class="input-icon right">
																	<i class="fa"></i>
																	<input value="<?php echo $settingdata["company_name"] ?>" id="companyName" name="companyName" type="text" class="form-control">
																	
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3"><?php echo $this->lang->line('EMAIL_ADDRESS');?><span class="required"> *</span></label>
															<div class="col-md-9">
																<div class="input-icon right">
																	<i class="fa"></i>
																	<input value="<?php echo $settingdata["email_id"] ?>" id="emailId" name="emailId" type="text" class="form-control">
																</div>	
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3"><?php echo $this->lang->line('PHONE_NUMBER');?><span class="required"> *</span></label>
															<div class="col-md-9">
																<div class="input-icon right">
																	<i class="fa"></i>
																	<input value="<?php echo $settingdata["phone_no"] ?>" id="phoneNo" name="phoneNo" type="text" class="form-control">
																</div>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3"><?php echo $this->lang->line('FAX_NUMBER');?></label>
															<div class="col-md-9">
																<input value="<?php echo $settingdata["fax_no"] ?>" id="faxNo" name="faxNo" type="text" class="form-control">
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
									
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3"><?php echo $this->lang->line('SELECT_LANGUAGE');?></label>
															<div class="col-md-9">
																<select class="form-control" id="language_code" name="language_code">
																	<option value="english" <?php if(isset($settingdata["language_code"]) && $settingdata["language_code"] == 'english'){ echo ' selected="selected"';}?>><?php echo $this->lang->line('ENGLISH');?></option>
																	<option value="german" <?php if(isset($settingdata["language_code"]) && $settingdata["language_code"] == 'german'){ echo ' selected="selected"';}?>><?php echo $this->lang->line('GERMAN');?></option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3"><?php echo $this->lang->line('ADDRESS');?><span class="required"> *</span></label>
															<div class="col-md-9">
																<div class="input-icon right">
																<i class="fa"></i>
																<textarea  id="address" name="address" class="form-control"><?php echo $settingdata["address"] ?></textarea>
																</div>
															</div>
														</div>
													</div>
													<!--/span-->
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
<script>
var SettingValidation = function () {
	var handleValidation2 = function() {
       form2.validate({
			messages: { // custom messages for radio buttons and checkboxes
                    companyName: {
                        required: "<?php echo $this->lang->line('FIELD_REQ');?>",
						minlength: "<?php echo $this->lang->line('NAME_INVALID');?>"
                    },
                    emailId: {
                        required: "<?php echo $this->lang->line('FIELD_REQ');?>",
                        email: jQuery.format("Please enter valid email")
                    },
					phoneNo: {
                        required: "<?php echo $this->lang->line('FIELD_REQ');?>"
                    },
					 address: {
                        required: "<?php echo $this->lang->line('FIELD_REQ');?>",
                        minlength: jQuery.format("<?php echo $this->lang->line('ADDRESS_INVALID');?>")
                    }
                }
			}
    };

}();
</script>