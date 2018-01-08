<div class="clearfix">
</div>
<div class="page-container">
   <?php echo $left_nav;?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="row">
				<div class="col-md-12">
					<h3 class="page-title">
					<?php echo $this->lang->line('BANNER_TITLE');?>
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
							<a href="<?php echo $this->config->site_url();?>admin/slider">
								<?php echo $this->lang->line('SLIDER_TITLE');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<?php echo $page_head; ?>
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
						 <form action="<?php echo $this->config->site_url();?>admin/slider/update" class="form-horizontal form-bordered form-label-stripped" enctype="multipart/form-data" method="post" id="sliderfrm" name="sliderfrm">
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
										<label  class="control-label col-md-3"><?php echo $this->lang->line('TITLE');?><span class="required">* </span></label>
										<div class="col-md-9">
											<input type="text" class="form-control"  id="title" name="title" value="<?php echo $slider_data["title"]; ?>"/>
											<span class="help-block"><?php echo $this->lang->line('SLIDER_NAME_HINT');?></span>
										</div>
									</div>
									
									<div class="form-group">
                                        <label  class="control-label col-md-3"><?php echo $this->lang->line('STATUS');?></label>
										<div class="col-md-9">
											<div class="radio-list">
												<label class="radio-inline">
													<div class="radio" id="uniform-optionsRadios4">
														<input type="radio" name="status" value="active" checked="checked">
													</div>
													<?php echo $this->lang->line('ACTIVE');?>
												</label>	
												<label class="radio-inline">
													<div class="radio" id="uniform-optionsRadios4">
														<input type="radio" name="status" value="inactive" <?php if(isset($slider_data['status']) && $slider_data['status'] =='inactive') echo 'checked="checked"'; ?>>
													</div>
													<?php echo $this->lang->line('INACTIVE');?>
												</label>		
											</div>
											<span class="help-block"><?php echo $this->lang->line('SLIDER_STATUS_HINT');?></span>
										</div>
									</div>
									
									<?php if(isset($formdata) && !empty($formdata)){
									foreach($formdata as $formd){ ?>
									<div class="form-group">
										<label  class="control-label col-md-3"><?php echo $this->lang->line('SLIDER_DETAILS');?><span class="required">* </span></label>
										<div class="col-md-5">									
											<label> <?php echo $this->lang->line('SLIDER_TITLE_FRM');?></label>
											<input type="text" class="form-control"  id="slider_title" name="slider_title[]" value="<?php echo $formd["slider_title"]; ?>"/>
											<span class="help-block"></span>
											<label> <?php echo $this->lang->line('SLIDER_IMAGE');?></label>
											<input type="file" class="form-control2"  id="image" name="image[]" value=""/>
											<input type="hidden" name="imagehidden[]" id="imagehidden" value="<?php echo $formd["image"]; ?>" />
											<span>
											<?php
												if(isset($formd["image"]) && !empty($formd["image"]))
												{
													?>
													<a href="<?php echo $this->config->base_url().'/application/uploads/sliderimages/'.$formd["image"]; ?>" class="group2"><?php echo $this->lang->line('VIEW_IMAGES');?></a>
													<?php }
												else
												{
													echo $this->lang->line('NO_IMAGES');
												}
												?>
											</span>	
											<span class="help-block"></span>
											<label> <?php echo $this->lang->line('SLIDER_DESCRIPTION');?></label>
											<textarea id="description" name="description[]" rows="6" data-error-container="#description_error" class="form-control"><?php echo $formd['description'];?></textarea>
											<span class="help-block"></span>
									   </div>
									   <div class="col-md-4">	
											<label> <?php echo $this->lang->line('SLIDER_SHORT_DESCRIPTION');?></label>
											<textarea id="short_description" name="short_description[]" rows="6" class="form-control"><?php echo $formd['short_description'];?></textarea>
											<span class="help-block"></span>
											<label> <?php echo $this->lang->line('SLIDER_SOCIAL_FB');?></label>
											<input type="text" class="form-control"  id="social_fb" name="social_fb[]" value="<?php echo $formd["social_fb"]; ?>"/>
											<span class="help-block"></span>
											<label> <?php echo $this->lang->line('SLIDER_SOCIAL_TW');?></label>
											<input type="text" class="form-control"  id="social_tw" name="social_tw[]" value="<?php echo $formd["social_tw"]; ?>"/>
											<span class="help-block"></span>
											<label> <?php echo $this->lang->line('SLIDER_SOCIAL_G');?></label>
											<input type="text" class="form-control"  id="social_g" name="social_g[]" value="<?php echo $formd["social_g"]; ?>"/>
											<span class="help-block"></span>
											<label> <?php echo $this->lang->line('SLIDER_SOCIAL_RSS');?></label>
											<input type="text" class="form-control"  id="social_rss" name="social_rss[]" value="<?php echo $formd["social_rss"]; ?>"/>
											<span class="help-block"></span>
											<label> <?php echo $this->lang->line('SLIDER_URL');?></label>
											<input type="text" class="form-control"  id="url" name="url[]" value="<?php echo $formd["url"]; ?>"/>
											<span class="help-block"></span>
										</div>
									</div>
									<input type="button" onClick="window.location='<?php echo $this->config->site_url();?>admin/slider/removeslider?id=<?php echo $formd["slider_content_id"]; ?>&slider=<?php echo $slider_data['slider_id'];?>';" id="remove_more" class="btn green" value="Remove"/>
								
									<?php } }else{ ?>
									<div class="form-group">
										<label  class="control-label col-md-3"><?php echo $this->lang->line('SLIDER_DETAILS');?><span class="required">* </span></label>
										<div class="col-md-5">									
											<label> <?php echo $this->lang->line('SLIDER_TITLE_FRM');?></label>
											<input type="text" class="form-control"  id="slider_title" name="slider_title[]" value=""/>
											<span class="help-block"></span>
											<label> <?php echo $this->lang->line('SLIDER_IMAGE');?></label>
											<input type="file" class="form-control2"  id="image" name="image[]" value=""/>
											<span class="help-block"></span>
											<label> <?php echo $this->lang->line('SLIDER_DESCRIPTION');?></label>
											<textarea id="description" name="description[]" rows="6" data-error-container="#description_error" class="ckeditor form-control"></textarea>
											<span class="help-block"></span>
									   </div>
									   <div class="col-md-4">	
											<label> <?php echo $this->lang->line('SLIDER_SHORT_DESCRIPTION');?></label>
											<textarea id="short_description" name="short_description[]" rows="6" class="form-control"></textarea>
											<span class="help-block"></span>
											<label> <?php echo $this->lang->line('SLIDER_SOCIAL_FB');?></label>
											<input type="text" class="form-control"  id="social_fb" name="social_fb[]" value=""/>
											<span class="help-block"></span>
											<label> <?php echo $this->lang->line('SLIDER_SOCIAL_TW');?></label>
											<input type="text" class="form-control"  id="social_tw" name="social_tw[]" value=""/>
											<span class="help-block"></span>
											<label> <?php echo $this->lang->line('SLIDER_SOCIAL_G');?></label>
											<input type="text" class="form-control"  id="social_g" name="social_g[]" value=""/>
											<span class="help-block"></span>
											<label> <?php echo $this->lang->line('SLIDER_SOCIAL_RSS');?></label>
											<input type="text" class="form-control"  id="social_rss" name="social_rss[]" value=""/>
											<span class="help-block"></span>
											<label> <?php echo $this->lang->line('SLIDER_URL');?></label>
											<input type="text" class="form-control"  id="url" name="url[]" value=""/>
											<span class="help-block"></span>
										</div>
									</div>
									<?php } ?>
									
									<input type="button" id="add_more" class="btn green" value="Add More Files"/>
								</div>
								
								<div class="form-actions fluid">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-offset-3 col-md-9">
												<button class="btn green" type="submit"><i class="fa fa-check"></i> Submit</button>
												<button class="btn default" onClick="window.location='<?php echo $this->config->site_url();?>admin/slider';" type="button">Cancel</button>
											</div>
										</div>
									</div>
								</div>
								<input type="hidden" name="slider_id" id="slider_id" value="<?php echo $slider_data['slider_id'];?>">
								<input type="hidden" id="maxlength" name="maxlength" value="1"/>
							</form>	
						</div>
                    </div>
               </div>
          </div>
    </div>
