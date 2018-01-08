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
							<a href="<?php echo $this->config->site_url();?>admin/product_category">
								<?php echo $this->lang->line('CONTENT');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo $this->config->site_url();?>admin/product_category">
								<?php echo $page_head;?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<?php echo $productcatname;?>
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
					
					<form action="<?php echo $this->config->site_url();?>admin/product_category/update" class="form-horizontal form-bordered form-label-stripped" id="productcatfrm" name="productcatfrm" method="post" enctype="multipart/form-data">
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
								<label class="control-label col-md-3"> <?php echo $this->lang->line('CATEGORY_TITLE');?><span class="required"> *</span></label>
								<div class="col-md-9">
									<input type="text" id="category_name" name="category_name" value="<?php echo $formdata['category_name'];?>" class="form-control"/>
									<span class="help-block">
										 <?php echo $this->lang->line('PRO_CATEGORY_TITLE_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('H1_TITLE');?></label>
								<div class="col-md-9">
									<input type="text" id="h1_name" name="h1_name" value="<?php echo $formdata['h1_name'];?>" class="form-control"/>
									<span class="help-block">
										 <?php echo $this->lang->line('H1_TITLE_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('SLUG');?></label>
								<div class="col-md-9">
									<input type="text" id="slug" name="slug" value="<?php echo $formdata['slug'];?>" class="form-control"/>
									<span class="help-block">
										 <?php echo $this->lang->line('SLUG_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"><?php echo $this->lang->line('CATEGORY_PARENT_TITLE');?></label>
								<div class="col-md-9">
									<?php 
									$modelclass =  new Productcategorymodel();
									$parentid = $modelclass->getparentid($formdata['category_id']);
									$selected_id = $parentid[0]['parent_id'];
									?>
									<select name="parent_id" id="parent_id" class="form-control select2me">
									<option value="0"><?php echo $this->lang->line('SELECT_CATEGORY');?></option>
									<?php
									if(isset($productcatdata) && !empty($productcatdata)){
										foreach($productcatdata as $productcatdatas){ ?>
											<option <?php if($selected_id == $productcatdatas['category_id']){ echo ' selected';} ?> value="<?php echo $productcatdatas['category_id'];?>"><?php echo $productcatdatas['spacing']; ?><?php echo $productcatdatas['category_name'];?></option>
										<?php 
										}
									}?>
									</select>
									<span class="help-block"><?php echo $this->lang->line('PARENT_CATEGORY_HINT');?></span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('PRO_CAT_DESCRIPTION');?></label>
								<div class="col-md-9">
									<textarea id="category_description" name="category_description" rows="6" data-error-container="#category_description_error" class="ckeditor form-control"><?php echo $formdata['category_description'];?></textarea>
									<div id="category_description_error"></div>
									<span class="help-block">
										  <?php echo $this->lang->line('PRO_CAT_DESCRIPTION_HINT');?>
									</span>
									
								</div>
							</div>
							
							<div class="form-group">
									<label class="control-label col-md-3"> <?php echo $this->lang->line('PRO_SELECT_USERDEATLS');?></label>
									<div class="col-md-9">
										<select name="user_details_id" id="user_details_id" class="form-control select2me">
											 <option value="-1"><?php echo $this->lang->line('SELECT_USER');?></option>
											 <?php foreach($userdetailsdata as $userdetails){ ?>
												<option value="<?php echo $userdetails['id']; ?>" <?php if($userdetails['id'] == $formdata['user_details_id']) echo "selected";?>><?php echo $userdetails['user_name']; ?></option>
											 <?php  } ?>
										</select>
										<span class="help-block">
											  <?php echo $this->lang->line('PRO_SELECT_USERDEATLS_HINT');?>
										</span>
									</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('SELECT_SLIDER_TITLE');?></label>
								<div class="col-md-9">
									<select name="slider_id" id="slider_id" class="form-control select2me">
										 <option value="-1"><?php echo $this->lang->line('SELECT_SLIDER');?></option>
										 <?php foreach($bannerid as $bannerdata){ ?>
											<option value="<?php echo $bannerdata['id']; ?>" <?php if($bannerdata['id'] == $formdata['slider_id']) echo "selected";?>><?php echo $bannerdata['title']; ?></option>
										 <?php  } ?>
									</select>
									<span class="help-block">
										  <?php echo $this->lang->line('PROCAT_SLIDER_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('CATEGORY_IMAGE');?></label>
								<div class="col-md-9">
									<input type="file" name="image" id="image">
									<span>
									<?php
									if(isset($formdata["image"]) && !empty($formdata["image"]))
									{
										?>
										<a href="<?php echo $this->config->base_url().'/application/uploads/destinationimage/categoryimage/original/'.$formdata["image"]; ?>" class="group2"><?php echo $this->lang->line('VIEW_IMAGES');?></a>
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
								<label class="control-label col-md-3"> <?php echo $this->lang->line('LOGO_DESTINATION');?></label>
								<div class="col-md-9">
									<input type="file" name="logo_destination" id="logo_destination">
									<span>
									<?php
									if(isset($formdata["logo_destination"]) && !empty($formdata["logo_destination"]))
									{
										?>
										<a href="<?php echo $this->config->base_url().'/application/uploads/destinationimage/logodestination/original/'.$formdata["logo_destination"]; ?>" class="group2"><?php echo $this->lang->line('VIEW_IMAGES');?></a>
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
								<label class="control-label col-md-3"> <?php echo $this->lang->line('LOGO_HOME');?></label>
								<div class="col-md-9">
									<input type="file" name="logo_home" id="logo_home">
									<span>
									<?php
									if(isset($formdata["logo_home"]) && !empty($formdata["logo_home"]))
									{
										?>
										<a href="<?php echo $this->config->base_url().'/application/uploads/destinationimage/homelogo/original/'.$formdata["logo_home"]; ?>" class="group2"><?php echo $this->lang->line('VIEW_IMAGES');?></a>
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
							
							<?php
							$catid =$this->input->get('id');
							$getproductid = new Productcategorymodel();
							$proid = $getproductid->getcattorelproduct($catid);
							if(isset($proid) && !empty($proid))
							{
								foreach($proid as $pid)
								{
									$pids[] = $pid->product_id;
								}
								
							
								$selectedids22 = implode(',',$pids);	
								$selectedids33 = explode(',',$selectedids22);	
							}else
							{
								$selectedids33 = array();	
							}
							
							
							?>
							
							<label class="control-label col-md-3"> <?php echo $this->lang->line('COUNTDOWNLOAD_PRODUCTS');?></label>
								<div class="col-md-9">
									 <select class="form-control" style="height: 182px;" id="product" name="product[]" multiple="">
										 <?php
										 if(isset($productdata) && !empty($productdata)){
												   foreach($productdata as $products){?>
														 <option <?php if(isset($selectedids33) && !empty($selectedids33) && in_array($products["id"],$selectedids33)){ echo " selected='selected'"; }?> value="<?php echo $products['id'];?>"><?php echo $products['product_name'];?></option>
													<?php }
												}?>	
									</select>
									<span class="help-block">
										<?php echo $this->lang->line('COUNTDOWNLOAD_MUTISEL_PRO_HINT');?>
									</span>
								 </div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('USEFUL_INFO');?></label>
								<div class="col-md-9">
									<select name="info_usefull" id="info_usefull" class="form-control select2me">
											<option value=""><?php echo $this->lang->line('SELECT_DESTINATION');?></option>
											<?php
											if(isset($usefull_links) && !empty($usefull_links))
											{
												foreach($usefull_links as $usefull_li)
												{?>
													<option value="<?php echo $usefull_li['category_id']; ?>" <?php if(isset($formdata['info_usefull']) && !empty($formdata['info_usefull']) && $formdata['info_usefull'] ==  $usefull_li['category_id']){ echo ' selected="selected"'; } ?>><?php echo $usefull_li['category_name']; ?></option>
												<?php }
											}
											?>
									</select>
									<span class="help-block">
										 <?php echo $this->lang->line('PRO_CATEGORY_TITLE_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"><?php echo $this->lang->line('SEO_FEATURES');?></label>
								<div class="col-md-9">
									<div class="radio-list">
									 	 <label class="radio-inline">
											<div class="radio" id="uniform-optionsRadios25">
												<input <?php if(isset($formdata['is_seo']) && $formdata['is_seo']=='active'){ echo 'checked="checked"';}?>  type="radio" onClick="ShowSeo('Y')" checked="" value="active" id="is_seo" name="is_seo">
											</div>
											<?php echo $this->lang->line('ACTIVE');?>
										 </label>
										 <label class="radio-inline">
											<div class="radio" id="uniform-optionsRadios25">
													<input type="radio" onClick="ShowSeo('N')" <?php  if(isset($formdata['is_seo']) && $formdata['is_seo'] =='active'){echo '';}else{ echo 'checked="checked"'; }?> value="inactive" id="is_seo" name="is_seo">
											</div>
											<?php echo $this->lang->line('INACTIVE');?>
										 </label>
								    </div>
									<span class="help-block">
										  <?php echo $this->lang->line('PROCAT_SEO_HINT');?>
									</span>
								</div>
							</div>
							
							<div id="seo" style="display:<?php if(isset($formdata['is_seo']) && $formdata['is_seo'] =='active'){ echo '';}else {echo 'none';}?>;">
								<div class="form-group">
									<label class="control-label col-md-3"> <?php echo $this->lang->line('SEO_REWRITE');?></label>
									<div class="col-md-9">
										<input type="text" id="rewrite_url" name="rewrite_url" value="<?php echo $formdata['rewrite_url'];?>" class="form-control"/>
										<span class="help-block">
											 <?php echo $this->lang->line('PROCAT_SEO_REWRITE_HINT');?>
										</span>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-md-3"> <?php echo $this->lang->line('SEO_TITLE');?></label>
									<div class="col-md-9">
										<input type="text" id="meta_title" maxlength="60" name="meta_title"  class="form-control" value="<?php echo $formdata['meta_title'];?>">
									<span class="help-block">
										  <?php echo $this->lang->line('SEO_TITLE_LIMIT_HINT');?>
									</span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3"> <?php echo $this->lang->line('SEO_DESCRIPTION');?></label>
									<div class="col-md-9">
										<textarea id="meta_description" maxlength="160" name="meta_description"  class="form-control"><?php echo $formdata['meta_description'];?></textarea>
									<span class="help-block">
										  <?php echo $this->lang->line('SEO_DESCRIPTION_LIMIT_HINT');?>
									</span>
									</div>
								</div>	
								<div class="form-group">
									<label class="control-label col-md-3"> <?php echo $this->lang->line('SEO_KEYWORDS');?></label>
									<div class="col-md-9">
										<textarea id="meta_keyword" name="meta_keyword"  class="form-control"><?php echo $formdata['meta_keyword'];?></textarea>
									</div>
								</div>	
								
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"><?php echo $this->lang->line('ROBOTS');?></label>
								<div class="col-md-9">
									<div class="radio-list">
									 	 <label class="radio-inline">
											<div class="radio" id="uniform-optionsRadios25">
												<input <?php if(isset($formdata['robots']) && $formdata['robots']=='yes'){ echo 'checked="checked"';}?>  type="radio"  value="yes" id="robots" name="robots">
											</div>
											<?php echo $this->lang->line('YES');?>
										 </label>
										 <label class="radio-inline">
											<div class="radio" id="uniform-optionsRadios25">
													<input type="radio" <?php  if(isset($formdata['robots']) && $formdata['robots'] == 'no'){ echo 'checked="checked"'; }?> value="no" id="robots" name="robots">
											</div>
											<?php echo $this->lang->line('NO');?>
										 </label>
								    </div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('REL');?></label>
								<div class="col-md-9">
									<select name="rel" id="rel" class="form-control" onchange="return shocanonial_url(this.value);">
											<option value=""><?php echo $this->lang->line('SELECT_REL');?></option>
											<?php 
											if(isset($relattributes) && !empty($relattributes))
											{
												foreach($relattributes as $relattribut)
												{?>
													<option value="<?php echo $relattribut['attribute_name'];?>" <?php if(isset($formdata['rel']) && !empty($formdata['rel']) && $formdata['rel'] == $relattribut['attribute_name']){ echo ' selected="selected"';}?>><?php echo ucfirst($relattribut['attribute_name']);?></option>
												<?php }
											}?>
									</select>
								</div>
							</div>
							
							<div id="canonial_urls" class="form-group" style="display:<?php if(isset($formdata['rel']) && !empty($formdata['rel']) && $formdata['rel'] && $formdata['rel'] == 'canonical'){ echo '';}else {echo 'none';}?>;">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('CANONICAL_TARGET');?></label>
								<div class="col-md-9">
									<input type="text" id="canonical_url" name="canonical_url"  class="form-control" value="<?php echo $formdata['canonical_url'];?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('DISPLAY_ORDER');?></label>
								<div class="col-md-9">
									<select name="display_order" id="display_order" class="form-control select2me">
											<?php for($i=1;$i<=$displayorder+1;$i++) { ?>
											<option value="<?php echo $i;?>" <?php if($formdata['display_order'] == $i) echo "selected"; elseif(!$formdata['display_order'] && $displayorder+1 == $i) echo "selected";?>>
											<?php echo $i; ?>
											</option>
											<?php } ?>
									</select>
									<span class="help-block">
										  <?php echo $this->lang->line('PROCAT_DISPLAY_ORDER_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"><?php echo $this->lang->line('CMS_DISPLAY_SITEMAP');?></label>
								<div class="col-md-9">
									<div class="radio-list">
									 	 <label class="radio-inline">
											<div class="radio" id="uniform-optionsRadios25">
												<input <?php if(isset($formdata['is_display_on_sitemap']) && $formdata['is_display_on_sitemap']=='yes'){ echo 'checked="checked"';}?>  type="radio"  value="yes" id="is_display_on_sitemap" name="is_display_on_sitemap">
											</div>
											<?php echo $this->lang->line('YES');?>
										 </label>
										 <label class="radio-inline">
											<div class="radio" id="uniform-optionsRadios25">
													<input type="radio" <?php  if(isset($formdata['is_display_on_sitemap']) && $formdata['is_display_on_sitemap'] == 'no'){ echo 'checked="checked"'; }?> value="no" id="is_display_on_sitemap" name="is_display_on_sitemap">
											</div>
											<?php echo $this->lang->line('NO');?>
										 </label>
								    </div>
									<span class="help-block">
										  <?php echo $this->lang->line('CMS_DISPLAY_ORDER_HINT');?>
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
										  <?php echo $this->lang->line('PROCAT_So_STATUS_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-actions fluid">
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn green"><i class="fa fa-check"></i> Submit</button>
											<button type="button" onclick="window.location='<?php echo $this->config->site_url();?>admin/product_category'" class="btn default">Cancel</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" id="pro_cat_id" name="pro_cat_id" value="<?php echo $formdata['category_id']; ?>"/>
					</form>
					<!-- END FORM-->
				</div>
			</div>
		</div>
							
		</div>
	</div>
	<!-- END CONTENT -->
</div>
