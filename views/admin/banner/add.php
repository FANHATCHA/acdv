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
							<a href="<?php echo $this->config->site_url();?>admin/banner">
								<?php echo $this->lang->line('BANNER_TITLE');?>
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
						 <form action="<?php echo $this->config->site_url();?>admin/banner/add" class="form-horizontal form-bordered form-label-stripped" enctype="multipart/form-data" method="post" id="bannerfrm" name="bannerfrm">
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
											<input type="text" class="form-control"  id="title" name="title" value="<?php echo $formdata["title"]; ?>"/>
											<span class="help-block"><?php echo $this->lang->line('BANNER_NAME_HINT');?></span>
										</div>
									</div>
									
									<div class="form-group">
                                        <label  class="control-label col-md-3"><?php echo $this->lang->line('IMAGE');?></label>
										<div class="col-md-9">
											<?php /*?><input type="file" id="socicon_img" name="socicon_img" multiple="multiple" /><?php */?>
                                            <button id="banner_img" class="btn">Upload</button>
											<span class="help-block"><?php echo $this->lang->line('BANNER_IMAGE_HINT');?></span>
                                            <span id="status"></span>
                                            <span id="files"></span>
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
														<input type="radio" name="status" value="inactive" <?php if(isset($formdata['status']) && $formdata['status'] =='inactive') echo 'checked="checked"'; ?>>
													</div>
													<?php echo $this->lang->line('INACTIVE');?>
												</label>		
											</div>
											<span class="help-block"><?php echo $this->lang->line('BANNER_STATUS_HINT');?></span>
										</div>
									</div>
									
									<div class="form-group">
                                        <label  class="control-label col-md-3"><?php echo $this->lang->line('DISPLAY_ORDER');?></label>
										<div class="col-md-9">
											<select class="form-control" name="display_order" id="display_order">
												<?php for($i=1;$i<=$display_order+1;$i++) { ?>
													<option value="<?=$i?>" <?php if($formdata['display_order'] == $i) echo "selected"; elseif(!$formdata['display_order'] && $display_order+1 == $i) echo "selected";?>>
													<?php echo $i;?>
													</option>
												<?php } ?>
											</select>
											<span class="help-block"><?php echo $this->lang->line('DISPLAY_ORDER_HINT');?></span>
										</div>
									</div>
                                </div>
								<div class="form-actions fluid">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-offset-3 col-md-9">
												<button class="btn green" type="submit"><i class="fa fa-check"></i> Submit</button>
												<button class="btn default" onClick="window.location='<?php echo $this->config->site_url();?>admin/banner';" type="button">Cancel</button>
											</div>
										</div>
									</div>
								</div>
								<input type="hidden" name="banner_id" id="banner_id" value="<?php echo $formdata['id'];?>">
						
							</form>	
						</div>
                    </div>
               </div>
          </div>
    </div>
</div>
<div id="steps1"></div>
<script language="javascript" type="text/javascript">
jQuery(document).ready(function() { 
	var btnUpload=$('#banner_img');
	var status=$('#status');
	new AjaxUpload(btnUpload, {
	action: '<?php echo $this->config->site_url();?>admin/banner/ajaxupload/',
	name: 'uploadfile[]',
	onSubmit: function(file, ext)
	{
	if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
    status.text('Only JPG, PNG or GIF files are allowed');
	return false;
	}status.html('<img src="<?php echo $this->config->base_url();?>/assets/img/loader.gif">');
	},
	
	onComplete: function(file, response)
	{
	
		status.html('');
		status.text('');
		var responseObj = jQuery.parseJSON(response);
		if(responseObj.status=="success")
		{
			var images_data = responseObj.success_data.original;
			
			$.each(images_data,function(index, value ){
				var  imagename = "'"+value.file_name+"'";
				$('<span></span>').appendTo('#files').html('<div class="image_maindiv" id="'+value.file_name+'" style="display:block"><img src="<?php echo $this->config->base_url().'timthumb.php?src='.$this->config->base_url().'application/uploads/bannerimages/original/'; ?>'+value.file_name+'&h=100&w=100&c=1" alt=""  /><a class="image_removediv" onclick="removeimage('+imagename+')" ><span><i class="fa fa-trash-o"></i></span></a><input type="hidden" name="banner_images[]" value="'+value.file_name+'" />').addClass('success');
				//$('<span></span>').appendTo('#files').html('<div class="image_maindiv" id="'+value.file_name+'" style="display:block"><img src="<?php echo $this->config->base_url().'application/uploads/bannerimages/original/'; ?>'+value.file_name+'" alt="" height="288" width="177" /><a class="image_removediv" onclick="removeimage('+imagename+')" ><span><i class="fa fa-trash-o"></i></span></a><input type="hidden" name="banner_images[]" value="'+value.file_name+'" />').addClass('success');
			});
			
		}
		else
		{
			$('<span></span>').appendTo('#files').text(response.error_data).addClass('error');
		}
	}});
});

function removeimage(str)
{
  var status=$('#status');
  status.html('<img src="<?php echo $this->config->base_url();?>/assets/img/loader.gif">');
  if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
  else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function()
  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	  {
	  status.html('');
	  document.getElementById(str).style.display="none";
		//document.getElementById('steps1').innerHTML = xmlhttp.responseText;
	  }
  }
  var url="<?php echo $this->config->site_url();?>admin/banner/ajaxdelete";
  url=url+"?imgname="+str;
  xmlhttp.open("GET",url,true);
  xmlhttp.send();
  return false;

}
</script>
<style>
.image_maindiv img
{
	/*width:0px;*/
}
</style>
