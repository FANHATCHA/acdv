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
							<a href="<?php echo $this->config->site_url();?>admin/setting">
								<?php echo $this->lang->line('CONFIGRATION_MENU');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->config->site_url();?>admin/redirect">
								<?php echo $page_view;?>
								<i class="fa fa-angle-right"></i>
							</a>
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
								<?php echo $page_title; ?>
							</div>
					  </div>
					  
					<div class="portlet-body form">
					
					<form action="<?php echo $this->config->site_url();?>admin/redirect/add" class="form-horizontal form-bordered form-label-stripped" id="redirectfrm" name="redirectfrm" method="post" enctype="multipart/form-data">
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
						<? } ?> 
						
						<div class="form-body">
						
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('URL_ADD_OLD');?><span class="required"> *</span></label>
								<div class="col-md-9">
									<input type="text" id="old_url" name="old_url" value="<?php echo $formdata['old_url'];?>" class="form-control"/>
									<span class="help-block">
										 <?php echo $this->lang->line('URL_PAGE_OLD_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3"> <?php echo $this->lang->line('URL_ADD_NEW');?><span class="required"> *</span></label>
								<div class="col-md-9">
									<input type="text" id="new_url" name="new_url" value="<?php echo $formdata['new_url'];?>" class="form-control"/>
									<span class="help-block">
										 <?php echo $this->lang->line('URL_PAGE_NEW_HINT');?>
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
										  <?php echo $this->lang->line('URL_SEO_HINT');?>
									</span>
								</div>
							</div>
							
							<div id="seo" style="display:<?php if(isset($formdata['is_seo']) && $formdata['is_seo'] =='active'){ echo '';}else {echo 'none';}?>;">
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
								<label class="control-label col-md-3"><?php echo $this->lang->line('URL_DISPLAY_SITEMAP');?></label>
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
										  <?php echo $this->lang->line('URL_DISPLAY_ORDER_HINT');?>
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
										  <?php echo $this->lang->line('URL_STATUS_HINT');?>
									</span>
								</div>
							</div>
							
							<div class="form-actions fluid">
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn green"><i class="fa fa-check"></i> Submit</button>
											<button type="button" onclick="window.location='<?php echo $this->config->site_url();?>admin/redirect'" class="btn default">Cancel</button>
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
