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
							<a href="<?php echo $this->config->site_url();?>admin/blog">
								<?php echo $this->lang->line('BLOG_MAIN_MENU');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
								<a href="<?php echo $this->config->site_url();?>admin/blog">
								<?php echo $this->lang->line('BLOG_MENU');?>
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
			<div class="row">
				<form action="<?php echo $this->config->site_url();?>admin/blog/add"  id="blogfrm" name="blogfrm" method="post" enctype="multipart/form-data">
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
					  <div class="col-md-6">
						   <div class="portlet box green">
								<div class="portlet-title">
									 <div class="caption">
										<?php echo $page_head; ?>
									 </div>
								</div>
							  
								<div class="portlet-body form">
									
									<div class="form-body">
											<div class="form-group">
													<label class="control-label"><?php echo $this->lang->line('BLOG_TITLE');?><span class="required"> *</span></label>
													<input type="text" id="blog_title" name="blog_title" value="<?php echo $formdata['blog_title'];?>" class="form-control"/>
													<span class="help-block">
														 <?php echo $this->lang->line('BLOG_TITLE_HINT');?>
													</span>
											</div>
											
											<div class="form-group">
												<label class="control-label"> <?php echo $this->lang->line('SLUG');?></label>
												<input type="text" id="slug" name="slug" value="<?php echo $formdata['slug'];?>" class="form-control"/>
												<span class="help-block">
													 <?php echo $this->lang->line('SLUG_HINT');?>
												</span>
											</div>
											
											<div class="form-group">
												<label class="control-label"> <?php echo $this->lang->line('BLOG_DATE');?></label>
												<div class="input-group input-medium date date-picker" data-date="<?php echo date('Y-m-d');?>" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
													<input type="text" class="form-control" readonly="readonly" id="blog_date" name="blog_date"  value="<?php echo $formdata['blog_date'];?>" >
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>	
												<span class="help-block">
													 <?php echo $this->lang->line('BLOG_DATE_HINT');?>
												</span>
											</div>
											
										
										
											<div class="form-group">
													<label><?php echo $this->lang->line('BLOG_DESCRIPTION');?></label>
													<textarea id="blog_content" name="blog_content" rows="6" data-error-container="#content_error" class="ckeditor form-control"><?php echo $formdata['blog_content'];?></textarea>
													<div id="content_error"></div>
													<span class="help-block">
														  <?php echo $this->lang->line('BLOG_ARTICLE_DESCRIPTION_HINT');?>
													</span>
											</div>
											
											
											
											<div class="form-group">
												<label><?php echo $this->lang->line('SEO_FEATURES');?></label>
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
													  <?php echo $this->lang->line('BLOG_ARTICLE_SEO_HINT');?>
												</span>
											</div>
											
											<div id="seo" style="display:<?php if(isset($formdata['is_seo']) && $formdata['is_seo'] =='active'){ echo '';}else {echo 'none';}?>;">
												<div class="form-group">
													<label> <?php echo $this->lang->line('SEO_REWRITE');?></label>
													<input type="text" id="rewrite_url" name="rewrite_url" value="<?php echo $formdata['rewrite_url'];?>" class="form-control"/>
													<span class="help-block">
														 <?php echo $this->lang->line('BLOG_SEO_REWRITE_HINT');?>
													</span>
												</div>
												
												<div class="form-group">
													<label> <?php echo $this->lang->line('SEO_TITLE');?></label>
													<input type="text" id="meta_title" maxlength="60" name="meta_title"  class="form-control" value="<?php echo $formdata['meta_title'];?>">
													<span class="help-block">
														  <?php echo $this->lang->line('SEO_TITLE_LIMIT_HINT');?>
													</span>
												</div>
												
												
												<div class="form-group">
													<label> <?php echo $this->lang->line('SEO_DESCRIPTION');?></label>
													<textarea id="meta_description" name="meta_description"  maxlength="160"  class="form-control"><?php echo $formdata['meta_description'];?></textarea>
													<span class="help-block">
														  <?php echo $this->lang->line('SEO_DESCRIPTION_LIMIT_HINT');?>
													</span>
												</div>	

												<div class="form-group">
													<label> <?php echo $this->lang->line('SEO_KEYWORDS');?></label>
													<textarea id="meta_keyword" name="meta_keyword"  class="form-control"><?php echo $formdata['meta_keyword'];?></textarea>
												</div>	

										   </div>
										  		<div class="form-group">
											<label ><?php echo $this->lang->line('ROBOTS');?></label>
											
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
										
										<div class="form-group">
											<label> <?php echo $this->lang->line('REL');?></label>
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
										
											<div id="canonial_urls" class="form-group" style="display:<?php if(isset($formdata['rel']) && !empty($formdata['rel']) && $formdata['rel'] && $formdata['rel'] == 'canonical'){ echo '';}else {echo 'none';}?>;">
											<label > <?php echo $this->lang->line('CANONICAL_TARGET');?></label>
											
												<input type="text" id="canonical_url" name="canonical_url"  class="form-control" value="<?php echo $formdata['canonical_url'];?>">
											
										</div>
													   
										   <div class="form-group">
												<label> <?php echo $this->lang->line('DISPLAY_ORDER');?></label>
												<select name="display_order" id="display_order" class="form-control select2me ">
														<?php for($i=1;$i<=$displayorder+1;$i++) { ?>
														<option value="<?php echo $i;?>" <?php if($formdata['display_order'] == $i) echo "selected"; elseif(!$formdata['display_order'] && $displayorder+1 == $i) echo "selected";?>>
														<?php echo $i; ?>
														</option>
														<?php } ?>
												</select>
											</div>
											
											
									</div>
								</div>
							</div>
					</div>
					<div class="col-md-6">
							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-reorder"></i> <?php echo $this->lang->line('BLOG_ARTICLE_INFO');?>
									</div>
								</div>
								<div class="portlet-body form">
									 <div class="form-body">
											
											<div class="form-group">
												<label><?php echo $this->lang->line('CATEGORY_TREE');?></label>
												<div class="checkbox-list">
													<?php
													$selectedids = explode(',',$formdata['categories']);
													if(isset($blogcatdata) && !empty($blogcatdata)){
														foreach($blogcatdata as $productcat){ ?>
															<label>
																<span class="catlevelnew_<?php echo $productcat['spacing']; ?>"></span>
																<input <?php  if(isset($selectedids) && !empty($selectedids) && in_array($productcat['category_id'],$selectedids)){ echo " checked='checked'";}?> type="checkbox" id="category" name="category[]" value="<?php  echo $productcat['category_id'];?>"> <?php  echo $productcat['category_name'];?> </label>
															</label>
														<?php 
														}
													}?>
												</div>
												<span class="help-block"><?php echo $this->lang->line('BLOG_ARTICLE_CATEGORY_HINT');?></span>
											</div>
											
											<div class="form-group">
													<label> <?php echo $this->lang->line('SELECT_SLIDER_TITLE');?></label>
													<select name="slider_id" id="slider_id" class="form-control select2me">
														 <option value="-1"><?php echo $this->lang->line('SELECT_SLIDER');?></option>
														 <?php foreach($bannerid as $bannerdata){ ?>
															<option value="<?php echo $bannerdata['id']; ?>" <?php if($bannerdata['id'] == $formdata['slider_id']) echo "selected";?>><?php echo $bannerdata['title']; ?></option>
														 <?php  } ?>
													</select>
													<span class="help-block">
														  <?php echo $this->lang->line('PRO_SLIDER_HINT');?>
													</span>
										    </div>
											
											<div class="form-group">
													<label><?php echo $this->lang->line('PRO_FEATURE_IMAGE');?></label>
													<input type="file" id="featured_image" name="featured_image" value=""/>
													<span class="help-block">
														 <?php echo $this->lang->line('BLOG_ARTICLE_FEATURE_IMAGE_HINT');?>
													</span>
													<span>
														 <?php
														 if(isset($formdata['featured_image']) && !empty($formdata['featured_image'])){
														?>
																<a href="<?php echo $this->config->base_url().'/application/uploads/blog/featuredimage/original/'.$formdata["featured_image"]; ?>" class="group2"><?php echo $this->lang->line('VIEW_IMAGES');?></a>
																<?php
														}else{
															echo $this->lang->line('NO_IMAGES');
														}?>
													</span>
											</div>
											<div class="form-group">
												<label><?php echo $this->lang->line('CMS_DISPLAY_SITEMAP');?></label>
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
													  <?php echo $this->lang->line('BLOG_ARTICLE_DISPLAY_ORDER_HINT');?>
												</span>
											</div>
											
											<div class="form-group">
												<label><?php echo $this->lang->line('STATUS');?></label>
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
													  <?php echo $this->lang->line('BLOG_ARTICLE_SO_STATUS_HINT');?>
												</span>
										   </div>
																						
											<div class="form-actions fluid">
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-offset-3 col-md-9">
															<button type="submit" class="btn green"><i class="fa fa-check"></i> Submit</button>
															<button type="button" onclick="window.location='<?php echo $this->config->site_url();?>admin/blog'" class="btn default">Cancel</button>
														</div>
													</div>
												</div>
											</div>
									</div>
						
							</div>	
							</div>		 
						</div>	
						<input type="hidden" id="blog_id" name="blog_id" value="<?php echo $formdata['id']; ?>"/>
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