</div>

<script>
var abc = 0; //Declaring and defining global increement variable
$(document).ready(function() {
	var contenor = '';
	 contenor += '<div class="form-group">';
	 contenor += '<label class="control-label col-md-3"><?php echo $this->lang->line("SLIDER_DETAILS");?><span class="required">*</span></label>';
	 contenor += '<div class="col-md-5"><label> <?php echo $this->lang->line("SLIDER_TITLE_FRM");?></label>';
	 contenor += '<input type="text" class="form-control"  id="slider_title" name="slider_title[]" value=""/>';
	 contenor += ' <span class="help-block"></span><label> <?php echo $this->lang->line("SLIDER_IMAGE");?></label><input type="file" class="form-control2"  id="image" name="image[]" value=""/>';
	 contenor += ' <span class="help-block"></span><label> <?php echo $this->lang->line("SLIDER_DESCRIPTION");?></label>';
	 contenor += ' <textarea id="description" name="description[]" rows="6" data-error-container="#description_error" class="form-control">';
	 contenor += '</textarea>';
	 contenor += ' <span class="help-block"></span></div>';
	 contenor += '<div class="col-md-4">';	
	 contenor += '<label> <?php echo $this->lang->line("SLIDER_SHORT_DESCRIPTION");?></label>';
	 contenor += '<textarea id="short_description" name="short_description[]" rows="6" class="form-control"></textarea>';
	 contenor += '<span class="help-block"></span>';
	 contenor += '<label> <?php echo $this->lang->line("SLIDER_SOCIAL_FB");?></label>';
	 contenor += '<input type="text" class="form-control"  id="social_fb" name="social_fb[]" value=""/>';
	 contenor += '<span class="help-block"></span>';
	 contenor += '<label> <?php echo $this->lang->line("SLIDER_SOCIAL_TW");?></label>';
	 contenor += '<input type="text" class="form-control"  id="social_tw" name="social_tw[]" value=""/>';
	 contenor += '<span class="help-block"></span>';
	 contenor += '<label> <?php echo $this->lang->line("SLIDER_SOCIAL_G");?></label>';
	 contenor += '<input type="text" class="form-control"  id="social_g" name="social_g[]" value=""/>';
	 contenor += '<span class="help-block"></span>';
	 contenor += '<label> <?php echo $this->lang->line("SLIDER_SOCIAL_RSS");?></label>';
	 contenor += '<input type="text" class="form-control"  id="social_rss" name="social_rss[]" value=""/>';
	 contenor += '<span class="help-block"></span>';
	 contenor += '<label> <?php echo $this->lang->line("SLIDER_URL");?></label>';
	 contenor += '<input type="text" class="form-control"  id="url" name="url[]" value=""/>';
	 contenor += '<span class="help-block"></span>';
	 contenor += '</div>';
	 contenor += '</div>';

    $('#add_more').click(function() {
        $(this).before($("<div/>", {id: 'form-group12'}).fadeIn('slow').append(
                contenor
				
                ));
				
		$("#maxlength").val(parseInt($("#maxlength").val()) + 1);		
				
    });
$('body').on('change', '#file', function(){
            if (this.files && this.files[0]) {
                 abc += 1; //increementing global variable by 1
				
				var z = abc - 1;
                var x = $(this).parent().find('#previewimg' + z).remove();
                $(this).before("<div id='abcd"+ abc +"' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");
               
			    var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
               
			    $(this).hide();
                $("#abcd"+ abc).append($("<img/>", {id: 'img', src: 'x.png', alt: 'delete'}).click(function() {
                $(this).parent().parent().remove();
                }));
            }
        });

//To preview image     
    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    };

    $('#upload').click(function(e) {
        var name = $(":file").val();
        if (!name)
        {
            alert("First Image Must Be Selected");
            e.preventDefault();
        }
    });
});
</script>
