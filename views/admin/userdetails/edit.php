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
							<a href="<?php echo $this->config->site_url();?>admin/cmspage">
								<?php echo $this->lang->line('CONTENT');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo $this->config->site_url();?>admin/product">
								<?php echo $page_head;?>
								<i class="fa fa-angle-right"></i>
							</a>
						</li>
						<li>
							<a href="<?php echo $this->config->site_url();?>admin/userdetails">
								<?php echo $this->lang->line('USERDETAILS_TITLE');?>
								<i class="fa fa-angle-right"></i>
							</a>
						</li>
						<li>
								<?php echo $userdetailspagename;?>
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
					
					<form action="<?php echo $this->config->site_url();?>admin/userdetails/update" class="form-horizontal form-bordered form-label-stripped" id="userdetailsfrm" name="userdetailsfrm" method="post" enctype="multipart/form-data">
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
						if(validation_errors()){?> 
                        <div class="alert alert-error">
                            <button class="close" data-dismiss="alert">×</button>
                            <strong><?php echo validation_errors(); ?></strong>
                        </div>
						<? } ?> 
						
						<div class="form-body">
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('USER_DETAILS_NAME');?><span class="required"> *</span></label>
								<div class="col-md-9">
									<input type="text" id="user_name" name="user_name" value="<?php echo $formdata['user_name'];?>" class="form-control"/>
									<span class="help-block">
										 <?php echo $this->lang->line('USER_DETAILS_NAME_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('USERDETAILS_POSITION');?></label>
								<div class="col-md-9">
									<textarea id="position" name="position" rows="6" class="form-control"><?php echo $formdata['position'];?></textarea>
									<div id="description_error"></div>
									<span class="help-block">
										  <?php echo $this->lang->line('USER_DETAILS_POSITION_HINT');?>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('USER_DETAILS_DESCRIPTION_DESTINATION');?></label>
								<div class="col-md-9">
									<textarea id="description_destination" name="description_destination" rows="6" data-error-container="#description_destination_error" class="ckeditor form-control"><?php echo $formdata['description_destination'];?></textarea>
									<div id="description_destination_error"></div>
									<span class="help-block">
										  <?php echo $this->lang->line('USER_DETAILS_DESCRIPTION_DESTINATION_HINT');?>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('USER_DETAILS_DESCRIPTION_PRODUCT');?></label>
								<div class="col-md-9">
									<textarea id="description_product" name="description_product" rows="6" data-error-container="#description_product_error" class="ckeditor form-control"><?php echo $formdata['description_product'];?></textarea>
									<div id="description_product_error"></div>
									<span class="help-block">
										  <?php echo $this->lang->line('USER_DETAILS_DESCRIPTION_PRODUCT_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('USER_DETAILS_CMS_DESCRIPTION_PRODUCT');?></label>
								<div class="col-md-9">
									<textarea id="cms_page_description" name="cms_page_description" rows="6" data-error-container="#cms_page_description_error" class="ckeditor form-control"><?php echo $formdata['cms_page_description'];?></textarea>
									<div id="description_product_error"></div>
									<span class="help-block">
										  <?php echo $this->lang->line('USER_DETAILS_CMS_DESCRIPTION_PRODUCT_HINT');?>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('IMAGE');?></label>
								<div class="col-md-9">
									<input type="file" name="image" id="image">
									<span>
										<?php
										if(isset($formdata["image"]) && !empty($formdata["image"]))
										{
											?>
											<a href="<?php echo $this->config->base_url().'application/uploads/userimages/original/'.$formdata["image"]; ?>" class="group2"><?php echo $this->lang->line('VIEW_IMAGES');?></a>
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
								<label class="control-label col-md-3"> <?php echo $this->lang->line('USER_DETAILS_SHOW_HOME');?></label>
								<div class="col-md-9">
									<input id="show_home" name="show_home" class="checkboxes" type="checkbox"  value="1" <?php if(isset($formdata['show_home']) && !empty($formdata['show_home'])){ echo "checked='checked'"; }?> >
									<span class="help-block">
										 <?php echo $this->lang->line('USER_DETAILS_SHOW_HOME_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"><?php echo $this->lang->line('USER_CLICKBLE');?></label>
								<div class="col-md-9">
									<div class="radio-list">
										 <label class="radio-inline">
											<div class="radio" id="uniform-optionsRadios25">
												<input <?php if(isset($formdata['userblock_clickble']) && $formdata['userblock_clickble']=='yes'){ echo 'checked="checked"';}?>  type="radio" value="yes" id="userblock_clickble" name="userblock_clickble">
											</div>
											<?php echo $this->lang->line('YES');?>
										 </label>
										 <label class="radio-inline">
											<div class="radio" id="uniform-optionsRadios25">
													<input type="radio" <?php  if(isset($formdata['userblock_clickble']) && $formdata['userblock_clickble'] == 'no'){ echo 'checked="checked"'; }?> value="no" id="userblock_clickble" name="userblock_clickble">
											</div>
											<?php echo $this->lang->line('NO');?>
										 </label>
									</div>
									<span class="help-block">
									  <?php echo $this->lang->line('USER_CLICKBLE_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('USER_LINK');?></label>
								<div class="col-md-9">
									<input type="text" id="clickble_link" name="clickble_link" value="<?php echo $formdata['clickble_link'];?>" class="form-control"/>
									<span class="help-block">
										 <?php echo $this->lang->line('USER_LINK_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('USER_DETAILS_SHOW_HOME_POSITION');?></label>
								<div class="col-md-9">
									<select id="show_home_position" name="show_home_position" class="form-control select2me">
										<option value="left" <?php if(isset($formdata['show_home_position']) && !empty($formdata['show_home_position']) && $formdata['show_home_position'] == 'left'){ echo "selected='selected'";}?>><?php echo $this->lang->line('LEFT');?></option>
										<option value="right" <?php if(isset($formdata['show_home_position']) && !empty($formdata['show_home_position']) && $formdata['show_home_position'] == 'right'){ echo "selected='selected'";}?>><?php echo $this->lang->line('RIGHT');?></option>
									</select>
									<span class="help-block">
										 <?php echo $this->lang->line('USER_DETAILS_SHOW_HOME_POSITION_HINT');?>
									</span>
								</div>
							</div>
							
							
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('USER_DETAILS_PHONENO');?></label>
								<div class="col-md-9">
									<input type="text" id="phoneno" name="phoneno" value="<?php echo $formdata['phoneno'];?>" class="form-control"/>
									<span class="help-block">
										 <?php echo $this->lang->line('USER_DETAILS_PHONENO_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('USER_DETAILS_EMAIL');?></label>
								<div class="col-md-9">
									<input type="text" id="email" name="email" value="<?php echo $formdata['email'];?>" class="form-control"/>
									<span class="help-block">
										 <?php echo $this->lang->line('USER_DETAILS_EMAIL_HINT');?>
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
										  <?php echo $this->lang->line('USER_DETAILS_STATUS_HINT');?>
									</span>
								</div>
							</div>
							
							
							<div class="form-actions fluid">
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn green"><i class="fa fa-check"></i> Submit</button>
											<button type="button" onclick="window.location='<?php echo $this->config->site_url();?>admin/userdetails'" class="btn default">Cancel</button>
										</div>
									</div>
								</div>
							</div>
						</div>	
						<input type="hidden" name="user_id" id="user_id" value="<?php echo $formdata['id'];?>">
					</form>
					<!-- END FORM-->
				</div>
			</div>
		</div>
							
		</div>
	</div>
	<!-- END CONTENT -->
</div>
