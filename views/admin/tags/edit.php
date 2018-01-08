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
							<a href="<?php echo $this->config->site_url();?>admin/product">
								<?php echo $this->lang->line('PRO_TITLE1');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo $this->config->site_url();?>admin/tags">
								<?php echo $page_head;?>
								<i class="fa fa-angle-right"></i>
							</a>
						</li>
						<li>
								<?php echo $tagname;?>
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
					<form action="<?php echo $this->config->site_url();?>admin/tags/update" method="post" class="form-horizontal form-bordered form-label-stripped" id="seofrm" name="seofrm">
						<div class="form-body">
							
							<?php 
							if(validation_errors()) { ?>
                            <div class="alert alert-danger display-show">
								<button class="close" data-close="alert"></button>
								<?php echo $this->lang->line('FORM_ERROR');?>
                                <?php echo validation_errors(); ?>
                            </div>
							<?php } ?>
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('TAG_NAME');?><span class="required"> *</span></label>
								<div class="col-md-9">
									<input type="text" id="tag_name" name="tag_name" value="<?php echo $formdata['tag_name'];?>" class="form-control"/>
									<span class="help-block">
										 <?php echo $this->lang->line('TAG_NAME_HINT');?>
									</span>
                                    <?php echo form_error('TagName');
											echo validation_errors(); ?>
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
								<label class="control-label col-md-3"> <?php echo $this->lang->line('H1_TITLE');?></label>
								<div class="col-md-9">
									<input type="text" id="h1_title" name="h1_title" value="<?php echo $formdata['h1_title'];?>" class="form-control"/>
									<span class="help-block">
										 <?php echo $this->lang->line('H1_TITLE_HINT_TAG');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('TAG_DESCRIPTION');?><span class="required"> *</span></label>
								<div class="col-md-9">
									<textarea id="tag_description" name="tag_description" class="ckeditor form-control"><?php echo $formdata['tag_description'];?></textarea>
									<span class="help-block">
										  <?php echo $this->lang->line('TAG_DESCRIPTION_HINT');?>
									</span>
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="control-label col-md-3"><?php echo $this->lang->line('TAG_TYPE');?></label>
								<div class="col-md-9">
									<div class="radio-list">
									 	 <label class="radio-inline">
											<div class="radio" id="uniform-optionsRadios25">
												<input <?php if(isset($formdata['tag_type']) && $formdata['tag_type']=='primary'){ echo 'checked="checked"';}?>  type="radio"  value="primary" id="tag_type" name="tag_type">
											</div>
											<?php echo $this->lang->line('TAG_PRIMARY');?>
										 </label>
										 <label class="radio-inline">
											<div class="radio" id="uniform-optionsRadios25">
													<input type="radio" <?php  if(isset($formdata['tag_type']) && $formdata['tag_type'] == 'secondary'){ echo 'checked="checked"'; }?> value="secondary" id="tag_type" name="tag_type">
											</div>
											<?php echo $this->lang->line('TAG_SECONDARY');?>
										 </label>
								    </div>
									<span class="help-block">
										 <?php echo $this->lang->line('TAG_TYPE_HINT');?>
									</span>
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('SELECT_PAGE_TAG_TYPE');?></label>
								<div class="col-md-9">
                                	<select id="tag_page" name="tag_page" class="form-control select2me ">
                                    	<option value=""><?php echo $this->lang->line('SELECT_PAGE_TAG_TYPE');?></option>
                                        <option <?php if($formdata['tag_page']=='post') { ?> selected="selected" <?php } ?> value="post"><?php echo $this->lang->line('TAG_POST');?></option>
                                        <option <?php if($formdata['tag_page']=='practical_information') { ?> selected="selected" <?php } ?> value="practical_information"><?php echo $this->lang->line('TAG_PRACTICAL_INFO');?></option>
									</select>
									<span class="help-block">
										 <?php echo $this->lang->line('SELECT_PAGE_TAG_TYPE_HINT');?>
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
										  <?php echo $this->lang->line('TAG_SEO_HINT');?>
									</span>
								</div>
							</div>
							
							<div id="seo" style="display:<?php if(isset($formdata['is_seo']) && $formdata['is_seo'] =='active'){ echo '';}else {echo 'none';}?>;">
								<div class="form-group">
									<label class="control-label col-md-3"> <?php echo $this->lang->line('SEO_REWRITE');?></label>
									<div class="col-md-9">
										<input type="text" id="rewrite_url" name="rewrite_url" value="<?php echo $formdata['rewrite_url'];?>" class="form-control"/>
										<span class="help-block">
											 <?php echo $this->lang->line('TAG_REWRITE_HINT');?>
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
										  <?php echo $this->lang->line('TAG_STATUS_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-actions fluid">
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn green" name="Tag_Save" value="true"><i class="fa fa-check"></i> Submit</button>
											<button type="button" onclick="window.location='<?php echo $this->config->site_url();?>admin/tags'" class="btn default">Cancel</button>
										</div>
									</div>
								</div>
							</div>
						</div>	
                        <input type="hidden" name="TagId" id="TagId" value="<?php echo $formdata['id'];?>">
					</form>
					<!-- END FORM-->
				</div>
			</div>
		</div>
							
		</div>
	</div>
	<!-- END CONTENT -->
</div>

