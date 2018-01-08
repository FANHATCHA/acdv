<div class="clearfix">
</div>
<div class="page-container">
   <?php echo $left_nav;?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="row">
				<div class="col-md-12">
					<h3 class="page-title">
					<?php echo $this->lang->line('SOCIAL_TITLE');?>
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
							<a href="<?php echo $this->config->site_url();?>admin/socialmedia">
								<?php echo $this->lang->line('SOCIAL_TITLE');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<?php echo $getsocialmedia; ?>
							
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
						 <form action="<?php echo $this->config->site_url();?>admin/socialmedia/update" class="form-horizontal form-bordered form-label-stripped" enctype="multipart/form-data" method="post" id="socialfrm" name="socialfrm"> 
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
							<? } ?> 
							<div class="form-body">
									<div class="form-group">
										<label  class="control-label col-md-3"><?php echo $this->lang->line('NAME');?><span class="required">* </span></label>
										<div class="col-md-9">
											<input type="text" class="form-control"  id="name" name="name" value="<?php echo $formdata["name"]; ?>"/>
											<span class="help-block"><?php echo $this->lang->line('So_NAME_HINT');?></span>
										</div>
									</div>
									
									<div class="form-group">
										<label  class="control-label col-md-3"><?php echo $this->lang->line('LINK_PATH');?><span class="required">* </span></label>
										<div class="col-md-9">
											<input name="url" class="form-control" type="text" value="<?php echo $formdata["url"]; ?>" id="url" />
											<span class="help-block"><?php echo $this->lang->line('So_URL_HINT');?></span>	
										</div>
									</div>
									
									<div class="form-group">
                                        <label  class="control-label col-md-3"><?php echo $this->lang->line('IMAGE');?><span class="required">* </span></label>
										<div class="col-md-9">
											<input type="file" id="socicon_img" name="socicon_img" value="<?php echo $formdata["image"]; ?>"  />
											<span class="help-block"><?php echo $this->lang->line('So_IMAGE_HINT');?></span>
											<span>
											<?php
												if(isset($formdata["image"]) && !empty($formdata["image"]))
												{
													?>
													<a href="<?php echo $this->config->base_url().'/application/uploads/socialicon/'.$formdata["image"]; ?>" class="group2"><?php echo $this->lang->line('VIEW_IMAGES');?></a>
													<?php }
												else
												{
													echo $this->lang->line('NO_IMAGES');
												}
												?>
											</span>	
										</div>
									</div>

									<div class="form-group">
                                        <label  class="control-label col-md-3"><?php echo $this->lang->line('STATUS');?></label>
										<div class="col-md-9">
											<div class="radio-list">
												<label class="radio-inline">
													<div class="radio" id="uniform-optionsRadios4">
														<input type="radio" name="eStatus" value="active" checked="checked">
													</div>
													<?php echo $this->lang->line('ACTIVE');?>
												</label>	
												<label class="radio-inline">
													<div class="radio" id="uniform-optionsRadios4">
														<input type="radio" name="eStatus" value="inactive"  <?php if(isset($formdata['status']) && $formdata['status'] =='inactive')   echo 'checked="checked"'; ?>>
													</div>
													<?php echo $this->lang->line('INACTIVE');?>
												</label>		
											</div>
											<span class="help-block"><?php echo $this->lang->line('So_STATUS_HINT');?></span>
										</div>
									</div>
									
									<div class="form-group">
                                        <label  class="control-label col-md-3"><?php echo $this->lang->line('DISPLAY_ORDER');?></label>
										<div class="col-md-9">
											<select class="form-control" name="iDisplayOrder" id="iDisplayOrder">
												<?php for($i=1;$i<=$display_order+1;$i++) { ?>
													<option value="<?=$i?>" <?php if($formdata['display_order'] == $i) echo "selected"; elseif(!$formdata['display_order'] && $display_order+1 == $i) echo "selected";?>>
													<?php echo $i;?>
													</option>
												<?php } ?>
											</select>
											<span class="help-block"><?php echo $this->lang->line('COMMAN_DISPLAYOR_HINT');?></span>
										</div>
									</div>
                                </div>
								<div class="form-actions fluid">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-offset-3 col-md-9">
												<button class="btn green" type="submit"><i class="fa fa-check"></i> Submit</button>
												<button class="btn default" onClick="window.location='<?php echo $this->config->site_url();?>admin/socialmedia';"" type="button">Cancel</button>
											</div>
										</div>
									</div>
								</div>
								<input type="hidden" name="social_id" id="social_id" value="<?php echo $formdata['id'];?>">
							</form>	
						</div>
                    </div>
               </div>
          </div>
    </div>
</div>
<script>

var SocialValidation = function () {
   var handleValidation2 = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form2 = $('#socialfrm');
            var error2 = $('.alert-danger', form2);
            var success2 = $('.alert-success', form2);

            form2.validate({
                errorElement: 'div', //default input error message container
                errorClass: 'help-block', // default input error message class
                focusInvalid: true, // do not focus the last invalid input
                ignore: "",
                rules: {
                    name: {
                        minlength: 2,
                        required: true
                    },
                    url: {
                        required: true,
						url: true
                    },
					socicon_img: {
						required: false,
						accept: "jpg|jpeg|png|gif"
					},
					
				},	
				
				messages: { 
                    name: {
                        required: "This field is required!",
						minlength: "Please enter at least 2 characters!"
                    },
                    url: {
                        required: "This field is required!",
						url: "Please enter a valid URL!"
                        
                    },
					socicon_img: {
                      accept: "Please upload valid image!"
                    }
					
                },
				
				invalidHandler: function (event, validator) { //display error alert on form submit              
                    success2.hide();
                    error2.show();
                    App.scrollTo(error2, -200);
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                 
				  /* var icon = $(element).parent('.input-icon').children('i');
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    icon.removeClass("fa-warning").addClass("fa-check");*/
					  error.insertAfter(element);
				   
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group   
                },

                unhighlight: function (element) { // revert the change done by hightlight
                     $(element)
                        .closest('.form-group').removeClass('has-error');
                },

                success: function (label, element) {
				 label
                        .closest('.form-group').removeClass('has-error'); 
                   
                },

                submitHandler: function (form) {
				form.submit();
                    success2.show();
                    error2.hide();
                }
            });


    }

    return {
        //main function to initiate the module
        init: function () {

           handleValidation2();
          
        }

    };

}();

</script>


