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
							<a href="<?php echo $this->config->site_url();?>admin/product">
								<?php echo $this->lang->line('PRODUCT_MENU');?>
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
				<form action="<?php echo $this->config->site_url();?>admin/product/add"  id="productfrm" name="productfrm" method="post" enctype="multipart/form-data">
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
													<label  class="control-label"><?php echo $this->lang->line('PRODUCT_TITLE');?><span class="required"> *</span></label>
													<input type="text" id="product_name" name="product_name" value="<?php echo $formdata['product_name'];?>" class="form-control"/>
													<span class="help-block">
														 <?php echo $this->lang->line('PRO_TITLE_HINT');?>
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
												<label><?php echo $this->lang->line('PRO_SUBTITLE');?></label>
												<input type="text" id="subtitle" name="subtitle" value="<?php echo $formdata['subtitle'];?>" class="form-control"/>
												<span class="help-block">
													 <?php echo $this->lang->line('PRO_SUBTITLE_HINT');?>
												</span>
											</div>
											
											<div class="form-group">
												<label> <?php echo $this->lang->line('THREE_SHORT_POINT');?></label>
												<textarea id="short_point" name="short_point" rows="6" data-error-container="#short_point_error" class="ckeditor form-control"><?php echo $formdata['short_point'];?></textarea>
												<div id="short_point_error"></div>
											</div>
											
											<div class="form-group">
												<label> <?php echo $this->lang->line('SHORT_DESC');?></label>
												<textarea id="short_description" name="short_description" class="form-control"><?php echo $formdata['short_description'];?></textarea>
											</div>
										
											<div class="form-group">
													<label class="control-label"><?php echo $this->lang->line('PRO_DESCRIPTION');?></label>
													<textarea id="content" name="content" rows="6" data-error-container="#content_error" class="ckeditor form-control"><?php echo $formdata['content'];?></textarea>
													<div id="content_error"></div>
													<span class="help-block">
														  <?php echo $this->lang->line('PRO_DESCRIPTION_HINT');?>
													</span>
											</div>
											
											<div class="form-group">
													<label> <?php echo $this->lang->line('PRO_PRESENTATION');?></label>
													<textarea id="presentation" name="presentation" rows="6" data-error-container="#cpresentation_error" class="ckeditor form-control"><?php echo $formdata['presentation'];?></textarea>
													<div id="cpresentation_error"></div>
											</div>
											
											
											
											<div class="form-group">
												<label> <?php echo $this->lang->line('PRO_ROUTE');?></label>
												<textarea id="route" name="route" rows="6" data-error-container="#route_error" class="ckeditor form-control"><?php echo $formdata['route'];?></textarea>
												<div id="route_error"></div>
											</div>
											
											<div class="form-group">
												<label> <?php echo $this->lang->line('PRO_HOTEL_DESC');?></label>
												<textarea id="hotel" name="hotel" rows="6" data-error-container="#hotel_error" class="ckeditor form-control"><?php echo $formdata['hotel'];?></textarea>
												<div id="content_error"></div>
											</div>
											
											<div class="form-group">
												<label> <?php echo $this->lang->line('PRO_BUDGET');?></label>
												<textarea id="budget" name="budget" rows="6" data-error-container="#budget_error" class="ckeditor form-control"><?php echo $formdata['budget'];?></textarea>
												<div id="budget_error"></div>
											</div>
											
											<div class="form-group">
												<label> <?php echo $this->lang->line('PRO_SPECIALOFF');?></label>
												<textarea id="special_offers" name="special_offers" rows="6" data-error-container="#special_offers_error" class="ckeditor form-control"><?php echo $formdata['special_offers'];?></textarea>
												<div id="special_offers_error"></div>
											</div>
											
											<div class="form-group">
												<label> <?php echo $this->lang->line('PRO_REVIEW');?></label>
												<textarea id="reviews" name="reviews" rows="6" data-error-container="#reviews_error" class="ckeditor form-control"><?php echo $formdata['reviews'];?></textarea>
												<div id="reviews_error"></div>
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
													  <?php echo $this->lang->line('PRO_SEO_HINT');?>
												</span>
											</div>
											
											<div id="seo" style="display:<?php if(isset($formdata['is_seo']) && $formdata['is_seo'] =='active'){ echo '';}else {echo 'none';}?>;">
												<div class="form-group">
													<label> <?php echo $this->lang->line('SEO_REWRITE');?></label>
													<input type="text" id="rewrite_url" name="rewrite_url" value="<?php echo $formdata['rewrite_url'];?>" class="form-control"/>
													<span class="help-block">
														 <?php echo $this->lang->line('PRO_SEO_REWRITE_HINT');?>
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
												<label><?php echo $this->lang->line('ROBOTS');?></label>
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
												<label><?php echo $this->lang->line('CANONICAL_TARGET');?></label>
												<input type="text" id="canonical_url" name="canonical_url"  class="form-control" value="<?php echo $formdata['canonical_url'];?>">
											</div>

										   
										   <div class="form-group">
												<label> <?php echo $this->lang->line('DISPLAY_ORDER');?></label>
												<select name="display_order" id="display_order" class="form-control select2me">
														<?php for($i=1;$i<=$displayorder+1;$i++) { ?>
														<option value="<?php echo $i;?>" <?php if($formdata['display_order'] == $i) echo "selected"; elseif(!$formdata['display_order'] && $displayorder+1 == $i) echo "selected";?>>
														<?php echo $i; ?>
														</option>
														<?php } ?>
												</select>
												<span class="help-block">
													  <?php echo $this->lang->line('PRO_DISPLAY_ORDER_HINT');?>
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
													  <?php echo $this->lang->line('PRO_DISPLAY_ORDER_HINT');?>
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
													  <?php echo $this->lang->line('PRO_SO_STATUS_HINT');?>
												</span>
										   </div>
									</div>
								</div>
							</div>
					</div>
					<div class="col-md-6">
							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-reorder"></i> <?php echo $this->lang->line('INFO_PRODUCT');?>
									</div>
								</div>
								<div class="portlet-body form">
									 <div class="form-body">
									 		
											<div class="form-group">
												<label><?php echo $this->lang->line('PRO_TAGS_PRIMARY');?></label>
												<input type="hidden" class="form-control select2_sample3" value="" id="primary" name="primary">
												<span class="help-block"><?php echo $this->lang->line('PRO_TAGS_HINT');?></span>
											</div>
											<div class="form-group">
												<label><?php echo $this->lang->line('PRO_TAGS_SECOUNDRAY');?></label>
												<input type="hidden" class="form-control select2s_sample3" value="" id="secondary" name="secondary">
												<span class="help-block"><?php echo $this->lang->line('PRO_TAGS_HINT');?></span>
											</div>
											
											
											<div class="form-group">
												<label><?php echo $this->lang->line('PRO_CATEGORY_TRAL');?></label>
												<div class="checkbox-list">
													<?php
													$productcatrelid = new Productmodel();
													$selectcatid = $productcatrelid->getproductcatrelid($this->input->get("id"));
													
													if(isset($selectcatid) && !empty($selectcatid))
													{
														foreach($selectcatid as $selectcati)
														{
															$selectcati11[] = $selectcati->cat_id;
														}
														$selectcati1 = implode(',',$selectcati11);
														$selectedids = explode(',',$selectcati1);
													}else{
													
														$selectedids = array();
													}
													
													if(isset($productcatdata) && !empty($productcatdata)){
														foreach($productcatdata as $productcatdatas){ ?>
															<label>
																<span class="catlevelnew_<?php echo $productcatdatas['spacing']; ?>"></span>
																<input <?php  if(isset($selectedids) && !empty($selectedids) && in_array($productcatdatas['category_id'],$selectedids)){ echo " checked='checked'";}?> type="checkbox" id="category" name="category[]" value="<?php  echo $productcatdatas['category_id'];?>"> <?php  echo $productcatdatas['category_name'];?> </label>
															</label>
														<?php 
														}
													}?>
												</div>
												<span class="help-block"><?php echo $this->lang->line('PRO_CATEGORY_TRAL_HINT');?></span>
											</div>
											
											<div class="form-group">
													<label><?php echo $this->lang->line('PRO_PRICE');?></label>
													<input type="text" id="price" name="price" value="<?php echo $formdata['price'];?>" class="form-control"/>
													<span class="help-block">
														 <?php echo $this->lang->line('PRO_PRICE_HINT');?>
													</span>
											</div>
											<div class="form-group">
													<label><?php echo $this->lang->line('NUMBER_OF_NIGHT');?></label>
													<input type="text" id="number_of_nights" name="number_of_nights" value="<?php echo $formdata['number_of_nights'];?>" class="form-control"/>
													<span class="help-block">
														 <?php echo $this->lang->line('PRO_NUMBER_OF_NIGHT_HINT');?>
													</span>
											</div>
											<div class="form-group">
													<label><?php echo $this->lang->line('PRO_TYPE');?></label>
													<select name="type" id="type" class="form-control select2me">
														<option value="Circuit"><?php echo $this->lang->line('PRO_TYPE_CIRCUIT');?></option>
														<option value="Stay"><?php echo $this->lang->line('PRO_TYPE_STAY');?></option>
														<option value="Combined"><?php echo $this->lang->line('PRO_TYPE_COMBINED');?></option>
													</select>
													<span class="help-block">
														 <?php echo $this->lang->line('PRO_TYPE_HINT');?>
													</span>
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
													<label><?php echo $this->lang->line('PRO_LINK_TRA_NOTBOOK');?></label>
													<input type="link_travel_notebook" id="link_travel_notebook" name="link_travel_notebook" value="<?php echo $formdata['link_travel_notebook'];?>" class="form-control"/>
													<span class="help-block">
														 <?php echo $this->lang->line('PRO_LINK_TRA_NOTBOOK_HINT');?>
													</span>
											</div>
											
											<div class="form-group">
													<label><?php echo $this->lang->line('PRO_MAP_LINK');?></label>
													<input type="text" id="map_link" name="map_link" value="<?php echo $formdata['map_link'];?>" class="form-control"/>
													<span class="help-block">
														 <?php echo $this->lang->line('PRO_MAP_LINK_HINT');?>
													</span>
											</div>
											
											<div class="form-group">
												<label><?php echo $this->lang->line('PRO_SID_TITLE');?></label>
												<input type="text" id="image_title_sidebar" name="image_title_sidebar" value="<?php echo $formdata['image_title_sidebar'];?>" class="form-control"/>
												<span class="help-block">
													 <?php echo $this->lang->line('PRO_SID_TITLE_HINT');?>
												</span>
											</div>
											
											<div class="form-group">
													<label><?php echo $this->lang->line('PRO_SID_UP_UPLOAD');?></label>
													<input type="file" id="image_link_sidebar" name="image_link_sidebar" value=""/>
													<span class="help-block">
														 <?php echo $this->lang->line('PRO_SID_UP_UPLOAD_HINT');?>
													</span>
													<span>
														 <?php
														 if(isset($formdata['image_link_sidebar']) && !empty($formdata['image_link_sidebar'])){
														?>
															<a href="<?php echo $this->config->base_url().'/application/uploads/product/sidebarimage/'.$formdata["image_link_sidebar"]; ?>" class="group2"><?php echo $this->lang->line('VIEW_IMAGES');?></a>
															<?php
														}else{
															echo $this->lang->line('NO_IMAGES');
														}?>
													</span>
											</div>
											
											<div class="form-group">
													<label><?php echo $this->lang->line('PRO_FEATURE_IMAGE');?></label>
													<input type="file" id="featured_image" name="featured_image" value=""/>
													<span class="help-block">
														 <?php echo $this->lang->line('PRO_FEATURE_IMAGE_HINT');?>
													</span>
													<span>
														 <?php
														 if(isset($formdata['featured_image']) && !empty($formdata['featured_image'])){
														?>
															<a href="<?php echo $this->config->base_url().'/application/uploads/product/featuredimage/'.$formdata["featured_image"]; ?>" class="group2"><?php echo $this->lang->line('VIEW_IMAGES');?></a>
															<?php
														}else{
															echo $this->lang->line('NO_IMAGES');
														}?>
													</span>
											</div>
																					
											<div class="form-group">
													<label><?php echo $this->lang->line('PRO_YOU_APPRE');?></label>
													<textarea id="you_will_appreciate" name="you_will_appreciate" rows="6" data-error-container="#you_will_appreciate_error" class="ckeditor form-control"><?php echo $formdata['you_will_appreciate'];?></textarea>
													<div id="you_will_appreciate_error"></div>
													<span class="help-block">
														  <?php echo $this->lang->line('PRO_YOU_APPRE_HINT');?>
													</span>
											</div>
											
											<div class="form-group">
													<label><?php echo $this->lang->line('PRO_AUT_EXP');?></label>
													<textarea id="authentic_experience" name="authentic_experience" rows="6" data-error-container="#authentic_experience_error" class="ckeditor form-control"><?php echo $formdata['authentic_experience'];?></textarea>
													<div id="authentic_experience_error"></div>
													<span class="help-block">
														  <?php echo $this->lang->line('PRO_AUT_EXP_HINT');?>
													</span>
											</div>
											
											<div class="form-group">
													<label><?php echo $this->lang->line('PRO_OPT_GOLF');?></label>
													<textarea id="golf" name="golf" rows="6" data-error-container="#golf_error" class="ckeditor form-control"><?php echo $formdata['golf'];?></textarea>
													<div id="content_error"></div>
													<span class="help-block">
														  <?php echo $this->lang->line('PRO_OPT_GOLF_HINT');?>
													</span>
											</div>
																						
											<div class="form-actions fluid">
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-offset-3 col-md-9">
															<button type="submit" class="btn green"><i class="fa fa-check"></i> Submit</button>
															<button type="button" onclick="window.location='<?php echo $this->config->site_url();?>admin/product'" class="btn default">Cancel</button>
														</div>
													</div>
												</div>
											</div>
									</div>
						
							</div>	
							</div>		 
						</div>	
							
						<input type="hidden" id="pro_id" name="pro_id" value="<?php echo $formdata['id']; ?>"/>
					</form>
					<!-- END FORM-->
				</div>
			</div>
		</div>
							
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<?php
foreach($tagsprimarydata as $tags)
{
$tagsformat1[]  = $tags['tag_name'];
}
$formattags = implode('","',$tagsformat1);
?>
<script>
$( document ).ready(function() {

            // use select2 dropdown instead of chosen as select2 works fine with bootstrap on responsive layouts.
            $('.select2_category').select2({
	            placeholder: "Select an option",
	            allowClear: true
	        });

            $('.select2_sample1').select2({
                placeholder: "Select a State",
                allowClear: true
            });

            $(".select2_sample2").select2({
                placeholder: "Type to select an option",
                allowClear: true,
                minimumInputLength: 1,
                query: function (query) {
                    var data = {
                        results: []
                    }, i, j, s;
                    for (i = 1; i < 5; i++) {
                        s = "";
                        for (j = 0; j < i; j++) {
                            s = s + query.term;
                        }
                        data.results.push({
                            id: query.term + i,
                            text: s
                        });
                    }
                    query.callback(data);
                }
            });

            $(".select2_sample3").select2({
				
                tags: ["<?php echo $formattags;?>"]
				
			});
});
</script>
<?php
foreach($tagssecondarydata as $tagss)
{
$tagsformat12[]  = $tagss['tag_name'];
}
$formattagsss = implode('","',$tagsformat12);
?>
<script>
$( document ).ready(function() {

            // use select2 dropdown instead of chosen as select2 works fine with bootstrap on responsive layouts.
            $('.select2_category').select2({
	            placeholder: "Select an option",
	            allowClear: true
	        });

            $('.select2_sample1').select2({
                placeholder: "Select a State",
                allowClear: true
            });

            $(".select2_sample2").select2({
                placeholder: "Type to select an option",
                allowClear: true,
                minimumInputLength: 1,
                query: function (query) {
                    var data = {
                        results: []
                    }, i, j, s;
                    for (i = 1; i < 5; i++) {
                        s = "";
                        for (j = 0; j < i; j++) {
                            s = s + query.term;
                        }
                        data.results.push({
                            id: query.term + i,
                            text: s
                        });
                    }
                    query.callback(data);
                }
            });

            $(".select2s_sample3").select2({
				
                tags: ["<?php echo $formattagsss;?>"]
				
			});
});
</script>
