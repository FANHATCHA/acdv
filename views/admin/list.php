<div class="clearfix">
</div>
<?php 
$menu = $this->input->get("menu");
?>
<div class="page-container">
	<?php echo $left_nav;?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					<?php echo $page_title; ?>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo $this->config->site_url();?>/admin/dashboard">
								<?php echo $this->lang->line('HOME');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo $this->config->site_url();?>/admin/menu">
								<?php echo $this->lang->line('MENU_NAME');?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
								<?php echo $this->lang->line('MENU_ASSING');?>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-5">
					<div class="portlet box green ">
						<div class="portlet-title">
							<div class="caption">
								<?php echo $this->lang->line('CUSTOM_LINK_ASSING');?>
							</div>
						</div>
						<div class="portlet-body form">
							<form action="<?php echo $this->config->site_url();?>/admin/menulink/customlink" class="form-horizontal form-bordered form-label-stripped" id="customlinkfrm" name="customlinkfrm" method="post" enctype="multipart/form-data">
								<div class="form-body">
									<div class="form-group">
										<label class="control-label col-md-3"> <?php echo $this->lang->line('TITLE_ASSIGN');?></label>
										<div class="col-md-9">
											<input type="text" id="custom_link_title" name="custom_link_title" class="form-control"/>
										</div>
									</div>
								</div>
								<div class="form-body">
									<div class="form-group">
										<label class="control-label col-md-3"> <?php echo $this->lang->line('CUSTOM_LINK_MENU');?></label>
										<div class="col-md-9">
											<input type="text" id="custom_link" name="custom_link" value="http://" class="form-control"/>
										</div>
									</div>
								</div>
								<div class="form-actions fluid">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-offset-3 col-md-9">
												<button type="submit" class="btn green"><i class="fa fa-check"></i> <?php echo $this->lang->line('ADD_TO_MENU');?></button>
											</div>
										</div>
									</div>
								</div>
								<input type="hidden" name="menu_type_id" id="menu_type_id" value="<?php if(isset($menu) && !empty($menu)){echo $menu;} ?>">
							</form>
						</div>	
					</div>
				
					<div class="portlet box green ">
						<div class="portlet-title">
							<div class="caption">
								<?php echo $this->lang->line('PAGES_ASSING');?>
							</div>
						</div>
						<div class="portlet-body form">
							<form action="<?php echo $this->config->site_url();?>/admin/menulink/pageassing" class="form-horizontal form-bordered form-label-stripped" id="pageassingfrm" name="pageassingfrm" method="post" enctype="multipart/form-data">
								<div class="form-body">
									<div class="form-group">
										<div class="checkbox-list">
											<?php foreach($cmspagemenu as $cmspages){ ?>
											<label>
												<input type="checkbox" id="pages" name="pages[]" value="<?php  echo $cmspages['id'];?>_<?php  echo $cmspages['cms_title'];?>"> <?php  echo $cmspages['cms_title'];?> </label>
												
											</label>
											<?php  } ?>
										</div>
									</div>	
								</div>
								<div class="form-actions fluid">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-offset-3 col-md-9">
												<button type="submit" class="btn green"><i class="fa fa-check"></i> <?php echo $this->lang->line('ADD_TO_MENU');?></button>
											</div>
										</div>
									</div>
								</div>
								<input type="hidden" name="menu_type_id" id="menu_type_id" value="<?php if(isset($menu) && !empty($menu)){echo $menu;} ?>">
							
							</form>
						</div>	
					</div>
					
					<div class="portlet box green ">
						<div class="portlet-title">
							<div class="caption">
								<?php echo $this->lang->line('CATEGORY_TRAVEL_ASSIGN');?>
							</div>
						</div>
						<div class="portlet-body form">
							<form action="<?php echo $this->config->site_url();?>/admin/menulink/productcat" class="form-horizontal form-bordered form-label-stripped" id="procatfrm" name="procatfrm" method="post" enctype="multipart/form-data">
								<div class="form-body">
									<div class="form-group">
										<div class="checkbox-list">
											<?php foreach($productcatdata as $productcat){ ?>
											<label>
												<input type="checkbox" id="procat" name="procat[]" value="<?php  echo $productcat['category_id'];?>"> <?php  echo $productcat['category_name'];?> </label>
											</label>
												<?php foreach($productcat['subcategories'] as $productcat1){ ?>
												<label>
													<span class="catlevel1"></span><input type="checkbox" id="procat" name="procat[]" value="<?php  echo $productcat1['category_id'];?>"> <?php  echo $productcat1['category_name'];?> </label>
												</label>
													<?php foreach($productcat1['subcategories'] as $productcat2){ ?>
													<label>
														<span class="catlevel2"></span><input type="checkbox" id="procat" name="procat[]" value="<?php  echo $productcat2['category_id'];?>"> <?php  echo $productcat2['category_name'];?> </label>
													</label>
														<?php foreach($productcat2['subcategories'] as $productcat3){ ?>
														<label>
															<span class="catlevel3"></span><input type="checkbox" id="procat" name="procat[]" value="<?php  echo $productcat3['category_id'];?>"> <?php  echo $productcat3['category_name'];?> </label>
														</label>
															<?php foreach($productcat3['subcategories'] as $productcat4){ ?>
															<label>
																<span class="catlevel4"></span><input type="checkbox" id="procat" name="procat[]" value="<?php  echo $productcat4['category_id'];?>"> <?php  echo $productcat4['category_name'];?> </label>
															</label>
															<?php }
														}
													}
												}
											} ?>
										</div>
									</div>
								</div>	
								<div class="form-actions fluid">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-offset-3 col-md-9">
												<button type="submit" class="btn green"><i class="fa fa-check"></i> <?php echo $this->lang->line('ADD_TO_MENU');?></button>
											</div>
										</div>
									</div>
								</div>
								<input type="hidden" name="menu_type_id" id="menu_type_id" value="<?php if(isset($menu) && !empty($menu)){echo $menu;} ?>">
							</form>
						</div>	
					</div>
				</div>
				
				<div class="col-md-7">
					<div class="portlet box green ">
						<div class="portlet-title">
							<div class="caption">
								<?php echo $this->lang->line('ADD_TITLE_MENU');?>
							</div>
						</div>
						<div class="portlet-body form">
							<?php 
							if(isset($menulist) && !empty($menulist)) { ?>
							<div class="collapse navbar-collapse bs-js-navbar-scrollspy">
								<ul class="nav navbar-nav">
									<?php foreach($menulist as $manus){ ?>
										<li class="active">
											<a class="active" href="<?php echo $this->config->site_url();?>/admin/menulink?menu=<?php echo $manus['id']; ?>">
											<?php echo $manus['menu_title']; ?>
											</a>
										</li>
									<?php } ?>	
								</ul>	
							</div>
							<?php } ?>
							
							<!--<div id="tree_menu_links" class="tree-demo">
							</div>-->
							<form action="<?php echo $this->config->site_url();?>/admin/menulink/updatemenu" class="form-horizontal form-bordered form-label-stripped" id="customlinkfrm" name="customlinkfrm" method="post" enctype="multipart/form-data">
								<input type="hidden"  name="levelids"  id="nestable_list_2_output" />
								<input type="hidden" name="menu_type_id" id="menu_type_id" value="<?php if(isset($menu) && !empty($menu)){echo $menu;} ?>">
								<div id="nestable_list_2" class="dd">
									 
										<?php 
										$menuleve_data = json_decode($getmenutree[0]['menuleve_data'],true);
										$modelc = new Menulinkmodel();
										$result = $modelc->menutreestructure($menuleve_data);
										if(isset($result) && !empty($result)){
											echo '<ol class="dd-list">';
											echo $result;
											echo '</ol>';
										}else if(isset($getassingmenuid) && !empty($getassingmenuid)){ ?>
										<ol class="dd-list"> 
											<?php
												$modelc = new Menulinkmodel();
												foreach($getassingmenuid as $assmenulist){
													if($assmenulist['menu_type'] == 'custom_link')
													{?>
														<li class="dd-item" data-id="<?php echo $assmenulist['id']; ?>">
															<div class="dd-handle">
																 <?php  echo $assmenulist['custom_link_title'];?>
															</div>
															<span class="removeitem" onclick="removeitem(<?php echo $assmenulist['id']; ?>)">
															<i class="fa fa-trash-o"></i>
															</span>
														</li>
													<?php }if($assmenulist['menu_type'] == 'cms_page'){ ?>
														<li class="dd-item" data-id="<?php echo $assmenulist['id']; ?>">
															<div class="dd-handle">
																<?php $cmspage = $modelc->getcmspagename($assmenulist['link_id']);?>
																<?php  echo $cmspage[0]['cms_title'];?>
															</div>
															<span class="removeitem" onclick="removeitem(<?php echo $assmenulist['id']; ?>)">
															<i class="fa fa-trash-o"></i>
															</span>
														</li>
													<?php }if($assmenulist['menu_type'] == 'pro_cat'){ ?>
														<li class="dd-item" data-id="<?php echo $assmenulist['id']; ?>">
															<div class="dd-handle">
																<?php $procatname = $modelc->getcategoryname($assmenulist['link_id']);?>
																<?php  echo $procatname[0]['category_name'];?>
															</div>
															<span class="removeitem" onclick="removeitem(<?php echo $assmenulist['id']; ?>)">
															<i class="fa fa-trash-o"></i>
															</span>
														</li>
													<?php }
												 }?>	
										</ol> 
										<?php }else {?>
											<ol class="dd-list">
												<li><div class="dd-handle"><?php echo $this->lang->line('NO_MENU_ASSIGN');?></div></li>
											</ol>
										<?php } ?>	
								</div>
								<div class="form-actions fluid">
									<div class="row">
										<div class="col-md-2">
											<div class="col-md-offset-3 col-md-9">
												<button type="submit" class="btn green"><i class="fa fa-check"></i> <?php echo $this->lang->line('SAVE_MENU');?></button>
											</div>
										</div>
									</div>
								</div>	
							</form>
							
						</div>	
					</div>
				</div>
			</div>
	</div>
</div>

