<div class="clearfix">
<?php 
$year  = date('Y');
$month = date('m');
$day   = date('d');
?>
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
							<a href="<?php echo $this->config->site_url();?>admin/product_category">
								<?php echo $this->lang->line('CONTENT');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo $this->config->site_url();?>admin/product">
								<?php echo $this->lang->line('PRO_TITLE1');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo $this->config->site_url();?>admin/countdown">
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
								<?php echo $page_view; ?>
							</div>
					  </div>
					<div class="portlet-body form">
					<form action="<?php echo $this->config->site_url();?>admin/countdown/add" method="post" class="form-horizontal form-bordered form-label-stripped" id="countdownfrm" name="countdownfrm"  enctype="multipart/form-data">
                    	<div class="alert alert-danger display-hide">
								<button class="close" data-close="alert"></button>
								<?php echo $this->lang->line('FORM_ERROR');?>
						</div>
                        <?php
						if(validation_errors()){?> 
                        <div class="alert alert-error">
                            <button class="close" data-dismiss="alert">×</button>
                            <strong><?php echo validation_errors(); ?></strong>
                        </div>
						<? }
						?>
						<div class="form-body">
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('COUNTDOWNLOAD_TITLE');?><span class="required"> *</span></label>
								<div class="col-md-9">
									<input type="text" id="title" name="title" value="<?php echo $formdata['title'];?>" class="form-control"/>
									<span class="help-block">
										 <?php echo $this->lang->line('COUNTDOWNLOAD_TITLE_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('COUNTDOWN_DESCRIPTION');?></label>
								<div class="col-md-9">
									<textarea id="description" name="description" class="ckeditor form-control"><?php echo $formdata['description'];?></textarea>	
									<span class="help-block">
										  <?php echo $this->lang->line('COUNTDOWNLOAD_DESCRIPTION_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('PROMOTING_OFFERS_REATING');?></label>
								<div class="col-md-9">
								<select name="rating" id="rating" class="form-control select2me">
									<option value=""><?php echo $this->lang->line('SELECT_RETING');?></option>
									<?php
									for($i=1;$i<=10;$i++){ $rating = $i / 2;?>
									<option <?php if(isset($formdata['rating']) && !empty($formdata['rating']) && $formdata['rating'] == $rating){ echo 'selected="selected"';}?> value="<?php echo $rating; ?>"><?php echo number_format($rating, 2, '.', ''); ?></option>
									<?php }	?>
								</select>	
								<span class="help-block">
									 <?php echo $this->lang->line('PROMOTING_OFFERS_REATING_HINT');?>
								</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('PROMOTING_OFFERS_PRODUCT');?></label>
								<div class="col-md-9">
									<select name="product_id" id="product_id" class="form-control select2me">
										<option value=""><?php echo $this->lang->line('SELECT_PRODUCT');?></option>
										<?php
										foreach($product as $products){?>
										<option <?php if(isset($formdata['product_id']) && !empty($formdata['product_id']) && $formdata['product_id'] == $products['id']){ echo 'selected="selected"';}?> value="<?php echo $products['id']; ?>"><?php echo $products['product_name'] ?></option>
										<?php }	?>
									</select>	
									<span class="help-block">
										 <?php echo $this->lang->line('PROMOTING_OFFERS_PRODUCT_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"><?php echo $this->lang->line('PROMOTING_OFFERS_IMAGE');?></label>
								<div class="col-md-9">
								<input type="file" id="promoting_image" name="promoting_image" value=""/>
								<span class="help-block">
									 <?php echo $this->lang->line('PROMOTING_OFFERS_IMAGE_HINT');?>
								</span>
								<span>
									 <?php
									 if(isset($formdata['promoting_image']) && !empty($formdata['promoting_image'])){
									?>
										<a href="<?php echo $this->config->base_url().'/application/uploads/promoting_image/'.$formdata["promoting_image"]; ?>" class="group2"><?php echo $this->lang->line('VIEW_IMAGES');?></a>
										<?php
									}else{
										echo $this->lang->line('NO_IMAGES');
									}?>
								</span>
								</div>
							</div>
							
							<div>
								<input type="checkbox" name="promoting_offers" id="promoting_offers">
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"><?php echo $this->lang->line('PROMOTING_OFFERS');?> </label>
								<div class="col-md-8">
									<div class="checkbox-list">
										<label>
											<div id="uniform-category">
												<span><input type="checkbox" value="1" name="promoting_offers" id="promoting_offers"></span>
											</div>
										</label>
										<span class="help-block"><?php echo $this->lang->line('PROMOTING_OFFERS_HINT');?></span>
									</div>
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="control-label col-md-3"><?php echo $this->lang->line('COUNTDOWNLOAD_START_DATE');?><span class="required"> *</span></label>
								<div class="col-md-8">
									<div class="input-group date form_datetime input-large" data-date="<?php echo $year; ?>-<?php echo $month; ?>-<?php echo $day; ?>T15:25:00Z">
										<input type="text" size="16"  class="form-control" id="start_date" name="start_date">
										<span class="input-group-btn">
											<button class="btn default date-reset" type="button"><i class="fa fa-times"></i></button>
										</span>
										<span class="input-group-btn">
											<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
										</span>
										
									</div>
									<span class="help-block">
										 <?php echo $this->lang->line('COUNTDOWNLOAD_START_DATE_HINT');?>
									</span>
									<!-- /input-group -->
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"><?php echo $this->lang->line('COUNTDOWNLOAD_END_DATE');?><span class="required"> *</span></label>
								<div class="col-md-8">
									
									<div class="input-group date form_datetime input-large" data-date="<?php echo $year; ?>-<?php echo $month; ?>-<?php echo $day; ?>T15:25:00Z">
										<input type="text" size="16" class="form-control" id="end_date" name="end_date" >
										<span class="input-group-btn">
											<button class="btn default date-reset" type="button"><i class="fa fa-times"></i></button>
										</span>
										<span class="input-group-btn">
											<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
										</span>
										
									</div>
									<span class="help-block">
										 <?php echo $this->lang->line('COUNTDOWNLOAD_END_DATE_HINT');?>
										</span>
									<!-- /input-group -->
								</div>
							</div>
							
							<?php /*<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('COUNTDOWNLOAD_TYPE');?><span class="required"> *</span></label>
								<div class="col-md-9">
                                	<select id="type" name="type" class="form-control" onchange="return gettypes(this.value);">
                                    	<option value=""><?php echo $this->lang->line('COUNTDOWNLOAD_TYPE_SELECT');?></option>
                                        <option <?php if($formdata['type']=='destination') { ?> selected="selected" <?php } ?> value="destination"><?php echo $this->lang->line('COUNTDOWNLOAD_DESTINATION');?></option>
                                        <option <?php if($formdata['type']=='product') { ?> selected="selected" <?php } ?> value="product"><?php echo $this->lang->line('COUNTDOWNLOAD_PRODUCT');?></option>
                                    </select>
									<span class="help-block">
										 <?php echo $this->lang->line('COUNTDOWNLOAD_TYPE_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group" id="destination_show">
								<?php if(isset($formdata['type']) && !empty($formdata['type']) && $formdata['type'] == 'destination'){ ?>
									<label class="control-label col-md-3"><?php echo $this->lang->line('COUNTDOWNLOAD_DESTINATION');?></label>
									<div class="col-md-9">	
										 <select class="form-control" style="height: 182px;" id="procat" name="procat[]" multiple="">
										<?php
										$selectedids = explode(',',$formdata['ids']);
										
										foreach($destinationdata as $cl) {?>
											<option <?php if(isset($selectedids) && !empty($selectedids) && in_array($cl["id"],$selectedids)){ echo " selected='selected'"; }?> value="<?php echo $cl["id"] ?>"><?php echo $cl["name"]; ?></option>
										<?php } ?>
										</select>
										 <span class="help-block">
											<?php echo $this->lang->line('COUNTDOWNLOAD_MUTISEL_DESTI_HINT');?>
										</span>
									</div>
								<?php }else if(isset($formdata['type']) && !empty($formdata['type']) && $formdata['type'] == 'product'){?>
									<label class="control-label col-md-3"> <?php echo $this->lang->line('COUNTDOWNLOAD_PRODUCTS');?></label>
									<div class="col-md-9">
										 <select class="form-control" style="height: 182px;" id="product" name="product[]" multiple="">
											 <?php
											 $selectedids = explode(',',$formdata['ids']);	
											 if(isset($productdata) && !empty($productdata)){
													   foreach($productdata as $products){?>
															 <option <?php if(isset($selectedids) && !empty($selectedids) && in_array($products["id"],$selectedids)){ echo " selected='selected'"; }?> value="<?php echo $products['id'];?>"><?php echo $products['product_name'];?></option>
														<?php }
													}?>	
										</select>
										<span class="help-block">
											<?php echo $this->lang->line('COUNTDOWNLOAD_MUTISEL_PRO_HINT');?>
										 </span>
									 </div>
								<?php } ?>
							</div>*/?>
							
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
										  <?php echo $this->lang->line('COUNTDOWNLOAD_STATUS_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-actions fluid">
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn green" name="Tag_Save" value="true"><i class="fa fa-check"></i> Submit</button>
											<button type="button" onclick="window.location='<?php echo $this->config->site_url();?>admin/countdown'" class="btn default">Cancel</button>
										</div>
									</div>
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
function gettypes(opt)
{
	<?php $selectedids = explode(',',$formdata['ids']);	 ?>
	var desthtml ='';
	if(opt == 'destination')
	{
		var desthtml ='';
		desthtml = '<label class="control-label col-md-3"><?php echo $this->lang->line('COUNTDOWNLOAD_DESTINATION');?></label>';
		 desthtml += '<div class="col-md-9">';	
			 desthtml += '<select class="form-control" style="height: 182px;" id="procat" name="procat[]" multiple="">';
			<?php foreach($destinationdata as $cl) {?>
				 desthtml += '<option <?php if(isset($selectedids) && !empty($selectedids) && in_array($cl["id"],$selectedids)){ echo " selected='selected'"; }?> value="<?php echo $cl["id"] ?>"><?php echo $cl["name"]; ?></option>';
			<?php } ?>
			 desthtml += '</select>';
			 desthtml += '<span class="help-block">';
				 desthtml += '<?php echo $this->lang->line('COUNTDOWNLOAD_MUTISEL_DESTI_HINT');?>';
			 desthtml += '</span>';
		 desthtml += '</div>';
		
		var element = document.getElementById("destination_show");
		element.innerHTML = desthtml;
	}
	else if(opt == 'product')
	{
		 var desthtml ='';
		 desthtml = '<label class="control-label col-md-3"> <?php echo $this->lang->line('COUNTDOWNLOAD_PRODUCTS');?></label>';
		 desthtml += '<div class="col-md-9">';
		  desthtml += '<select class="form-control" style="height: 182px;" id="product" name="product[]" multiple="">';
			 <?php if(isset($productdata) && !empty($productdata)){
					   foreach($productdata as $products){?>
							 desthtml += '<option <?php if(isset($selectedids) && !empty($selectedids) && in_array($products["id"],$selectedids)){ echo " selected='selected'"; }?>  value="<?php echo $products['id'];?>"><?php echo $products['product_name'];?></option>';
						<?php }
					}?>	
		 desthtml += '</select>';
		 desthtml += '<span class="help-block">';
			 desthtml += '<?php echo $this->lang->line('COUNTDOWNLOAD_MUTISEL_PRO_HINT');?>';
		 desthtml += '</span>';
		 desthtml += '</div>';
		
		
		var element = document.getElementById("destination_show");
		element.innerHTML = desthtml;
	}
	else
	{
		var element = document.getElementById("destination_show");
		element.innerHTML = '';
	}
	
}
</script>
