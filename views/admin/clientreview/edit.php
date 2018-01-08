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
					<?php echo $page_view;?>
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
							<a href="<?php echo $this->config->site_url();?>admin/product_category">
								<?php echo $this->lang->line('CONTENT');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo $this->config->site_url();?>admin/clientreview">
								<?php echo $this->lang->line('CLIENT_REVIEW_MAIN_MENU');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<?php echo $page_head;?>
						</li>
						
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<div class="tab-pane" id="tab_7">
				 <div class="portlet box green ">
					  <div class="portlet-title">
							<div class="caption">
								<?php echo $page_head; ?>
							</div>
					  </div>
					  
					<div class="portlet-body form">
					
					<form action="<?php echo $this->config->site_url();?>admin/clientreview/update" class="form-horizontal form-bordered form-label-stripped" id="clientreviewfrm" name="clientreviewfrm" method="post" enctype="multipart/form-data">
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
								<label class="control-label col-md-3"> <?php echo $this->lang->line('CLIENT_NAME');?><span class="required"> *</span></label>
								<div class="col-md-9">
									<input type="text" id="name" name="name" value="<?php echo $formdata['name'];?>" class="form-control"/>
									<span class="help-block">
										 <?php echo $this->lang->line('CLIENT_NAME_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('CLIENT_THEMS_NAME');?></label>
								<div class="col-md-9">
									<input type="text" id="thems_name" name="thems_name" value="<?php echo $formdata['thems_name'];?>" class="form-control"/>
									<span class="help-block">
										 <?php echo $this->lang->line('CLIENT_THEMS_NAME_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('CLIENT_REVIEW_DATE');?><span class="required"> *</span></label>
								<div class="col-md-3">
									<div class="input-group input-medium date date-picker" data-date="<?php echo date('Y-m-d');?>" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
										<input type="text" class="form-control" readonly="readonly" id="review_date" name="review_date"  value="<?php echo $formdata['review_date'];?>">
										<span class="input-group-btn">
											<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>	
									<span class="help-block">
										 <?php echo $this->lang->line('CLIENT_REVIEW_DATE_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"><?php echo $this->lang->line('CLIENT_REVIEW_CATEGORY');?><span class="required"> *</span></label>
								<div class="col-md-9">
									<?php 
									$selected_id = explode(',',$formdata['destination_id']);
									?>
									<select name="destination_id[]" id="destination_id" class="form-control"  style="height: 182px;" multiple="" >
										<option value=""><?php echo $this->lang->line('SELECT_CATEGORY');?></option>
										<?php
										if(isset($productcatdata) && !empty($productcatdata)){
											foreach($productcatdata as $productcatdatas){ ?>
											<option  <?php if(isset($selected_id) && !empty($selected_id) && in_array($productcatdatas['category_id'],$selected_id)){ echo " selected='selected'"; }?> value="<?php echo $productcatdatas['category_id'];?>"><?php echo $productcatdatas['spacing']; ?><?php echo $productcatdatas['category_name'];?></option>
											<?php 
											}
										}?>
									</select>
									<span class="help-block"><?php echo $this->lang->line('CLIENT_REVIEW_CATEGORY_HINT');?></span>
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('CLIENTREVIEW_IMAGE');?></label>
								<div class="col-md-9">
									<input type="file" name="client_review_image" id="client_review_image">
									<span>
									<?php
									if(isset($formdata["client_review_image"]) && !empty($formdata["client_review_image"]))
									{
										?>
										<a href="<?php echo $this->config->base_url().'/application/uploads/clientreview/original/'.$formdata["client_review_image"]; ?>" class="group2"><?php echo $this->lang->line('VIEW_IMAGES');?></a>
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
								<label class="control-label col-md-3"> <?php echo $this->lang->line('COMMENT_CLIENT_REVIEW');?><span class="required"> *</span></label>
								<div class="col-md-9">
									<textarea id="client_review" name="client_review" rows="6" data-error-container="#comment_error" class="ckeditor form-control"><?php echo $formdata['client_review'];?></textarea>
									<div id="category_description_error"></div>
									<span class="help-block">
										  <?php echo $this->lang->line('CLIENT_REVIEW_HINT');?>
									</span>
									
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"><?php echo $this->lang->line('CLIENT_REVIEW_CLICKBLE');?></label>
								<div class="col-md-9">
									<div class="radio-list">
										 <label class="radio-inline">
											<div class="radio" id="uniform-optionsRadios25">
												<input <?php if(isset($formdata['clientreview_clickble']) && $formdata['clientreview_clickble']== 'yes'){ echo 'checked="checked"';}?>  type="radio" value="yes" id="clientreview_clickble" name="clientreview_clickble">
											</div>
											<?php echo $this->lang->line('YES');?>
										 </label>
										 <label class="radio-inline">
											<div class="radio" id="uniform-optionsRadios25">
													<input type="radio" <?php  if(isset($formdata['clientreview_clickble']) && $formdata['clientreview_clickble'] =='no'){ echo 'checked="checked"'; }?> value="no" id="clientreview_clickble" name="clientreview_clickble">
											</div>
											<?php echo $this->lang->line('NO');?>
										 </label>
									</div>
									<span class="help-block">
									  <?php echo $this->lang->line('CLIENT_REVIEW_CLICKBLE_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('CLIENT_REVIEW_REATING');?></label>
								<div class="col-md-9">
									<select name="client_rating" id="client_rating" class="form-control select2me">
										<option value=""><?php echo $this->lang->line('SELECT_RETING');?></option>
										<?php
										for($i=1;$i<=20;$i++){ $rating = $i / 2;?>
										<option <?php if(isset($formdata['client_rating']) && !empty($formdata['client_rating']) && $formdata['client_rating'] == $rating){ echo 'selected="selected"';}?> value="<?php echo $rating; ?>"><?php echo number_format($rating, 2, '.', ''); ?></option>
										<?php }	?>
									</select>	
									<span class="help-block">
										 <?php echo $this->lang->line('CLIENT_REVIEW_REATING_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"><?php echo $this->lang->line('STATUS');?></label>
								<div class="col-md-9">
									<div class="radio-list">
									 	 <label class="radio-inline">
											<div class="radio" id="uniform-optionsRadios25">
												<input <?php if(isset($formdata['status']) && $formdata['status']== 'active'){ echo 'checked="checked"';}?>  type="radio"  value="active" id="status" name="status">
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
										  <?php echo $this->lang->line('CLIENT_REVIEW_STATUS_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-actions fluid">
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn green"><i class="fa fa-check"></i> Submit</button>
											<button type="button" onclick="window.location='<?php echo $this->config->site_url();?>admin/clientreview'" class="btn default">Cancel</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" id="id" name="id" value="<?php echo $formdata['id']; ?>"/>
					</form>
					<!-- END FORM-->
				</div>
			</div>
		</div>
							
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- DATE PICKER --->
<script src="<?php echo $this->config->site_url();?>assets/scripts/custom/components-pickers.js"></script>
<script>
	jQuery(document).ready(function() {       
	   ComponentsPickers.init();
	});   
 </script>
<!-- DATE PICKER --->
